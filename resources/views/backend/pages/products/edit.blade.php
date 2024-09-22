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
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Select Type</label>
            <div class="col-sm-9">
                <select name="product_type_id" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($types as $type)
                        <option {{ $product->product_type_id == $type->id ? 'selected' : '' }}
                            value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Quantity</label>
            <div class="col-sm-9">
                <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control"
                    placeholder="Quantity" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
                <input type="text" name="date" value="{{ $product->date }}" class="form-control datepicker"
                    placeholder="Date" required>
            </div>
        </div>
        <div>
            <table class="product-material-table" id="product-material-add-table">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Quantity</th>
                        <th class="product-mateial-add-btn"><button type="button"
                                data-container="#product-material-add-table tbody">Add</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($p_materials as $p_material)
                        <tr class="product-material-table-tr-1">
                            <td>
                                <select name="material_id[]" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($material_types as $type)
                                        <option {{ $p_material->material_id == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="material_quantity[]" value="{{ $p_material->quantity }}" class="form-control"
                                    placeholder="Quantity" required>
                            </td>
                            <td class="product-mateial-delete-btn"><button type="button" data-no="1"
                                    data-container="#product-material-add-table tbody">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="submitEditForm" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>
