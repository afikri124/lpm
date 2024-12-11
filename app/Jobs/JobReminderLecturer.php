<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Mail\MailReminder;
use Jenssegers\Date\Date;

class JobReminderLecturer implements ShouldQueue
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
        //Kirim email reminder  ke lecturer/auditee
        $lc = Schedule::with('lecturer')
        ->where(function ($query) {
            $query->where('status_id', '=', 'S00')
                  ->orWhere('status_id', '=', 'S01')
                  ->orWhere('status_id', '=', 'S02');
        })
        ->whereDate('date_end', '<', Carbon::now()->startOfDay())
        ->whereDate('date_start', '>', Carbon::now()->startOfMonth()->subMonth(2))
        ->groupBy("lecturer_id")
        ->select("lecturer_id")->get();
        if($lc != null){
            foreach($lc as $a){
                if($a->lecturer->email != null) {
                    $this->data['email'] = $a->lecturer->email;
                    $this->data['subject'] = "Peer-Observation Schedule!";
                    $this->data['name'] = $a->lecturer->name_with_title;
                    $this->data['messages'] = "PO yang sudah terlewat, Segera hubungi auditor dan Tim LPM JGU untuk melakukan perubahan jadwal";
                    $this->data['username'] = $a->lecturer->username;
                    Mail::to($this->data['email'])->queue(new MailReminder($this->data));
                }
            }
        }
    }
}
