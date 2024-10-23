<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        'created_by',
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
        'created_by'    => 'integer',
        'complete_by'   => 'integer',
        'approved_by'   => 'integer',
        'declined_by'   => 'integer',
        'status'        => 'string',
        'flag'          => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    //Relation Start
    public function clients()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function requestFile()
    {
        return $this->hasOne(RequestFile::class, 'request_id', 'id');
    }

    public static function createData($requestType, $clientId,$code,$name, $email, $mobile, $amount, $bankAccount, $date, $path)
    {
        Fund::create([
            'client_id'     => $clientId,
            'client_name'   => $name,
            'amount'        => $amount,
            'ac_no'         => $bankAccount,
            'bank_slip'     => $path,
            'withdraw_date' => $date,
            'category'      => $requestType,
            'approved_by'   => Auth::id(),
            'status'        => 'approved',
        ]);
    }
}