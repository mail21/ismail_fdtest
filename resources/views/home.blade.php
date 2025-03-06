<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">User List</h1>

    <!-- Filter and Search Form -->
    <form action="{{ route('home') }}" method="GET" class="mb-4">
        <div class="flex gap-4">
            <!-- Filter by Verification Status -->
            <select name="verified" class="border p-2 rounded">
                <option value="">All Users</option>
                <option value="verified" {{ request('verified') == 'verified' ? 'selected' : '' }}>Verified</option>
                <option value="unverified" {{ request('verified') == 'unverified' ? 'selected' : '' }}>Unverified</option>
            </select>

            <!-- Search by Name or Email -->
            <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}"
                   class="border p-2 rounded flex-grow">

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    <!-- User Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Email Verification Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">
                            @if ($user->email_verified_at)
                                <span class="text-green-600">Verified</span>
                            @else
                                <span class="text-red-600">Not Verified</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection