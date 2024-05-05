<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - {{ Helper::getSettings('application_name') }}</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/auth/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('uploads/settings/' . Helper::getSettings('site_favicon')) }}" rel="icon">
</head>

<body>
    <div class="row justify-content-center g-0 vh-100 align-items-center">
        <div class="col-lg-4 layoutAuthentication_content-wrapper">
            <div class="text-center">
                <img class="logo-admin"
                    src="{{ Helper::getSettings('site_logo') ? asset('uploads/settings/' . Helper::getSettings('site_logo')) : asset('assets/img/Logo.png') }}"
                    alt="">
            </div>
            @yield('content')
        </div>
    </div>
    <script src="https://kit.fontawesome.com/7e596160a4.js" crossorigin="anonymous"></script>
</body>

</html>
