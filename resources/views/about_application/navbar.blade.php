@php
    use Illuminate\Support\Facades\Request;
    use App\Models\Application;
    $application_id = Request::route('application_id');
    $app = Application::find($application_id);
@endphp
<input type="hidden" name="application_id" id="application_id" value="{{$application_id}}">
<input type="hidden" name="package_name" id="package_name" value="{{$app->package_name}}" />
<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            {{-- <li class="nav-item active">
                <a class="nav-link" href="#">Dashboard</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="{{url('message/'.$application_id)}}">Message</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('feedback/'.$application_id)}}">FeedBack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('application-info/'.$application_id)}}">ETC</a>
            </li>
        </ul>
    </div>
</nav>
