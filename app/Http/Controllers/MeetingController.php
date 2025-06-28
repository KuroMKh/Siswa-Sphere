<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Meeting;

class MeetingController extends Controller
{
    public function show($id)
    {
        $meeting = Meeting::findOrFail($id);
        return view('member.mem-meetingdetail', compact('meeting'));
    }
}
