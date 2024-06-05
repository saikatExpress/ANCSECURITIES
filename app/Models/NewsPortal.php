<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPortal extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'news_title',
        'quotes',
        'description',
        'news_image',
        'tags',
        'created_by',
        'updated_by',
        'is_view',
        'is_read',
        'news_date',
    ];

    protected $casts = [
        'id'          => 'integer',
        'category'    => 'integer',
        'news_title'  => 'string',
        'quotes'      => 'string',
        'description' => 'string',
        'news_image'  => 'string',
        'tags'        => 'string',
        'created_by'  => 'string',
        'updated_by'  => 'string',
        'is_view'     => 'integer',
        'is_read'     => 'integer',
        'news_date'   => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];
}
