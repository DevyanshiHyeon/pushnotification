@extends('layout.app')
@section('style')
@endsection
@section('contant')
    <div class="row mt-4">
        <div class="col-12 grid-margin stretch-card">

            <div class="card mb-4">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-header">Add Message</h5>
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
                                        <label class="col-sm-3 col-form-label">Message</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="message" class="form-control" placeholder="Title"></textarea>
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
                    <h5 class="card-header">Message Data</h5>
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
                                        Message
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
                        <h5 class="modal-title" id="exampleModalLabel">Create Message</h5>
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
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="{{ url('/js/custom/message/index.js') }}"></script>
@endsection
