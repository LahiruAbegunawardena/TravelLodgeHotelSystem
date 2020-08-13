<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTypeModel extends Model
{

    protected $table = "room_type";
    protected $primaryKey = "id";

    protected $fillable = [
        'no_of_beds', 'is_ac'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
