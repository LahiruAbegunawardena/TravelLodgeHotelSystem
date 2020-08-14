<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationModel extends Model
{

    protected $table = "reservation";
    protected $primaryKey = "id";

    protected $fillable = [
        'customers_id', 'individual_hotel_room_id', 'invoice_id',
        'checkin_date_time', 'checkout_date_time', 'reserved_date_time', 'price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["created_at", "updated_at"];

    
}
