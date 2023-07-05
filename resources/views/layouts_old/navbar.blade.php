<nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container-fluid">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="javascript:void(0)">Screen Casting</a>
                <a class="navbar-brand brand-logo-mini" href="javascript:void(0)"><img
                        src="{{ url('images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        <span class="nav-profile-name">
                            @if (isset(Auth::user()->name))
                                {{ Auth::user()->name }}
                            @else
                                <script>
                                    window.location = "/";
                                </script>
                            @endif
                        </span>
                        <span class="online-status"></span>
                    </a>
                    @if (isset(Auth::user()->email))
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ url('/logout') }}">
                                <i class="mdi mdi-logout text-primary"></i>
                                Logout
                            </a>
                        </div>
                    @else
                        <script>
                            window.location = "/";
                        </script>
                    @endif
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </div>
</nav>
