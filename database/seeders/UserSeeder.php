<?php

namespace Database\Seeders;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->username = "admin";
        $user->name = "admin";
        $user->email = "admin@jgu.ac.id";
        $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->password = bcrypt('adminadmin'); 
        $user->save();
    }
}
