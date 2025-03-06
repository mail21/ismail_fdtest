<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', "%$query%")
                     ->orWhere('email', 'like', "%$query%")
                     ->get();
        return view('users.index', compact('users'));
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');
        $users = User::where('email_verified_at', $status ? '!=' : '=', null)->get();
        return view('users.index', compact('users'));
    }
}