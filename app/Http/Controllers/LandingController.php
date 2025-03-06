<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;

class LandingController extends Controller{
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('author')) {
            $books->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->has('rating')) {
            $books->where('rating', '>=', $request->rating);
        }

        if ($request->has('date')) {
            $books->whereDate('created_at', $request->date);
        }

        $books = $books->paginate(10);

        return view('landing', compact('books'));
    }     
}
