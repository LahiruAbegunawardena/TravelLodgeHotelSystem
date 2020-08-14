<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualHotelRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_hotel_room', function (Blueprint $table) {
            $table->id();
            $table->integer('hotels_id');
            $table->integer('no_of_beds');
            $table->tinyInteger('is_ac');
            // $table->text('room_code');
            $table->double('price_per_night');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_hotel_room');
    }
}
