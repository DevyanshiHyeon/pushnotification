<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark h-20">
    <a class="navbar-brand" href="#" style="padding-left: 1.5%">Notification Penal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <a class="nav-link" href="{{url('/application')}}">
            <button class="btn btn-primary">Applicaions</button>
        </a>
        @if (isset(Auth::user()->email))
        <a href="{{ url('/logout') }}">
        <i class="mdi mdi-logout fs-3 text-warning me-3"></i>
        </a>
        @else
        <script>
            window.location = "/";
        </script>
    @endif
        <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
            <li class="nav-item">
                <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse"
                    data-target="#collapseSubItems2" aria-controls="collapseSubItems2" aria-expanded="false"> Screen
                    Casting
                </a>
                <ul class="nav-second-level collapse" id="collapseSubItems2" data-parent="#navAccordion">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/message-dashboard') }}">
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/message') }}">
                            <span class="nav-link-text">Message</span>
                        </a>
                    </li>
                </ul>
            </li>
            @php
                $applications = App\Models\Application::all();
            @endphp
            @foreach ($applications as $application)
            <li class="nav-item">
                <a class="nav-link" href="{{url('application-info/'.$application->id)}}">{{$application->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>
