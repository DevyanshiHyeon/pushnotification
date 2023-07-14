@extends('layout.app')
@section('style')
<link rel="stylesheet" href="{{url('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection
@section('contant')
    <div class="row mt-4">
        <div class="col-12 grid-margin stretch-card">

            <div class="card mb-4">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-header">Create Notification</h5>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Instant
                                Notification</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="template-demo">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="form" method="POST" action="{{ url('/message/create') }}">@csrf
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="message" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Send Time</label>
                                        <div class="col-sm-9">
                                            <input type="time" name="time" class="form-control">
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-header">Notifications</h5>
                    <div class="table-responsive">
                        <table class="table datatable" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        Sr_no
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Daily Time
                                    </th>
                                    <th>
                                        Status
                                    </th>
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
    <!-- Modal HTML -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" method="POST" action="{{ url('/message/create') }}">@csrf
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <input type="hidden" name="is_instant" value="is_instant" />
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="message" class="form-control" placeholder="Description" required></textarea>
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
        <div class="modal fade" id="editmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" id="edit_form">@csrf
                        <input type="hidden" name="message_id" value="" id="message_id" />
                        {{-- <input type="hidden" name="application_id" value="{{ $application_id }}" /> --}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        placeholder="Enter Name" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Description</label>
                                    <input type="text" id="message" name="message" class="form-control"
                                        placeholder="xxxx@xxx.xx" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">Send Time</label>
                                    <input type="time" id="send_time" name="send_time" class="form-control"
                                     required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="form_submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
</script>
<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}" ></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="{{ url('/js/custom/message/index.js') }}"></script>
@endsection
