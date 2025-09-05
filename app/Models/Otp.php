<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Otp extends Model
{
    use HasFactory;
    protected $table = 'otps';
    protected $fillable = [
        'email',
        'otp',
        'mobile',
        'expires_at',
    ];

    protected $dates = [
        'expires_at',
    ];

    public $timestamps = true;
}
