    <!-- base:js -->
    <script src="{{('vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{('js/template.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{('vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js')}}"></script>
    <script src="{{('vendors/justgage/raphael-2.1.4.min.js')}}"></script>
    <script src="{{('vendors/justgage/justgage.js')}}"></script>
    <script src="{{('js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="{{('js/dashboard.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
{{-- toaster --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
        setTimeout(() => {
    $('.alert').hide();
  }, 5000);
    {{-- sidebar --}}
        $(document).ready(function() {
          $('.nav-link-collapse').on('click', function() {
            $('.nav-link-collapse').not(this).removeClass('nav-link-show');
            $(this).toggleClass('nav-link-show');
          });
        });
        </script>
    {{-- sidebar --}}
@yield('script')
