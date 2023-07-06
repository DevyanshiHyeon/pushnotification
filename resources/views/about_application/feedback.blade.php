@extends('layout.app')
@section('contant')
@include('about_application.navbar')
<div class="row mt-4">
    <div class="col-12 grid-margin stretch-card">

        <div class="card mb-4">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
                <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-header">Feedbacks</h5>
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
                                    Title
                                </th>
                                <th>
                                    Message
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
<script src="{{url('js/custom/about_application/feedback.js')}}"></script>
@endsection
