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
        'mobile',
        'address',
        'otp',
        'role',
        'user_agent',
        'last_login_at',
        'last_logout_at',
        'email_verified_at',
        'password',
        'status',
        'is_block',
        'flag',
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
        'id'                => 'integer',
        'name'              => 'string',
        'email'             => 'string',
        'mobile'            => 'string',
        'address'           => 'string',
        'otp'               => 'string',
        'role'              => 'string',
        'user_agent'        => 'string',
        'last_login_at'     => 'datetime',
        'last_logout_at'    => 'datetime',
        'email_verified_at' => 'datetime',
        'status'            => 'string',
        'is_block'          => 'integer',
        'flag'              => 'integer',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];
}
