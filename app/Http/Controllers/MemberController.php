<?php

namespace App\Http\Controllers;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $matrixNo = $user->matrix_no;

        // Get all meetings and map each with user's attendance status
        $meetings = Meeting::orderBy('date')->get()->map(function ($meeting) use ($matrixNo) {
            $attendance = Attendance::where('matrix_no', $matrixNo)
                ->where('meeting_id', $meeting->id)
                ->first();

            $meeting->user_status = $attendance ? $attendance->status : 'pending';
            return $meeting;
        });

        $meetingCount = $meetings->count(); // or just Meeting::count();

        return view('member.mem-dashboard', compact('meetings', 'meetingCount'));
    }

    public function viewmemprofile()
    {
        return view('member.mem-profile'); // Blade view for members
    }

}
