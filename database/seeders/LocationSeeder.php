<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locations;
use File;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Locations::truncate();
        $json = File::get("database/data/room_location.json");
        $loc = json_decode($json);
  
        foreach ($loc as $key => $value) {
            Locations::create([
                "id" => $value->id,
                "title" => $value->title
            ]);
        }
    }
}
