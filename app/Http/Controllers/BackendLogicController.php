<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BackendLogicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users(Request $request)
    {
        $users = User::latest()->paginate(50);
        return view('backend.pages.users', compact('users'));
    }
}
