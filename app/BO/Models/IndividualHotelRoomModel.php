<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualHotelRoomModel extends Model
{

    protected $table = "individual_hotel_room";
    protected $primaryKey = "id";

    protected $fillable = [
        'hotels_id', 'no_of_beds', 'is_ac', 'price_per_night'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["created_at", "updated_at"];

}
