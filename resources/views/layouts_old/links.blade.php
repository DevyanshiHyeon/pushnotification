<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Screen Casting</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{url('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}" />
    <style>
        .error{
            color: red;
        }
    </style>
    {{-- sidebar --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            padding-top: 4.5rem;
            margin-bottom: 4.5rem;
        }
        .footer {
          position: absolute;
          bottom: 0;
          width: 100%;
          height: 3.5rem;
          line-height: 3.5rem;
          background-color: #ccc;
        }
        .bg-dark {
            background-color: #6a9aca!important;
        }
        .nav-link:hover {
          transition: all 0.4s;
        }
        .nav-link-collapse:after {
          float: right;
          content: '\f067';
          font-family: 'FontAwesome';
        }
        .nav-link-show:after {
          float: right;
          content: '\f068';
          font-family: 'FontAwesome';
        }
        .nav-item ul.nav-second-level {
          padding-left: 0;
        }
        .nav-item ul.nav-second-level > .nav-item {
          padding-left: 20px;
        }
        @media (min-width: 992px) {
          .sidenav {
            position: absolute;
            top: 0;
            left: 0;
            width: 230px;
            height: calc(100vh - 3.5rem);
            margin-top: 3.5rem;
            background: #343a40;
            box-sizing: border-box;
            border-top: 1px solid rgba(0, 0, 0, 0.3);
          }
          .navbar-expand-lg .sidenav {
            flex-direction: column;
          }
          .content-wrapper {
            margin-left: 230px;
          }
          .footer {
            width: calc(100% - 230px);
            margin-left: 230px;
          }
        }
        </style>
    {{-- sidebar --}}
     {{-- datatable --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
{{-- toaster --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" /> --}}
@yield('style')
</head>
