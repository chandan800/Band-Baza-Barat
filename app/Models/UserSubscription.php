<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $table = 'user_subscriptions';
    protected $primaryKey = 'subscription_id'; 

    // Fillable fields
    protected $fillable = [
        'user_id',
        'plan_id',
        'started_at',
        'expires_at',
        'is_active',
    ];
    public $timestamps = false;
    protected $dates = [
        'started_at',
        'expires_at',
    ];

    public function plan()
{
    return $this->belongsTo(\App\Models\SubscriptionPlan::class, 'plan_id', 'plan_id');
}
}
