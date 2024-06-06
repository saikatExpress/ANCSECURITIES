<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_rcv',
        'is_reply',
        'replied_by',
    ];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'email'      => 'string',
        'subject'    => 'string',
        'message'    => 'string',
        'is_rcv'     => 'integer',
        'is_reply'   => 'integer',
        'replied_by' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
