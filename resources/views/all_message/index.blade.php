@extends('layout.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('contant')
    @php
        use Illuminate\Support\Facades\Request;
        use App\Models\Application;
        $application_id = Request::route('application_id');
        $app = Application::find($application_id);
    @endphp
    @include('about_application.navbar')
    <div class="row mt-4">
        <div class="col-12 grid-margin stretch-card">
            <div class="card mb-4">
                <div class="alert alert-success" id="myElem" style="display:none">
                    <p id="alert-text"></p>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-header">Message</h5>
                        </div>
                        {{-- <div class="col-md-4">
                            <button class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" >Instatnt message</button>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="template-demo">
                        <form id="form" method="POST" action="{{ url('message/' . $application_id) }}">@csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Message</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="message" class="form-control" placeholder="Title" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Send Time</label>
                                        <div class="col-sm-9">
                                            <input type="time" name="time" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary mb-2"
                                        onclick="create_message()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 grid-margin stretch-card">
            <div class="card mb-4">
                {{-- @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif --}}
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-header">Message</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="template-demo">
                        <table class="table datatable" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        Sr_no
                                    </th>
                                    <th>
                                        message
                                    </th>
                                    <th>
                                        description
                                    </th>
                                    <th>Daily Time</th>
                                    <th>Status</th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Msg Modal --}}
    <div class="modal fade" id="editmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('message/' . $application_id) }}" method="POST" id="edit_form">@csrf
                    <input type="hidden" name="message_id" value="" id="message_id" />
                    <input type="hidden" name="application_id" value="{{ $application_id }}" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Enter Name" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Message</label>
                                <input type="text" id="message" name="message" class="form-control"
                                    placeholder="xxxx@xxx.xx" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="form_submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end Edit Msg Modal --}}

    <!-- Modal HTML -->
    {{-- <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" method="POST"
                        action="{{ url('/send-instant-notification/' . $application_id) }}">
                        @csrf
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <input type="hidden" name="is_instant" value="is_instant" />
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="form-group row">
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
    </div> --}}
@endsection
@section('script')
    <script src="{{ url('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('js/custom/all_msg/index.js') }}"></script>
@endsection
