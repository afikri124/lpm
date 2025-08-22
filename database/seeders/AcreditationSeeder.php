<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acreditation;

class AcreditationSeeder extends Seeder
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
            ["id" => "1", "name" => "A", "star_point" => 3],
            ["id" => "2", "name" => "B", "star_point" => 2],
            ["id" => "3", "name" => "C", "star_point" => 1],
            ["id" => "4", "name" => "Unggul", "star_point" => 3],
            ["id" => "5", "name" => "Baik Sekali", "star_point" => 2],
            ["id" => "6", "name" => "Baik", "star_point" => 1],
        ];

        foreach ($data as $x) {
            if(!Acreditation::where('id', $x['id'])->first()){
                $m = new Acreditation();
                $m->id = $x['id'];
                $m->name = $x['name'];
                $m->star_point = $x['star_point'];
                $m->save();
            }
        }
    }
}
