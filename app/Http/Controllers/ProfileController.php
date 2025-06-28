<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1|max:5',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $user = auth()->user();

        $user->year = $request->year;
        $user->semester = $request->semester;
        $user->save(); // ✅ Save to DB

        return back()->with('success', 'Profile updated successfully!');
    }
}
