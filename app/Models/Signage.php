<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signage extends Model
{
    protected $fillable = [
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

    public function campaignDetails()
    {
        return $this->hasOne(CampaignDetails::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItem::class);
    }
}
