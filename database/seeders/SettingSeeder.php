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
            ["id" => "HODLPM", "title" => "ARIEP JAENUL S.Lebew.", "content" => "12345"],
            ["id" => "CONTACT", "title" => "WhatsApp", "content" => "12345"],
            ["id" => "MINSCORE", "title" => "KKM", "content" => "70"],
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
