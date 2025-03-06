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

    <!-- Book Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Author</th>
                    <th class="border border-gray-300 px-4 py-2">Rating</th>
                    <th class="border border-gray-300 px-4 py-2">Uploaded</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $book->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $book->author }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $book->rating }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $book->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No books found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
