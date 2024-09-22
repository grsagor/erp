<form id="editForm" method="post">
    @csrf 
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="server_side_error" role="alert">

            </div>
        </div>
        <input type="hidden" name="id" value="{{ $customer->id }}">
        <div class="form-group  row">
            <label for="" class="text-gray-700 fw-medium col-sm-2 col-form-label">Choose
                Image</label>
            <div class="col-sm-10">
                <div class="profile_image_input--container position-relative">
                    <label class="w-100 h-100 overflow-hidden bg-blue-100 cursor-pointer"
                        for="edit_image">
                        <img class="w-100 h-100 object-fit-cover border preview_image"
                            src="{{ $customer->profile_image ? asset($customer->profile_image) : asset('assets/utils/images/no-img.jpg') }}" alt="">
                            <div
                            class="profile_picture_edit_icon--container bg-white position-absolute d-flex flex-column align-items-center justify-content-center rounded-circle shadow border">
                            <i class="fa-solid fa-pen text-primary text-12"></i>
                        </div>
                    </label>
                </div>
                <input type="file" id="edit_image" name="image" class="d-none"
                    onchange="previewImage(this, '#editModal .preview_image')">
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" placeholder="Name" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" value="{{ $customer->email }}" class="form-control" placeholder="Email" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Phone No.</label>
            <div class="col-sm-10">
                <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control" placeholder="Phone No." required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" name="password" class="form-control" placeholder="Password" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="submitEditForm" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>