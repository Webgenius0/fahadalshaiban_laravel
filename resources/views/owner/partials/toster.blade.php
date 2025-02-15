<script>
    @if(Session::has('success'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.success("{{ Session::get('success') }}");
@endif

@if(Session::has('info'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.info("{{ Session('info') }}");
@endif

@if(Session::has('warning'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.warning("{{ Session('warning') }}");
@endif

@if(Session::has('error'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.error("{{ Session('error') }}");
@endif
</script>

