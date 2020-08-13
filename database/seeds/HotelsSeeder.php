<?php

use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
            [
                "hotel_name" => "Travel Lodge | Mirissa",
                "longitude" => "15.22",
                "latitude" => "25.652",
                "address" => "No 210, Galle Road, Mirissa"
            ],
            [
                "hotel_name" => "Travel Lodge | River View",
                "longitude" => "65.22",
                "latitude" => "105.652",
                "address" => "No 12, Peradeniya Road, Peradeniya"
            ]
        ]);
    }
}
