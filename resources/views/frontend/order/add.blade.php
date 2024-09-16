@extends('frontend.include.app')
@section('content')
    <div class="container">
        <div>
            <h1 class="text-center">User Order</h1>
        </div>
        <form id="createForm" method="post">
            @csrf
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="server_side_error" role="alert">

                    </div>
                </div>
                <div class="form-group  row">
                    <label for="" class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-9">
                        <input type="text" name="quantity" class="form-control" placeholder="Quantity" required>
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="" class="col-sm-3 col-form-label">Delivery Date</label>
                    <div class="col-sm-9">
                        <input type="text" name="delivery_date" class="form-control datepicker"
                            placeholder="Delivery Date" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true
            }).datepicker('setDate', new Date());
        })
    </script>
@endsection
