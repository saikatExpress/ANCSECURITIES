<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'father_name',
        'mother_name',
        'gender',
        'dob',
        'occupation',
        'address',
        'city',
        'postal_code',
        'division',
        'country',
        'mobile',
        'email',
        'nid_no',
        'nid_attachment',
        'user_photo',
        'user_signature',
        'bank_name',
        'branch_name',
        'bank_account_no',
        'routing_number',
        'cheque_leaf',
        'nominee_name',
        'n_relationship',
        'percentage',
        'n_mobile',
        'n_nid',
        'n_nid_attachment',
        'n_photo',
        'n_signature',
        'j_name',
        'j_mobile',
        'j_nid_attachment',
        'j_signature',
        'j_gender',
        'j_nid',
        'j_photo',
    ];
}
