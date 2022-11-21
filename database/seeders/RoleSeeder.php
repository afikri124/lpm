<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
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
            ["id" => "AD", "title" => "Admin"],
            ["id" => "DE", "title" => "Follow-Up"],
            ["id" => "AU", "title" => "Auditor"],
            ["id" => "LE", "title" => "Lecturer"],
            ["id" => "ST", "title" => "Staff"],
        ];

        foreach ($data as $x) {
            if(!Role::where('id', $x['id'])->first()){
                $m = new Role();
                $m->id = $x['id'];
                $m->title = $x['title'];
                $m->save();
            }
        }
    }
}
