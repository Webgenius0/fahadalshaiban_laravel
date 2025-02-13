<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CampaignDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'ad_title',
        'campaign_description',
        'start_date',
        'end_date',
        'terms_and_conditions',
        'privacy_policy',
        'art_work'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
