<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shortlisted_user_id'
    ];
}
