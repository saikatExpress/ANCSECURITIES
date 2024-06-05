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
}
