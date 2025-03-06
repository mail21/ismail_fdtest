<!-- resources/views/books/landing.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Books</h1>

    <!-- Filter Form -->
    <form action="{{ route('landing') }}" method="GET" class="mb-4">
        <div class="flex gap-4">
            <input type="text" name="author" placeholder="Filter by author" value="{{ request('author') }}"
                   class="border p-2 rounded">
            <input type="number" name="rating" placeholder="Filter by rating" value="{{ request('rating') }}"
                   class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    <!-- Book List -->
    <div class="space-y-4">
        @foreach ($books as $book)
            <div class="border p-4 rounded">
                <h2 class="text-xl font-bold">{{ $book->title }}</h2>
                <p>Author: {{ $book->author }}</p>
                <p>Rating: {{ $book->rating }}</p>
                <p>Uploaded: {{ $book->created_at->format('Y-m-d') }}</p>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection