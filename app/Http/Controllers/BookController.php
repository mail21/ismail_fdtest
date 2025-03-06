<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;



class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('user_id', auth()->id())->get();
        return view('books.index', compact('books'));
    }

    public function landing(Request $request)
    {
        $books = Book::query();
    
        // Filter by author
        if ($request->has('author')) {
            $books->where('author', 'like', "%{$request->author}%");
        }
    
        // Filter by rating
        if ($request->has('rating')) {
            $books->where('rating', '>=', $request->rating);
        }
    
        // Paginate results
        $books = $books->paginate(10);
        return view('landing', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'thumbnail' => 'nullable|url',
            'rating' => 'required|integer|between:1,5',
        ]);

        Book::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'thumbnail' => 'nullable|url',
            'rating' => 'required|integer|between:1,5',
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}