<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserProfile extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            $date = Carbon::now()->format('Ymd');

            $lastProfile = DB::table('user_profiles')
                ->where('profile_key', 'like', "BBB{$date}%")
                ->orderBy('profile_id', 'desc')
                ->first();

            if ($lastProfile && preg_match("/BBB{$date}(\d+)/", $lastProfile->profile_key, $matches)) {
                $number = intval($matches[1]) + 1;
            } else {
                $number = 1;
            }

            $profile->profile_key = "BBB" . $date . str_pad($number, 2, '0', STR_PAD_LEFT);
        });
    }

    protected $fillable = [
        'user_id',
        'profile_for',
        'dob',
        'height_cm',
        'weight_kg',
        'marital_status',
        'diet',
        'mother_tongue',
        'religion',
        'caste',
        'subcaste',
        'gotra',
        'hobbies',
        'about_family',
        'native_state',
        'native_district',
        'current_country',
        'current_state',
        'current_city',
        'pin_code',
        'occupation_category',
        'job_title',
        'employer',
        'annual_income',
        'food_habits',
        'smoking_habits',
        'drinking_habits',
        'father_occupation',
        'mother_occupation',
        'family_status',
        'siblings',
        'rashi',
        'nakshatra',
        'manglik',
        'birth_time',
        'birth_place',
        'whatsapp',
        'mobile',
        'hide_profile',
        'watermark_photos',
        'smoking_habits',
        'drinking_habits'
    ];

    public function user()
    {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
