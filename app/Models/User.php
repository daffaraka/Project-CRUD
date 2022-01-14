<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    
     protected $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'address',
        'tanggal_lahir',
        'role',
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
    ];

    public function Cart()
    {
        return $this->hasMany(Cart::class,'cart_id','id');
    }

    public function role(){
        auth()->user()->role;
    }

    public function userId(){
        return $this->user_id;
    }
    public function hasRoles($userId, $role)
    {
        return User::where('role', $role)->where('user_id', $userId)->get();
    }
}
