<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createForm" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fa-solid fa-xmark"></i> --}}
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="server_side_error" role="alert">

                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="" class="col-sm-3 col-form-label">Select Type</label>
                        <div class="col-sm-9">
                            <select name="product_type_id" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="" class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="text" name="quantity" class="form-control" placeholder="Quantity" required>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" name="date" class="form-control datepicker" placeholder="Date"
                                required>
                        </div>
                    </div>
                    <div>
                        <table class="product-material-table" id="product-material-add-table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Quantity</th>
                                    <th class="product-mateial-add-btn"><button type="button" data-container="#product-material-add-table tbody">Add</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="product-material-table-tr-1">
                                    <td>
                                        <select name="material_id[]" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach ($material_types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="material_quantity[]" class="form-control"
                                            placeholder="Quantity" required>
                                    </td>
                                    <td class="product-mateial-delete-btn"><button type="button"
                                            data-no="1" data-container="#product-material-add-table tbody">Delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
                    <button type="submit" id="submitCreateForm" class="btn btn-primary"
                        data-check-area="modal-body">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit modal  --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
