<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_images',
        'title',
        'description',
        'created_by',
        'updated_by',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'             => 'integer',
        'gallery_images' => 'string',
        'title'          => 'string',
        'description'    => 'string',
        'created_by'     => 'string',
        'updated_by'     => 'string',
        'status'         => 'string',
        'flag'           => 'integer',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];
}
