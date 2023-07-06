<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0)" class="app-brand-link">
            <h3 class=" demo menu-text fw-bolder ms-1">Notifications</h3>
        </a>
        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Screen
                    Casting</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('/message-dashboard') }}" class="menu-link">
                        <div data-i18n="Without menu">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/message') }}" class="menu-link">
                        <div data-i18n="Without navbar">Message</div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Applications</span></li>
        @php
            $applications = App\Models\Application::all();
        @endphp
        @foreach ($applications as $application)
            <li class="menu-item">
                <a href="{{ url('application-info/' . $application->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">{{ $application->name }}</div>
                </a>
            </li>
        @endforeach
    </ul>
</aside>
