<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
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

        return view('dashboard', compact('meetings', 'meetingCount'));
    }

    public function newmeeting()
    {
        return view('manage_meeting.create_meeting');
    }

    public function create()
    {
        return view('manage_member.add-mem-dashboard');
    }

    public function list()
    {
        $listalluser = User::select(['matrix_no', 'name', 'position'])->get();
        $usercount = $listalluser->count();
        $positiondropdown = User::select('position')->distinct()->pluck('position');

        // Pass the data to the view
        return view('manage_member.list-all-mem-dashboard', compact('listalluser', 'usercount', 'positiondropdown'));
    }


}
