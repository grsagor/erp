<form id="editForm" method="post">
    @csrf 
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="server_side_error" role="alert">

            </div>
        </div>
        <input type="hidden" name="id" value="{{ $order->id }}">
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Select Customer</label>
            <div class="col-sm-9">
                <select name="customer_id" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($customers as $customer)
                        <option {{ $order->customer_id == $customer->id ? 'selected' : '' }} value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Select Product</label>
            <div class="col-sm-9">
                <select name="product_type_id" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($product_types as $product_type)
                        <option {{ $order->product_type_id == $product_type->id ? 'selected' : '' }} value="{{$product_type->id}}">{{$product_type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Quantity</label>
            <div class="col-sm-9">
                <input type="text" name="quantity" class="form-control" value="{{$order->quantity}}" placeholder="Quantity" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Delivery Date</label>
            <div class="col-sm-9">
                <input type="text" name="delivery_date" class="form-control datepicker" value="{{$order->delivery_date}}" placeholder="Delivery Date" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select name="status" class="form-control" required>
                    <option value="">Select</option>
                    <option {{ $order->status == 1 ? 'selected' : '' }} value="1">Pending</option>
                    <option {{ $order->status == 2 ? 'selected' : '' }} value="2">In Progress</option>
                    <option {{ $order->status == 3 ? 'selected' : '' }} value="3">Completed</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="submitEditForm" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>