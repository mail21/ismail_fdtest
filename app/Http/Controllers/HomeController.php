<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Start with all users
        $users = User::query();

        // Filter by email verification status
        if ($request->filled('verified')) {
            $verified = $request->verified === 'verified';
            $users->whereNotNull('email_verified_at', $verified ? '!=' : '=', null);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            });
        }

        // Paginate the results
        $users = $users->paginate(10);

        return view('home', compact('users'));
    }
}
