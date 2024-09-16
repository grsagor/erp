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
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/datatable/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('vendor/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset(Helper::getSettings('site_favicon')) }}" />
    @yield('css')
</head>

<body>
    @include('frontend.include.navbar')
    @yield('content')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/validator/validator.js') }}"></script>


    <script>
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

        function previewImage(input, previewContainerClass) {
            var preview = document.querySelector(previewContainerClass);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.select2').select2();
    </script>

    @include('shared.toastr')
    @yield('script')
</body>

</html>
