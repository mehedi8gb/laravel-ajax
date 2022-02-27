@if (Session::has('alert.config'))

        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">


        <script src="{{asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>

    <script>
        Swal.fire({!! Session::pull('alert.config') !!});
    </script>
@endif
