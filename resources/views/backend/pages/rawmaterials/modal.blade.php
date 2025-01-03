<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createForm" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Raw Materials</h5>
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
                            <select name="type_id" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
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
                        <label for="" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" name="price" class="form-control" placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" name="date" class="form-control datepicker" placeholder="Date" required>
                        </div>
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
