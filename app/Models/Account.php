<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'initial_balance',
        'balance',
        'costing_balance',
        'account_number',
        'bank_name',
        'branch_name',
        'ifsc_code',
        'account_type',
        'status',
    ];
}
