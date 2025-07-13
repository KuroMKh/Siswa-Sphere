<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    // Specify the actual table name
    protected $table = 'studentinformation';

    protected $fillable = [
        'matrix_no',
        'profile_picture',
        'phone_number',
        'date_of_birth',
        'gender',
        'address',
        'year',
        'semester',
        'position',
        'bio',
    ];

    // Optional: define relation to User
    public function user()
    {
        return $this->belongsTo(User::class, 'matrix_no', 'matrix_no');
    }
}