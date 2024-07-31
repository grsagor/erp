<form id="editForm" method="post">
    @csrf 
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="server_side_error" role="alert">

            </div>
        </div>
        <input type="hidden" name="id" value="{{ $typeofrawmaterial->id }}">
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" name="name" value="{{ $typeofrawmaterial->name }}" class="form-control" placeholder="Name" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="submitEditForm" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>