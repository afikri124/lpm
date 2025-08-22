<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyProgram;

class StudyProgramSeeder extends Seeder
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
            ["id" => "1", "name" => "Akuntansi", "degree_level" => "D3", "acreditation_id" => 6],
            ["id" => "2", "name" => "Bisnis Digital", "degree_level" => "S1", "acreditation_id" => 6],
            ["id" => "3", "name" => "Farmasi", "degree_level" => "S1", "acreditation_id" => 6],
            ["id" => "4", "name" => "Manajemen", "degree_level" => "S1", "acreditation_id" => 5],
            ["id" => "5", "name" => "Teknik Elektro", "degree_level" => "S1", "acreditation_id" => 5],
            ["id" => "6", "name" => "Teknik Industri", "degree_level" => "S1", "acreditation_id" => 6],
            ["id" => "7", "name" => "Teknik Informatika", "degree_level" => "S1", "acreditation_id" => 5],
            ["id" => "8", "name" => "Teknik Mesin", "degree_level" => "S1", "acreditation_id" => 5],
            ["id" => "9", "name" => "Teknik Sipil", "degree_level" => "S1", "acreditation_id" => 5],
            ["id" => "10", "name" => "Teknik Elektro", "degree_level" => "S2", "acreditation_id" => 6],
        ];

        foreach ($data as $x) {
            if(!StudyProgram::where('id', $x['id'])->first()){
                $m = new StudyProgram();
                $m->id = $x['id'];
                $m->name = $x['name'];
                $m->degree_level = $x['degree_level'];
                $m->acreditation_id = $x['acreditation_id'];
                $m->save();
            }
        }
    }
}
