<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'created_by',
        'category',
    ];

    public function funds()
    {
        return $this->hasMany(Fund::class, 'id', 'id');
    }
}
