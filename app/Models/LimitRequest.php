<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'trade_id',
        'client_name',
        'limit_amount',
        'reason',
        'approved_by',
        'declined_by',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'client_id'    => 'integer',
        'trade_id'     => 'integer',
        'client_name'  => 'string',
        'limit_amount' => 'integer',
        'reason'       => 'string',
        'approved_by'  => 'string',
        'declined_by'  => 'string',
        'status'       => 'string',
        'flag'         => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    //Relation Start
    public function clients()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public static function createData($clientId,$code,$name, $email, $mobile, $amount)
    {
        LimitRequest::create([
            'client_id'    => $clientId,
            'trade_id'     => $code,
            'client_name'  => $name,
            'limit_amount' => $amount,
            'reason'       => 'for trade',
            'approved_by'  => auth()->user()->name,
            'status'       => 'approved'
        ]);
    }
}
