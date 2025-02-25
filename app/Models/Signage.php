<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signage extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'signage_id');
    }

    public function campaignDetails()
    {
        return $this->hasOne(CampaignDetails::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItem::class);
    }
}
