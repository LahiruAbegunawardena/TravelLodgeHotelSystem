<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;

class HotelModel extends Model
{

    protected $table = "hotels";
    protected $primaryKey = "id";

    protected $fillable = [
        'hotel_name', 'longitude', 'latitude', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["created_at", "updated_at"];

    public function individualHotelRooms()
    {
        return $this->hasMany(IndividualHotelRoomModel::class, "hotels_id");
    }
}
