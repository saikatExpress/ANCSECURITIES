<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bo_id',
        'name',
        'ac_type',
        'status',
    ];

    protected $casts = [
        'id'         => 'integer',
        'bo_id'      => 'integer',
        'name'       => 'string',
        'ac_type'    => 'string',
        'status'     => 'string',
        'created_at' => 'integer',
        'updated_at' => 'integer',
    ];
}
