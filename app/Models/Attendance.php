<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'matrix_no',
        'meeting_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'matrix_no', 'matrix_no');
    }

    public function meeting()
    {
        return $this->belongsTo(\App\Models\Meeting::class);
    }
}
