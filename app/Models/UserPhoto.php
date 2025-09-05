<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $table = 'user_photos'; // your table name
    protected $primaryKey = 'photo_id'; // primary key column
    public $timestamps = false; // if no created_at/updated_at in your table

    protected $fillable = [
        'user_id',
        'photo_url',
        'is_profile_photo',
        'is_verified',
        'uploaded_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
