<?php

namespace App\BO\Models;

use App\Customer;
use App\BO\Models\ReservationModel;
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

    public function reservations()
    {
        return $this->hasMany(ReservationModel::class, 'individual_hotel_room_id');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, ReservationModel::class, 'individual_hotel_room_id', 'customers_id')->withPivot('id', 'invoice_id', 'checkin_date_time', 'checkout_date_time', 'reserved_date_time', 'price');
    }
    public function belongedHotel()
    {
        return $this->belongsTo(HotelModel::class, 'hotels_id');
    }
}
