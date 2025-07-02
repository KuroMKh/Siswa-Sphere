<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard');
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
