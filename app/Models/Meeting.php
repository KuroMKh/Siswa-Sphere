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
        'minute_path',
        'financial_path',
        'official_letter_path',
        'meeting_status',

    ];

    public function attendances()
    {
        return $this->hasMany(\App\Models\Attendance::class);
    }
}
