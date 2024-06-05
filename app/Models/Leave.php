<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type',
        'slug',
        'number_of_leave',
        'created_by',
        'updated_by',
        'status',
    ];
}
