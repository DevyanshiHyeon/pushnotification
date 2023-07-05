@extends('layouts.app')
@section('contant')
<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">

        <div class="card">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
                <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title">Applications</h4>
                    </div>
                    <div class="col-md-4">
                        <a class="float-end" href="{{url('/application/create')}}">
                            <button class="btn btn-primary">Create Applicaion</button>
                        </a>
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
                                    Application name
                                </th>
                                <th>
                                    Package Name
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
<script src="{{url('js/custom/application/index.js')}}"></script>
@endsection
