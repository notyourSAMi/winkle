<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Winkel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="/Shop">Shop</a>
                        <a class="dropdown-item" href="/Cart">Cart</a>
                    </div>
                </li>
                <li class="nav-item"><a href="/About" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/Contact" class="nav-link">Contact</a></li>
                <li class="nav-item cta cta-colored"><a href="/Cart" class="nav-link"><span
                            class="icon-shopping_cart"></span>{{ count((array) session('cart')) }}</a></li>
                @if (auth()->check())
                    <!-- User is logged in, so display the Logout button -->
                    {{-- <form action="" method="POST"> --}}
                        {{-- @csrf --}}
                        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
                    {{-- </form> --}}
                @else
                    <!-- User is not logged in, so display the Login button -->
                    <li class="nav-item"><a href="{{ route('Login') }}" class="nav-link">Login</a></li>
                    @endif


            </ul>
        </div>
    </div>
</nav>
