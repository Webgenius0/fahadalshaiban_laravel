<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'signage_id', 'price_per_day', 'rotation_time', 'avg_daily_views', 'total',
    ];

    // Define the relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Define the relationship with Signage
    public function signage()
    {
        return $this->belongsTo(Signage::class, 'signage_id');
    }

    public function campaignDetails()
    {
        return $this->hasMany(CampaignDetails::class, 'order_id', 'order_id'); // Link by order_id
    }

   
}
