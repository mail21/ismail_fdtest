<!-- resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Book List</h1>

    <!-- Filter and Search Form -->
    <form action="{{ route('books.index') }}" method="GET" class="mb-4">
        <div class="flex gap-4">
            <!-- Filter by Author -->
            <input type="text" name="author" placeholder="Filter by author" value="{{ request('author') }}"
                   class="border p-2 rounded">

            <!-- Filter by Rating -->
            <input type="number" name="rating" placeholder="Filter by rating" value="{{ request('rating') }}" min="1" max="5"
                   class="border p-2 rounded">

            <!-- Search by Title -->
            <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}"
                   class="border p-2 rounded flex-grow">

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    <!-- Book Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Author</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Rating</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td class="px-4 py-2 border">{{ $book->title }}</td>
                        <td class="px-4 py-2 border">{{ $book->author }}</td>
                        <td class="px-4 py-2 border">{{ $book->description }}</td>
                        <td class="px-4 py-2 border">{{ $book->rating }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:text-blue-500">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>

    <!-- Add Book Button -->
    <div class="mt-4">
        <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Add Book
        </a>
    </div>
</div>
@endsection