<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{

    protected $table = "invoice";
    protected $primaryKey = "id";

    protected $fillable = [
        'total_price', 'is_paid', 'admins_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["created_at", "updated_at"];

    
}
