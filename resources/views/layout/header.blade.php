<nav class=" pl-3 navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand ml-2 pl-2" href="{{ routec('home') }}">Social Login</a>
	<div>
        @auth
            <form action="{{ routec('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn">Log Out</button>
            </form>
        @endauth
         
        @guest
            <a href="{{ routec('login') }}" class="btn">Login</a>
            <a href="{{ routec('register') }}" class="btn">Sign Up</a>
        @endguest
    </div>
</nav>
