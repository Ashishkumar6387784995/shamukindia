<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_approved',
        'mobile_number',
        'pan_number',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'pass_view',
        'profile_image',
        'pincode',
        'assigned_products',
        'gender',
        'organization',
        'designation',
        'department',
        'branch',
        'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRole()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

    public function getCountry()
    {
        return $this->belongsTo(Countries::class);
    }

    public function getState()
    {
        return $this->belongsTo(State::class);
    }

    public function getCity()
    {
        return $this->belongsTo(City::class);
    }
}
