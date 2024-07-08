<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'iso',
        'name',
        'nicename',
        'iso3',
        'numcode',
        'phonecode',
    ];

    protected $casts = [
        'id'         => 'integer',
        'iso'        => 'string',
        'name'       => 'string',
        'nicename'   => 'string',
        'iso3'       => 'string',
        'numcode'    => 'integer',
        'phonecode'  => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
