<?php

namespace App\Http\Controllers;
use App\Models\StudentInformation;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {


        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'year' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:3',
        ]);

        $user = auth()->user();

        // Use updateOrCreate to either update existing record or create new one
        StudentInformation::updateOrCreate(
            ['matrix_no' => $user->matrix_no], // Find by matrix_no
            [
                'profile_picture' => $request->profile_picture,
                'phone_number' => $request->phone_number,
                'bio' => $request->bio,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'year' => $request->year,
                'semester' => $request->semester,
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }
}