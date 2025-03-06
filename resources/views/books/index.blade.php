@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Your Books</h1>
    <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Book</a>
    <div class="mt-4">
        @foreach ($books as $book)
            <div class="border p-4 mb-4 rounded">
                <h2 class="text-xl font-bold">{{ $book->title }}</h2>
                <p>{{ $book->author }}</p>
                <p>{{ $book->description }}</p>
                <p>Rating: {{ $book->rating }}</p>
                <div class="mt-2">
                    <a href="{{ route('books.edit', $book) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection