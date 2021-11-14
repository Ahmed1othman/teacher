<script src="{{ asset('js/vendorAsset/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{ asset('js/vendorAsset/moment.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/fullcalendar.min.js')}}"></script>
{{--  <script src="{{ asset('js/vendorAsset/datatables.min.js')}}"></script>  --}}
<script src="{{ asset('js/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/jszip.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/bootstrap-notify.min.js') }}" style="opacity: 1;"></script>
<script src="{{ asset('js/vendorAsset/progressbar.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/jquery.barrating.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/select2.full.js')}}"></script>
<script src="{{ asset('js/vendorAsset/nouislider.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/vendorAsset/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/jquery.validate/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/jquery.validate/additional-methods.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/Sortable.js')}}"></script>
<script src="{{ asset('js/vendorAsset/baguetteBox.min.js') }}"></script>

{{-- <script src="{{ asset('js/vendorAsset/cropper.min.js') }}"></script> --}}

<script src="{{ asset('js/vendorAsset/mousetrap.min.js')}}"></script>
<script src="{{ asset('js/vendorAsset/glide.min.js')}}"></script>
<script src="{{ asset('js/dore.script.js')}}"></script>
<script src="{{ asset('js/scripts.js')}}"></script>
<script src="{{ asset('js/crud-ajax.js')}}"></script>




@yield('js')
<script>
  var app_url = "{{ url('/') }}";
  var lang = "{{ app()->getLocale() }}";
</script>

<script>
    $(document).ready(function() {
        $('#default-datatable').DataTable();
        var table = $('#example').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script>

