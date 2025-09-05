<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    // Fillable fields
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount_paid',
        'payment_method',
        'payment_status',
        'transaction_id',
        'paid_at',
        'valid_until',
    ];
    public $timestamps = false;

    protected $dates = [
        'paid_at',
        'valid_until',
    ];
}
