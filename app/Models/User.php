<?php

namespace App\Models;

use App\Blog;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\UserDetail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Role as AppRole;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'email',
        'password',
        'role_id',
        'remember_token',
        'token',
        'facebook_id',
    ];



    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function carts()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $cast = [
        'email_verified_at' => 'datetime',
    ];
}
