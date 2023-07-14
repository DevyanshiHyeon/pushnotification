@extends('layout.app')
@section('style')
@endsection
@section('contant')
{{-- @dd($msg) --}}
    <div class="row mt-4">
        <div class="col-12 grid-margin stretch-card">
            <div class="card mb-4">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-header">Add Notification</h5>
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
                        <form id="form" method="POST" @if(isset($msg->perent_id))
                            action="{{ url('create-child-message/'.$msg->perent_id) }}" @else action="{{ url('create-child-message/'.$id) }}"
                        @endif >@csrf
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <input type="hidden" name="parent_id" id="parent_id" value="@if(isset($msg->perent_id)) {{$msg->perent_id}} @else{{$id}} @endif" />
                            @if (isset($msg->id))
                                <input type="hidden" name="msg_id" value="{{$msg->id}}" />
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                            @if (isset($msg->title)) value="{{$msg->title}}" @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="message" class="form-control" placeholder="Description">@if (isset($msg->message)) {{$msg->message}} @endif</textarea>
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
        <div class="col-lg-12 grid-margin stretch-card @if(isset($msg->perent_id)) d-none @endif">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-header">Description Data</h5>
                    <div class="table-responsive">
                        <table class="table @if(isset($msg->perent_id)) @else datatable  @endif " id="myTable">
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
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="{{ url('/js/custom/child/index.js') }}"></script>
@endsection
