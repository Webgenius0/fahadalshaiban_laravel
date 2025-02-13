<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'uuid','subtotal', 'dispatch_fee', 'total', 'status',
    ];

    // Define the relationship with OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    //
    public function campaignDetails(){
        return $this->hasMany(CampaignDetails::class);
    }
}
