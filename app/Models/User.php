<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'user_id';   
    protected $fillable = [
        'username','email','password',
        'first_name','last_name','gender','age',
        'education','occupation','community','is_premium'
    ];

   public function profile()
{
    return $this->hasOne(UserProfile::class, 'user_id', 'user_id');
}

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function subscription()
    {
    
    return $this->hasOne(\App\Models\UserSubscription::class, 'user_id', 'user_id')
                ->latest('expires_at');
    }

    
    public function photos()
    {
        return $this->hasMany(UserPhoto::class, 'user_id', 'user_id');
    }

    public function interestsSent()
    {
        return $this->hasMany(Interest::class, 'sender_id');
    }

    // Interests received
    public function interestsReceived()
    {
        return $this->hasMany(Interest::class, 'receiver_id');
    }

    // Shortlisted users
    public function shortlists()
    {
        return $this->hasMany(Shortlist::class, 'user_id');
    }

    // Function to get counts
    public function stats()
    {
        return [
            'interests_sent'     => $this->interestsSent()->count(),
            'interests_received' => $this->interestsReceived()->count(),
            'shortlisted_users'  => $this->shortlists()->count(),
        ];
    }
}
