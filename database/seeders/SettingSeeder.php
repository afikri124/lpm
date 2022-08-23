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
            ["id" => "HODLPM", "title" => "ARIEP JAENUL S.Lebew.", "content" => "1234567982172"],
            ["id" => "CONTACT", "title" => "WhatsApp", "content" => "12345"],
            ["id" => "MINSCORE", "title" => "KKM", "content" => "70"],
            ["id" => "TOTALAUDITOR", "title" => "Total Auditor", "content" => "2"],
            ["id" => "LINKINSTRUMENT", "title" => "Klik Disini", "content" => "https://www.banpt.or.id/wp-content/uploads/2019/10/Lampiran-5-PerBAN-PT-5-2019-tentang-IAPS-Pedoman-Penilaian.pdf"],
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
