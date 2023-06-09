<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ["id" => "S00", "title" => "Scheduled"],
            ["id" => "S01", "title" => "Reschedule"],
            ["id" => "S02", "title" => "Audit 1"],
            ["id" => "S03", "title" => "Audit 2"],
            ["id" => "S04", "title" => "Follow-Up"],
            ["id" => "S05", "title" => "Result and Recommendation"],
            ["id" => "S06", "title" => "Finish"],
            ["id" => "S07", "title" => "Validated"],
            ["id" => "S08", "title" => "Rejected"],
        ];

        foreach ($data as $x) {
            if(!Status::where('id', $x['id'])->first()){
                $m = new Status();
                $m->id = $x['id'];
                $m->title = $x['title'];
                $m->save();
            }
        }
    }
}
