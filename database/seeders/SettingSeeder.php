<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
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
            ["id" => "HODLPM", "title" => "Ariep Jaenul, S.Pd. M.Sc.Eng", "content" => "S092019030004"],
            ["id" => "CONTACT", "title" => "WhatsApp", "content" => "087880004742"],
            ["id" => "MINSCORE", "title" => "KKM", "content" => "70"],
            ["id" => "TOTALAUDITOR", "title" => "Total Auditor", "content" => "2"],
            ["id" => "LINKINSTRUMENT", "title" => "Klik Disini", "content" => "https://www.banpt.or.id/wp-content/uploads/2019/10/Lampiran-5-PerBAN-PT-5-2019-tentang-IAPS-Pedoman-Penilaian.pdf"],
            ["id" => "LINKINSTRUMENT2", "title" => "Klik Disini", "content" => ""],
            ["id" => "LINKINSTRUMENT3", "title" => "Klik Disini", "content" => ""],
            ["id" => "LINKINSTRUMENT4", "title" => "Klik Disini", "content" => ""],
            ["id" => "LINKINSTRUMENT5", "title" => "", "content" => ""],
            ["id" => "LINKINSTRUMENT6", "title" => "", "content" => ""],
            ["id" => "LINKINSTRUMENT7", "title" => "", "content" => ""],
            ["id" => "LINKSURVEY", "title" => "ISI SURVEI LAYANAN", "content" => "https://lpm.jgu.ac.id"],
            ["id" => "INFO", "title" => "Y", "content" => "This system is under development."],
        ];

        foreach ($data as $x) {
            if(!Setting::where('id', $x['id'])->first()){
                $m = new Setting();
                $m->id = $x['id'];
                $m->title = $x['title'];
                $m->content = $x['content'];
                $m->save();
            }
        }
    }
}
