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

        return redirect()->route('dashboard')->with('success', 'Meeting status updated successfully!');
    }

    public function updateDocument(Request $request, $id, $type)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $meeting = Meeting::findOrFail($id);

        $file = $request->file('document');
        $filename = $type . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('documents', $filename, 'public');

        // Update correct column based on type
        if ($type === 'financial') {
            $meeting->financial_path = 'storage/' . $path;
        } elseif ($type === 'minutes') {
            $meeting->minutes_path = 'storage/' . $path;
        } elseif ($type === 'official_letter') {
            $meeting->official_letter_path = 'storage/' . $path;
        } else {
            return back()->with('error', 'Invalid document type');
        }

        $meeting->save();

        return back()->with('success', ucfirst($type) . ' document updated successfully!');
    }

    public function updateAgendaMemo(Request $request, $id, $type)
    {

        if ($type === 'agenda') {
            $request->validate([
                'agenda' => 'required|string',
            ]);
            $meeting = Meeting::findOrFail($id);
            $meeting->agenda = $request->input('agenda'); // Assign new agenda
            $meeting->save();

        } elseif ($type === 'memo') {
            $request->validate([
                'memo' => 'required|string',
            ]);
            $meeting = Meeting::findOrFail($id);
            $meeting->memo = $request->input('memo'); //Assign Memo
            $meeting->save();
        }

        return back()->with('success', ucfirst($type) . '  updated successfully!');
    }

    public function updateDateTime(Request $request, $id)
    {

        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
        $meeting = Meeting::findOrFail($id);
        $meeting->date = $request->input('date');
        $meeting->time = $request->input('time');
        $meeting->save();

        return back()->with('success', 'updated successfully!');
    }

}
