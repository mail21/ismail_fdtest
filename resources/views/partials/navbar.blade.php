<nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-xl font-bold">Book Management</a>
        <div>
            @auth
                <a href="{{ route('books.index') }}" class="mr-4">Books</a>
                <a href="{{ route('profile.edit') }}" class="mr-4">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>
</nav>