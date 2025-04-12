<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signage extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category_name',
        'slug',
        'description',
        'avg_daily_views',
        'per_day_price',
        'exposure_time',
        'height',
        'width',
        'actual_height',
        'actual_width',
        'location',
        'lat', // Ensure this is included
        'lan', // Ensure this is included
        'image',
        'terms_and_conditions',
        'privacy_policy',
    ];

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

    // public function campaignDetails()
    // {
    //     return $this->hasOne(CampaignDetails::class);
    // }

    // public function orders()
    // {
    //     return $this->hasManyThrough(Order::class, OrderItem::class);
    // }


    public function orders()
{
    return $this->hasManyThrough(
        Order::class,
        OrderItem::class,
        'signage_id', // Foreign key on OrderItem
        'id',         // Foreign key on Order
        'id',         // Local key on Signage
        'order_id'    // Local key on OrderItem
    );
}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Relationship with CampaignDetails through OrderItems
    public function campaignDetails()
    {
        return $this->hasManyThrough(CampaignDetails::class, OrderItem::class, 'signage_id', 'order_id', 'id', 'order_id');
    }

    

}
