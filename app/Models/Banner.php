<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image',
        'banner_title',
        'short_title',
        'short_description',
        'created_by',
        'updated_by',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'                => 'integer',
        'banner_image'      => 'string',
        'banner_title'      => 'string',
        'short_title'       => 'string',
        'short_description' => 'string',
        'created_by'        => 'string',
        'updated_by'        => 'string',
        'status'            => 'string',
        'flag'              => 'integer',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];
}
