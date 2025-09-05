<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
    ];

    // Sender relationship
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'user_id');
    }

    // Receiver relationship
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'user_id');
    }
}
