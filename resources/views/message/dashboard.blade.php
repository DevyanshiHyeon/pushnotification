@extends('layout.app')
@section('contant')
    <div class="row mt-4">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-header">Notification Status</h5>
                    <div class="table-responsive">
                        <table class="table datatable" id="datatable">
                            <thead>
                                <tr>
                                    <th>
                                        Sr No
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        New Use
                                    </th>
                                    <th>
                                        Repeted User
                                    </th>
                                    <th>
                                        Success Count
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
    <script src="{{ url('/js/custom/dashboard/index.js') }}"></script>
@endsection
