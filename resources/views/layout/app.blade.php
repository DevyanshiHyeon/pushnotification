@include('layout.links')
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layout.sidebar')
            <div class="layout-page">
                @include('layout.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('contant')
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @include('layout.scripts')
</body>

</html>
