<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Advertentie;
use App\Models\Bedrijf;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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

    /**
     * Define the many-to-many relationship with roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function advertenties()
    {
        return $this->hasMany(Advertentie::class);
    }

    public function favoriete_advertenties()
    {
        return $this->belongsToMany(Advertentie::class, 'favoriete_advertenties', 'user_id', 'advertentie_id')->withTimestamps();
    }

    public function company()
    {
        return $this->hasOne(Bedrijf::class);
    }
  
    public function canAdvertise()
    {
        $can = false;
        foreach ($this->roles as $role) {
            if ($role->name == 'particulier' || $role->name == 'zakelijk') {
                $can = true;
            }
        }
        return $can;
    }
}
