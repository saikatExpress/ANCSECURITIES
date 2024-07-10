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
        'father_name',
        'spouse_name',
        'mother_name',
        'address',
        'cell_no',
        'email',
        'ac_open_date',
        'bank_account_no',
        'bank_name',
        'branch_name',
        'trader_code',
        'status',
    ];

    protected $casts = [
        'id'              => 'integer',
        'bo_id'           => 'string',
        'name'            => 'string',
        'ac_type'         => 'string',
        'father_name'     => 'string',
        'spouse_name'     => 'string',
        'mother_name'     => 'string',
        'address'         => 'string',
        'cell_no'         => 'string',
        'ac_open_date'    => 'datetime',
        'bank_account_no' => 'string',
        'bank_name'       => 'string',
        'branch_name'     => 'string',
        'trader_code'     => 'string',
        'email'           => 'string',
        'status'          => 'string',
        'created_at'      => 'integer',
        'updated_at'      => 'integer',
    ];
}
