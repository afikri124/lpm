<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User_role;

class UserRoleSeeder extends Seeder
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
            ["user_id" => "1", "role_id" => "AD"],
            ["user_id" => "1", "role_id" => "AU"],
            ["user_id" => "1", "role_id" => "DE"],
            ["user_id" => "1", "role_id" => "LE"],
            ["user_id" => "1", "role_id" => "ST"],
        ];

        foreach ($data as $x) {
            if(!User_role::where('user_id', $x['user_id'])
            ->where('role_id', $x['role_id'])->first()){
                $m = new User_role();
                $m->user_id = $x['user_id'];
                $m->role_id = $x['role_id'];
                $m->save();
            }
        }
    }
}
