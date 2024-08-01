<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_slug',
        'name',
        'slug',
        'email',
        'department_id',
        'designation_id',
        'mobile',
        'permanent_address',
        'present_address',
        'basic_salary',
        'nid',
        'birth_certificate',
        'nationality',
        'machine_id',
        'status',
        'flag',
        'staff_image',
    ];

    protected $casts = [
        'id'                => 'integer',
        'branch_slug'       => 'integer',
        'name'              => 'string',
        'slug'              => 'string',
        'email'             => 'string',
        'department_id'     => 'integer',
        'designation_id'    => 'integer',
        'mobile'            => 'string',
        'permanent_address' => 'string',
        'present_address'   => 'string',
        'basic_salary'      => 'integer',
        'nid'               => 'string',
        'birth_certificate' => 'string',
        'nationality'       => 'string',
        'machine_id'        => 'string',
        'status'            => 'string',
        'flag'              => 'integer',
        'staff_image'       => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    // Relation Start
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
}
