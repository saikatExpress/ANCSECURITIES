<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fund extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'client_name',
        'amount',
        'ac_no',
        'description',
        'feedback',
        'category',
        'withdraw_date',
        'remark',
        'complete_by',
        'approved_by',
        'declined_by',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'            => 'integer',
        'client_id'     => 'integer',
        'client_name'   => 'string',
        'amount'        => 'string',
        'ac_no'         => 'string',
        'description'   => 'string',
        'feedback'      => 'string',
        'category'      => 'string',
        'withdraw_date' => 'datetime',
        'remark'        => 'string',
        'complete_by'   => 'integer',
        'approved_by'   => 'integer',
        'declined_by'   => 'integer',
        'status'        => 'string',
        'flag'          => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
