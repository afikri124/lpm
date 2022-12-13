<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\Follow_up;
use App\Models\Observation;
use Carbon\Carbon;
use App\Mail\MailReminder;
use Jenssegers\Date\Date;

class JobReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Date::now()->format('l, j F Y');

        //Kirim email reminder ke dekan yang belum mengisi remark
        $dea = Follow_up::with('dean')
        ->whereNull('remark')
        ->whereDate('date_start', '<=', Carbon::now()->endOfDay())
        // ->whereDate('date_end', '>=', Carbon::today())
        ->groupBy("dean_id")
        ->select("dean_id")->get();
        if($dea != null){
            foreach($dea as $a){
                $this->data['email'] = $a->dean->email;
                $this->data['subject'] = "Peer-Observation Reminder! ".$date;
                $this->data['name'] = $a->dean->name_with_title;
                $this->data['messages'] = "tindak lanjut (follow-up) yang belum diselesaikan (".$date.")";;
                $this->data['username'] = $a->dean->username;
                Mail::to($this->data['email'])->queue(new MailReminder($this->data));
            }
        }

        //Kirim email reminder hari ini ke auditor yang belum hadir
        $audi = Observation::join('schedules as s', 's.id', '=', 'observations.schedule_id')->with('auditor')
        ->where('attendance', false)
        ->where(function ($query) {
            $query->where('s.status_id', '=', 'S00')
                  ->orWhere('s.status_id', '=', 'S01');
        })
        ->whereDate('s.date_start', '<=', Carbon::now()->endOfDay())
        // ->whereDate('s.date_end', '>=', Carbon::today())
        ->groupBy("auditor_id")
        ->select("auditor_id")->get();
        if($audi != null){
            foreach($audi as $a){
                $this->data['email'] = $a->auditor->email;
                $this->data['subject'] = "Peer-Observation Reminder! ".$date;
                $this->data['name'] = $a->auditor->name_with_title;
                $this->data['messages'] = "PO yang perlu Anda kerjakan hari ini (".$date.")";
                $this->data['username'] = $a->auditor->username;
                Mail::to($this->data['email'])->queue(new MailReminder($this->data));
            }
        }
    }
}
