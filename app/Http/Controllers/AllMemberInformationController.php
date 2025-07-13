<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AllMemberInformationController extends Controller
{
    public function viewallmember($matrix_no)
    {
        $listalluser = User::select([
            'users.matrix_no',
            'users.name',
            'users.email',
            'studentinformation.profile_picture',
            'studentinformation.phone_number',
            'studentinformation.date_of_birth',
            'studentinformation.address',
            'studentinformation.year',
            'studentinformation.semester',
            'studentinformation.bio',
            'studentinformation.gender',
            'studentinformation.position'
        ])
            ->join('studentinformation', 'users.matrix_no', '=', 'studentinformation.matrix_no')
            ->get();
        return view('manage_member.all-mem-profile-detail', compact('listalluser'));
    }
}
