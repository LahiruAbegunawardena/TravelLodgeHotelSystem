<?php

use Illuminate\Database\Seeder;
use App\BO\Models\RoomType;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_type')->insert([
            [ "no_of_beds" => 1, "is_ac" => 0 ],
            [ "no_of_beds" => 1, "is_ac" => 1 ],
            [ "no_of_beds" => 2, "is_ac" => 0 ],
            [ "no_of_beds" => 2, "is_ac" => 1 ],
            [ "no_of_beds" => 3, "is_ac" => 0 ],
            [ "no_of_beds" => 3, "is_ac" => 1 ]
        ]);
        
        
    }
}
