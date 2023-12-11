<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'credits'
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

    public function skins()
    {
        return $this->belongsToMany(Skin::class, 'user_skins')
            ->withPivot('id', 'price', 'for_sale');
    }

    public function skinsForSale()
    {
        return $this->belongsToMany(Skin::class, 'user_skins')
            ->withPivot('id', 'price', 'for_sale')
            ->wherePivot('for_sale', true);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'seller_id');
    }

    public function purchases()
    {
        return $this->hasMany(Sale::class, 'buyer_id');
    }
}
