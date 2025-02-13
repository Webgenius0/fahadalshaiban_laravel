<script src="{{ asset('frontend') }}/js/jquery-3.7.1.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins.js"></script>
<script src="{{ asset('frontend') }}/js/main.js"></script>
<!-- toster css -->
 

{{-- DATA TABLE JS --}}
<script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
{{-- <script src="{{ asset('backend/plugins/datatable/js/butsns.bootstrap5.min.js') }}"></script> --}}
<script src="{{ asset('backend/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
{{-- <script src="{{ asset('backend/plugins/datatable/js/butsns.html5.min.js') }}"></script> --}}
<script src="{{ asset('backend/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/js/table-data.js') }}"></script>

<!-- INDEX JS -->
<script src="{{ asset('backend/js/index1.js') }}"></script>
<script src="{{ asset('backend/js/index.js') }}"></script>

@stack('script')