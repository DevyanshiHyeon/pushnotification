@include('layouts.links')

<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            {{-- @include('layouts.navbar') --}}
        </div>
            @include('layouts.sidebar')
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper" style="padding-right: 13%">
                    <div class="row">
                        <div class="col-sm-6 mb-4 mb-xl-0">
                            <div class="d-lg-flex align-items-center">
                                <div>
                                    <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back!</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('contant')
                </div>
            </div>
        </div>
    </div>
@include('layouts.scripts')
</body>
</html>
