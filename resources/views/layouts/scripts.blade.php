 <!-- Jquery JS-->
 <script src="{{ asset('admin_essentials/vendor/jquery-3.2.1.min.js') }}"></script>
 <!-- Bootstrap JS-->
 <script src="{{ asset('admin_essentials/vendor/bootstrap-4.1/popper.min.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
 <!-- Vendor JS       -->
 <script src="{{ asset('admin_essentials/vendor/slick/slick.min.js') }}">
 </script>
 <script src="{{ asset('admin_essentials/vendor/wow/wow.min.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/animsition/animsition.min.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
 </script>
 <script src="{{ asset('admin_essentials/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/counter-up/jquery.counterup.min.js') }}">
 </script>
 <script src="{{ asset('admin_essentials/vendor/circle-progress/circle-progress.min.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/chartjs/Chart.bundle.min.js') }}"></script>
 <script src="{{ asset('admin_essentials/vendor/select2/select2.min.js') }}">
 </script>
 <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap4.min.js"></script>
 <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>

 <!-- Main JS-->
 <script src="{{ asset('admin_essentials/js/main.js') }}"></script>
 <script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 5000);
</script>
@yield('script')