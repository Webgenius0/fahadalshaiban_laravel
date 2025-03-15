<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'name',
        'email',
        'phone',
        'city',
        'state',
        'country',
        'postal_code',
    ];
}
