<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\StudentInformation;
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

        $meetings = Meeting::orderBy('date')->paginate(4);

        $meetingCount = $meetings->total(); // Total meetings including pagination
        $meetingFinished = Meeting::where('meeting_status', 'Finished')->count();
        $meetingCancelled = Meeting::where('meeting_status', 'Cancelled')->count();
        return view('dashboard', compact('meetings', 'meetingCount', 'meetingFinished', 'meetingCancelled'));
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
        $usercount = $listalluser->count();
        $positiondropdown = StudentInformation::select('position')->distinct()->pluck('position');

        // Pass the data to the view
        return view('manage_member.list-all-mem-dashboard', compact('listalluser', 'usercount', 'positiondropdown'));
    }

    public function viewmeetingdocumentation()
    {

        $user = Auth::user();
        $matrixNo = $user->matrix_no;
        $meetings = Meeting::orderBy('date')->paginate(4);
        $meetingCount = $meetings->total(); // Total meetings including pagination
        return view('manage_meeting.admin-meeting-documentation', compact('meetings'));
    }


}
