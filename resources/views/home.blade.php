<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h1>
    <!-- <p>Email: {{ Auth::user()->email }}</p>
    <p>Email Verified: {{ Auth::user()->email_verified_at ? 'Yes' : 'No' }}</p> -->
</div>
@endsection