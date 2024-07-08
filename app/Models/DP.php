<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DP extends Model
{
    use HasFactory;

    protected $fillable = [
        'dp_id',
        'name',
        'slug',
        'email',
        'phone_number',
        'fax',
        'address',
        'employee_name',
        'employee_designation',
        'website_link',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'                   => 'integer',
        'dp_id'                => 'integer',
        'name'                 => 'string',
        'slug'                 => 'string',
        'email'                => 'string',
        'phone_number'         => 'string',
        'fax'                  => 'string',
        'address'              => 'string',
        'employee_name'        => 'string',
        'employee_designation' => 'string',
        'website_link'         => 'string',
        'status'               => 'string',
        'flag'                 => 'integer',
        'created_at'           => 'datetime',
        'updated_at'           => 'datetime',
    ];
}
