<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;

class LandingController extends Controller{
    public function index(Request $request)
    {
        $books = Book::query();
        $request->validate([
            'rating' => 'integer|min:1|max:5', // Example validation: rating must be an integer between 1 and 5
        ]);

        if ($request->filled('author')) {
            $books->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->filled('rating')) {
            $books->where('rating', '=', $request->rating);
        }

        if ($request->filled('date')) {
            $books->whereDate('created_at', $request->date);
        }

        $books = $books->paginate(10);

        return view('landing', compact('books'));
    }     
}
