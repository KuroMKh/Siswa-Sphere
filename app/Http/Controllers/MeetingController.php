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


    public function showadmin($id)
    {
        $meeting = Meeting::findOrFail($id);
        return view('manage_meeting.admin_meetingdetail', compact('meeting'));
    }

    public function createmeeting(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'agenda' => 'required|string',
            'memo' => 'nullable|string',
            'financial_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'minutes_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'official_letter_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'meeting_status' => 'Ongoing',
        ]);


        // Handle file uploads
        if ($request->hasFile('financial_path')) {
            $validated['financial_path'] = $request->file('financial_path')->store('document/financial_path', 'public');
        }

        if ($request->hasFile('minutes_path')) {
            $validated['minutes_path'] = $request->file('minutes_path')->store('document/minutes_path', 'public');
        }

        if ($request->hasFile('official_letter_path')) {
            $validated['official_letter_path'] = $request->file('official_letter_path')->store('document/official_letter_path', 'public');
        }

        // Create the meeting
        $meeting = Meeting::create($validated);

        return redirect()->route('dashboard')->with('success', 'Meeting created successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'meeting_status' => 'required|in:Cancelled,Finished',
        ]);

        $meeting = Meeting::findOrFail($id);
        $meeting->meeting_status = $request->input('meeting_status');
        $meeting->save();

        return redirect()->back()->with('success', 'Meeting status updated successfully!');
    }

}
