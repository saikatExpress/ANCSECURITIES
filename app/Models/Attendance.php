<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_date',
        'year',
        'staff_id',
        'in_time',
        'out_time',
        'status',
    ];

    // Relation Start
    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
}
