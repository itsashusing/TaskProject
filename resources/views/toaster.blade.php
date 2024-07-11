@if (Session::has('error'))
{
<link href="{{ asset('public/assets/css/toastr.min.css') }}" rel="stylesheet" />
<script src="{{ asset('public/assets/js/toastr.min.js') }}"></script>
<script>
    toastr.options = {
            'progressBar': true,
            'closeButton': true,
            'toastClass': 'toast-error'
        };
        toastr.success("{{ Session::get('error') }}", {
            timeout: 12000
        });
</script>
}
@endif

@if (Session::has('success'))
{
<link href="{{ asset('public/assets/css/toastr.min.css') }}" rel="stylesheet" />
<script src="{{ asset('public/assets/js/toastr.min.js') }}"></script>
<script>
    toastr.options = {
            'progressBar': true,
            'closeButton': true,
            'toastClass': 'toast-success'
        };
        toastr.success("{{ Session::get('success') }}", {
            timeout: 12000
        });
</script>
}
@endif