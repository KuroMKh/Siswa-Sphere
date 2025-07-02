<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AllMemberInformationController extends Controller
{
    public function viewallmember($matrix_no)
    {
        $user = User::where('matrix_no', $matrix_no)->firstOrFail();
        return view('manage_member.all-mem-profile-detail', compact('user'));
    }
}
