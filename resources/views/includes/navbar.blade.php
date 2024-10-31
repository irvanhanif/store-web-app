<nav 
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
    data-aos="fade-down"
>
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.svg') }}" alt="logo" />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarResponsive"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">Categories</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success px-4 text-white"
                        >Sign In</a
                        >
                    </li>
                @endguest
            </ul>
            @auth
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a
                            href="#"
                            class="nav-link"
                            id="navbarDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                        >
                            <img
                                src="{{ asset('images/icon-user.png') }}"
                                alt=""
                                class="rounded-circle mr-2 profile-picture"
                            />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            @if (Auth::user()->roles == 'ADMIN')
                                <a href="{{ route('admin-dashboard') }}" class="dropdown-item">Dashboard</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            @endif
                            <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item">Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            @if ($carts > 0)
                                <img src="{{ asset('images/icon-cart-filled.svg') }}" alt="" />
                                <div class="card-badge">{{ $carts }}</div>
                            @else
                                <img src="{{ asset('images/icon-cart-empty.svg') }}" alt="" />
                            @endif
                        </a>
                    </li>
                </ul>
                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="{{ route('dashboard-settings-account') }}" class="nav-link"> Hi, {{ Auth::user()->name }} </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block"> cart </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>