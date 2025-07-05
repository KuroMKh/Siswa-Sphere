<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class updateattendance extends Controller
{
    public function storeAttendance(Request $request, $id)
    {
        $user = Auth::user();
        $matrixNo = $user->matrix_no;

        $request->validate([
            'attendance_status' => 'required|in:Attend,Absent',
        ]);

        $existing = Attendance::where('meeting_id', $id)
            ->where('matrix_no', $matrixNo)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already marked your attendance.');
        }

        Attendance::create([
            'meeting_id' => $id,
            'matrix_no' => $matrixNo,
            'status' => $request->attendance_status,
        ]);

        return redirect()->route('member.mem-dashboard')->with('success', 'Attendance recorded!');
    }

}
