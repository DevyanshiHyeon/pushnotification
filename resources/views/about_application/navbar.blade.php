@php
    use Illuminate\Support\Facades\Request;
    use App\Models\Application;
    $application_id = Request::route('application_id');
    $app = Application::find($application_id);
@endphp
<input type="hidden" name="application_id" id="application_id" value="{{ $application_id }}">
<input type="hidden" name="package_name" id="package_name" value="{{ $app->package_name }}" />
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('message/' . $application_id) }}">Message</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('feedback/' . $application_id) }}">FeedBack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('application-info/' . $application_id) }}">ETC</a>
            </li>
        </ul>
    </div>
</nav> --}}
{{--  --}}

<div class="row">
    <div class="col-xl-6">
        {{-- <h6 class="text-muted">Basic</h6> --}}
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item">
                    <a href="{{ url('message/' . $application_id) }}" type="button"
                        class="nav-link @if (url()->current() == url('message/' . $application_id)) active @endif" role="tab">
                        Message
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('feedback/' . $application_id) }}" type="button"
                        class="nav-link @if (url()->current() == url('feedback/' . $application_id)) active @endif" role="tab">
                        FeedBack
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('application-info/' . $application_id) }}" type="button"
                        class="nav-link @if (url()->current() == url('application-info/' . $application_id)) active @endif" role="tab">
                        ETC
                    </a>
                </li>
                <li class="nav-item">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal2" type="button"
                        class="nav-link" role="tab">
                        Instant Notification
                    </button>
                </li>
            </ul>
        </div>
    </div>
</div>
{{--  --}}
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{ url('/send-instant-notification/'.$application_id) }}">@csrf
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <input type="hidden" name="is_instant" value="is_instant" />
                    <div class="form-group mb-2 row">
                        <label class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-sm-3 col-form-label">Message</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="message" class="form-control" placeholder="Title" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
