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
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    @stack('addon-style')
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="{{ asset('images/admin.png') }}" alt="" class="my-4" style="max-width: 150px" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('admin-dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}"
              >Dashboard
            </a>
            <a
              href="{{ route('product.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/product*')) ? 'active' : '' }}"
              >Products</a
            >
            <a
              href="{{ route('category.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : '' }}"
              >Categories</a
            >
            <a
              href="{{ route('gallery.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/gallery*')) ? 'active' : '' }}"
              >Galleries</a
            >
            <a
              href="{{ route('transaction.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/transaction*')) ? 'active' : '' }}"
              >Transactions</a
            >
            <a
              href="{{ route('user.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/user*')) ? 'active' : '' }}"
              >Users</a
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
                      Hi, Angga
                    </a>
                    <div class="dropdown-menu">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                          class="dropdown-item">Logout
                        </button>
                      </form>
                    </div>
                  </li>
                </ul>
                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                  <li class="nav-item">
                    <a href="#" class="nav-link"> Hi, Angga </a>
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')

  </body>
</html>
