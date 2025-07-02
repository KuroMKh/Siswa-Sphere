<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateMemberPositionController extends Controller
{
    public function update(Request $request, $matrix_no)
    {
        $request->validate([
            'position' => 'required|string',
        ]);
        $user = User::where('matrix_no', $matrix_no)->firstOrFail();
        $user->position = $request->input('position');
        $user->save();
        return redirect()->back()->with('success', 'Position updated successfully!');
    }
}
