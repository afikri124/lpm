<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use QrCode;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Observation;
use App\Models\Follow_up;
use App\Models\Schedule_history;
use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Jenssegers\Date\Date;
use Auth;

class PdfController extends Controller
{
    public function report($id)
    {
        try {
            $s_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $data = Schedule::with('lecturer')->with('status')->with('observations')->with('observations.auditor')->findOrFail($s_id);
        if($data->lecturer->id == Auth::user()->id && $data->status_id == "S05"){
            $d = Schedule::findOrFail($s_id)
                ->update([ 
                    'status_id'=> 'S06',
                ]);
            if($d){
                $x = Schedule_history::insert([
                        'schedule_id' => $s_id,
                        'description' => "<b>".Auth::user()->name."</b> has seen the result of the observed value.",
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
            }
        }

        $link = route('pdf.report', $id );
        Date::setLocale('id');
        $qr = base64_encode(QrCode::format('svg')->size(150)->errorCorrection('H')->generate($link));
        $survey = Observation::with('observation_categories')
            ->with('auditor')
            ->with('observation_categories.criteria_category')
            ->with('observation_categories.observation_criterias')
            ->with('observation_categories.observation_criterias.criteria')
            ->where('schedule_id',$s_id)->get();

        $follow_up = Follow_up::with('dean')->where('schedule_id',$s_id)->first();
        $hod = Setting::findOrFail('HODLPM');
        $MINSCORE = Setting::findOrFail('MINSCORE');
        $pdf = PDF::loadview('pdf.report', compact('data','qr', 'survey', 'follow_up', 'hod', 'MINSCORE'));
	    return $pdf->stream("PO Report - ".$data->lecturer->name." - ".date('d-m-Y', strtotime($data->date_start)).".pdf");
    }

    public function recap(Request $request)
    {
        Date::setLocale('id');
        $link = route('pdf.recap');
        $qr = base64_encode(QrCode::format('svg')->size(150)->errorCorrection('H')->generate($link));
        $MINSCORE = Setting::findOrFail('MINSCORE');
        $hod = Setting::findOrFail('HODLPM');
        $data = Schedule::query()
                ->with('status')
                ->with(['lecturer' => function ($query) {
                    $query->select('id','name');
                }])
                ->with('observations')
                ->with('observations.auditor')
                ->with('observations.observation_criterias')
                ->select('*')->orderBy("status_id");

        if (!empty($request->get('lecturer_id'))) {
            $data->where('lecturer_id', $request->get('lecturer_id'));
        }
        if (!empty($request->get('status_id'))) {
            $data->where('status_id', $request->get('status_id'));
        }
        if (!empty($request->get('study_program'))) {
            $data->where('study_program', $request->get('study_program'));
        }
        if (!empty($request->get('range'))) {
            if($request->get('range') != "" && $request->get('range') != null && $request->get('range') != "Invalid date - Invalid date"){
                $x = explode(" - ",$request->get('range'));
                $data->whereDate('date_start', '<=', date('Y-m-d 23:59',strtotime($x[1])));
                $data->whereDate('date_end', '>=', date('Y-m-d H:i',strtotime($x[0])));
            }
        }
        $data = $data->get();

        $pdf = PDF::loadview('pdf.recap', compact('qr','MINSCORE','data','hod','request'));
	    return $pdf->stream("PO Recap - ".Date::now()->format('j F Y').".pdf");
    }
}
