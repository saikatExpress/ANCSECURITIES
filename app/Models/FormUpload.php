<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_file',
        'form_name',
        'form_title',
        'form_description',
        'created_by',
        'updated_by',
        'status',
        'flag',
        'privacy',
    ];

    protected $casts = [
        'id'               => 'integer',
        'form_file'        => 'string',
        'form_name'        => 'string',
        'form_title'       => 'string',
        'form_description' => 'string',
        'created_by'       => 'string',
        'updated_by'       => 'string',
        'status'           => 'string',
        'flag'             => 'integer',
        'privacy'          => 'integer',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];
}
