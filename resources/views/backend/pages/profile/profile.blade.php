@extends('backend.layout.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="card shadow border-0 rounded-lg mt-4">
                    <div class="card-header">
                        <h4 class="text-center my-2">Update Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3 text-center">
                                <img class="border-redius-50 preview_img" src="{{ ($user->profile_image) ? asset($user->profile_image) :  asset('assets/utils/images/no-img.jpg')}}" alt="profile image" height="80px" width="80px">
                            </div>

                            <div class="form-group mb-3">
                                <input class="form-control" type="file" name="profile_image" id="profile_image" />
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="first_name" value="{{ $user->first_name ?? '' }}" placeholder="First Name"  />
                                <label for="inputEmail">First Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="last_name" value="{{ $user->last_name ?? '' }}" placeholder="Last Name"  />
                                <label for="inputEmail">Last Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="{{ $user->email }}" readonly />
                                <label for="inputEmail">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="text" name="phone" placeholder="Phone" value="{{ $user->phone ?? '' }}"  />
                                <label for="inputEmail">Phone</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary w-100" >Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('footer')
        <script>
            $(document).on('change', '#profile_image', function(e) {
                e.preventDefault();
                let input = this;
                if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.preview_img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                }
            })
        </script>
        
    @endpush
@endsection

