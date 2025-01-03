<form id="editForm" method="post">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Raw Materials</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="server_side_error" role="alert">

            </div>
        </div>
        <input type="hidden" name="id" value="{{ $rawmaterial->id }}">
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Select Type</label>
            <div class="col-sm-9">
                <select name="type_id" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($types as $type)
                        <option {{ $rawmaterial->type_id == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Quantity</label>
            <div class="col-sm-9">
                <input type="text" name="quantity" value="{{ $rawmaterial->quantity }}" class="form-control" placeholder="Quantity" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-9">
                <input type="number" name="price" value="{{ $rawmaterial->price }}" class="form-control" placeholder="Price" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
                <input type="text" name="date" value="{{ $rawmaterial->date }}" class="form-control datepicker" placeholder="Date" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="submitEditForm" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>
