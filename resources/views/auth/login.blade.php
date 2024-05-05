@extends('auth.include.app')
@section('content')
    <div class="border-0 rounded-lg">
        <h3 class="text-center my-4">Login</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <p class="m-0">{{ Session::get('message') }}</p>
            </div>
        @endif
        <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com"
                    required />
                <label for="inputEmail">Email<span class="text-danger">*</span></label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPassword" name="password" type="password"
                    placeholder="{{ trans('language.label_password') }}" required />
                <label for="inputPassword">Password<span class="text-danger">*</span></label>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
    </div>
@endsection
