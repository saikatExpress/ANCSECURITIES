<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'block_quote',
        'description',
        'about_images',
        'created_by',
        'updated_by',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'title'        => 'string',
        'block_quote'  => 'string',
        'description'  => 'string',
        'about_images' => 'string',
        'created_by'   => 'string',
        'updated_by'   => 'string',
        'status'       => 'string',
        'flag'         => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];
}
