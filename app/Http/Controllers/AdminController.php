<?php

namespace App\Http\Controllers;

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
        return view('manage_member.list-all-mem-dashboard');
    }
}
