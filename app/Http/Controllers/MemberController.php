<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display the member dashboard with meetings and attendance statistics
     */
    public function index()
    {
        $user = Auth::user();
        $matrixNo = $user->matrix_no;

        $meetings = Meeting::orderBy('date')->paginate(4);

        $meetings->each(function ($meeting) use ($matrixNo) {
            $attendance = Attendance::where('matrix_no', $matrixNo)
                ->where('meeting_id', $meeting->id)
                ->first();

            $meeting->user_status = $attendance ? $attendance->status : 'Pending';
            if ($attendance) {
                if ($attendance->status === 'Attend') {
                    $meeting->absent_reason = 'You decided to attend';
                } elseif ($attendance->status === 'Absent') {
                    $meeting->absent_reason = $attendance->absent_reason;
                } else {
                    $meeting->absent_reason = 'No record';
                }
            } else {
                $meeting->absent_reason = 'No attendance found';
            }
        });

        $meetingCount = $meetings->total(); // Total meetings including pagination
        $meetingAttend = Attendance::where('matrix_no', $matrixNo)->where('status', 'Attend')->count();
        $meetingAbsent = Attendance::where('matrix_no', $matrixNo)->where('status', 'Absent')->count();

        return view('member.mem-dashboard', compact('meetings', 'meetingCount', 'meetingAttend', 'meetingAbsent'));
    }

    /**
     * Display the member profile page
     */
    public function viewmemprofile()
    {
        return view('member.mem-profile');
    }


    public function viewmeetingdocumentation()
    {

        $user = Auth::user();
        $matrixNo = $user->matrix_no;

        $meetings = Meeting::orderBy('date')->paginate(4);

        $meetingCount = $meetings->total(); // Total meetings including pagination
      
        return view('member.mem-meeting-documentation', compact('meetings'));
    }
}