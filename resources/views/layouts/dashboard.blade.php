<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/dashboard-store-logo.svg" alt="" class="my-4" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : '' }}"
              >Dashboard
            </a>
            <a
              href="{{ route('dashboard-products') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/products*')) ? 'active' : '' }}"
              >My Products</a
            >
            <a
              href="{{ route('dashboard-transactions') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }}"
              >Transactions</a
            >
            <a
              href="{{ route('dashboard-settings-store') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings*')) ? 'active' : '' }}"
              >Store Settings</a
            >
            <a
              href="{{ route('dashboard-settings-account') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/accounts*')) ? 'active' : '' }}"
              >My Account</a
            >
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit"
                  class="list-group-item list-group-item-action">
                  Sign Out
              </button>
            </form>
          </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav
            class="navbar navbar-expand-lg navbar-light navbar-store fixed-top ml-auto mr-0"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <button
                class="btn btn-secondary d-md-none mr-auto ml-2"
                id="menu-toggle"
              >
                &laquo; Menu
              </button>
              <button
                class="navbar-toggler ml-auto mr-2"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex ml-auto">
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
                      <a href="{{ route('dashboard') }}" class="dropdown-item"
                        >Dashboard</a
                      >
                      <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item"
                        >Settings</a
                      >
                      <div class="dropdown-divider"></div>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="dropdown-item">
                            Logout
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
              </div>
            </div>
          </nav>

          {{-- <!-- Section Content --> --}}
            @yield('content')
        </div>
      </div>
    </div>

    {{-- script --}}
    @stack('prepend-script')
    @include('includes.script')
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')

  </body>
</html>
