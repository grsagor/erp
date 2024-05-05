<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            Dashboard | {{ Helper::getSettings('application_name') }}
        @endif
    </title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link href="{{ asset('assets/css/backend/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/backend/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/backend/sweetalert2.js') }}" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset(Helper::getSettings('site_favicon')) }}" />
    @yield('css')
</head>

<body class="sb-nav-fixed">
    @include('backend.include.topbar')
    <div id="layoutSidenav">
        @include('backend.include.sidebar')
        <div id="layoutSidenav_content">
            <main class="pt-4">
                @yield('content')
            </main>

        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/backend/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/backend/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/backend/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/backend/validator.js') }}"></script>


    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                $.toast({
                    heading: 'Error',
                    text: "{{ $error }}",
                    position: 'top-center',
                    icon: 'error'
                })
            @endforeach
        @endif

        @if (session()->has('success'))
            $.toast({
                heading: 'Success',
                text: "{{ session()->get('success') }}",
                position: 'top-center',
                icon: 'success'
            })
        @endif


        function previewFile(input, preview) {
            var file = $("#" + input + "").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#" + preview + "").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }


        $('.select2').select2();
    </script>
    @stack('footer')
</body>

</html>
