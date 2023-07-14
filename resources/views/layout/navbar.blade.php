<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                {{-- <i class="bx bx-collection fs-4 lh-0"></i> --}}
                    @php
                        use Illuminate\Support\Facades\Request;
                        use App\Models\Application;
                        $application_id = Request::route('application_id');
                        if(empty($application_id)){$app_name = '';}
                        else{
                        $app = Application::find($application_id);
                        $app_name = $app->name;
                        }
                    @endphp
                    <span class="fw-bold">{{$app_name}}</span>
            </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                {{-- <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"> --}}
                <a class="nav-link dropdown-toggle hide-arrow" href="{{url('logout')}}" >
                        <i class="bx bx-power-off fs-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if (isset(Auth::user()->email))
                        <li>
                            <a class="dropdown-item" href="{{url('logout')}}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    @else
                        <script>
                            window.location = "/";
                        </script>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</nav>
