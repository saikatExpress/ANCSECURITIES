<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'work_title',
        'status',
        'description',
        'created_by',
        'updated_by',
        'status',
        'flag',
    ];

    //Relation Start
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
