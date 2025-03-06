<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;



class BookController extends Controller
{
    public function index(Request $request)
    {
        // Start with all books
        $books = Book::query();

        // Filter by author
        if ($request->filled('author')) {
            $books->where('author', 'like', "%{$request->author}%");
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $books->where('rating', '>=', $request->rating);
        }

        // Search by title
        if ($request->filled('search')) {
            $search = $request->search;
            $books->where('title', 'like', "%$search%");
        }

        // Paginate the results (5 items per page)
        $books = $books->paginate(5);

        return view('books.index', compact('books'));
    }

    public function landing(Request $request)
    {
        $books = Book::query();
        $request->validate([
            'rating' => 'integer|min:1|max:5', // Example validation: rating must be an integer between 1 and 5
        ]);
    
        // Filter by author
        if ($request->filled('author')) {
            $books->where('author', 'like', "%{$request->author}%");
        }
    
        // Filter by rating
        if ($request->filled('rating')) {
            $books->where('rating', '=', $request->rating);
        }
    
        // Paginate results
        $books = $books->paginate(5);
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

        try {
            Book::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'thumbnail' => $request->thumbnail,
                'rating' => $request->rating,
            ]);

            return redirect()->route('books.index')->with('success', 'Book added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to add book: ' . $e->getMessage());
        }
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

        try {
            $book->update($request->all());
            return redirect()->route('books.index')->with('success', 'Book updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to update book: ' . $e->getMessage());
        }
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to delete book: ' . $e->getMessage());
        }
    }

}