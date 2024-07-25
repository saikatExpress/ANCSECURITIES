<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_logo',
        'login_background_image',
        'signup_background_image',
    ];

    protected $casts = [
        'id'                      => 'integer',
        'project_name'            => 'string',
        'project_logo'            => 'string',
        'login_background_image'  => 'string',
        'signup_background_image' => 'string',
        'created_at'              => 'datetime',
        'updated_at'              => 'datetime',
    ];
}
