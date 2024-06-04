<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'profile_image',
        'email',
        'mobile',
        'whatsapp',
        'address',
        'otp',
        'trading_code',
        'role',
        'user_agent',
        'fb_link',
        'insta_link',
        'twiter_link',
        'linkedin_link',
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
        'profile_image'     => 'string',
        'email'             => 'string',
        'mobile'            => 'string',
        'whatsapp'          => 'string',
        'address'           => 'string',
        'otp'               => 'string',
        'trading_code'      => 'string',
        'role'              => 'string',
        'user_agent'        => 'string',
        'fb_link'           => 'string',
        'insta_link'        => 'string',
        'twiter_link'       => 'string',
        'linkedin_link'     => 'string',
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
