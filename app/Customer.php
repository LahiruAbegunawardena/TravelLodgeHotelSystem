<?php

namespace App;

use App\BO\Models\ReservationModel;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\BO\Models\IndividualHotelRoomModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'customers';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'is_verified', 'contact_no_1', 'contact_no_2','created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function reserve()
    {
        return $this->belongsToMany(IndividualHotelRoomModel::class, ReservationModel::class, 'customers_id', 'individual_hotel_room_id')->withPivot('id', 'invoice_id', 'checkin_date_time', 'checkout_date_time', 'reserved_date_time', 'price');
    }
}
