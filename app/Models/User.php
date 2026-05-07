<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dasid',
        'first_name',
        'last_name',
        'email',
        'role',
        'country',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }


/*

    public function listings(): HasMany {
        return $this->hasMany(Listing::class, 'by_user_id');
    }
*/

    public function Course():HasMany{
        return $this->hasMany(Course::class, 'created_by');
    }


    public function scopeGetInstructors(Builder $query): Builder{
        return $query->where('instructor', true);
    }
    
}
