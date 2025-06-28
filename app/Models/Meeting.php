<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'date',
        'time',
        'agenda',
        'memo',
    ];

    public function attendances()
    {
        return $this->hasMany(\App\Models\Attendance::class);
    }
}
