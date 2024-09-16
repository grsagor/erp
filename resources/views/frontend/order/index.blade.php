@extends('frontend.include.app')
@section('content')
    <div class="container px-4">
        <h4 class="mt-2">Order Management</h4>
        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Order List</h5>
                        </div>
                        @if (Helper::hasRight('order.create'))
                            <button type="button" class="btn btn-primary btn-create-user create_form_btn"
                                data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa-solid fa-plus"></i>
                                Add</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>CustomerID</th>
                            <th>Customer Name</th>
                            <th>Quantity</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function initialDatatable(name = null, email = null, phone = null) {
            var table = jQuery('#dataTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.order.get.list') }}",
                    type: 'GET',
                    data: {
                        'name': name,
                        'email': email,
                        'phone': phone
                    },
                },
                aLengthMenu: [
                    [25, 50, 100, 500, 5000, -1],
                    [25, 50, 100, 500, 5000, "All"]
                ],
                iDisplayLength: 25,
                "order": [
                    [2, 'asc']
                ],
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'customer_id',
                        name: 'customer_id'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'delivery_date',
                        name: 'delivery_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false,
                    //     "className": "text-center w-10"
                    // },
                ]
            });
        }
        initialDatatable();

        $(document).ready(function() {
            $(document).on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.order.delete') }}",
                            type: "GET",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    toastr.success(response.msg);
                                    $('#dataTable').DataTable().destroy();
                                    initialDatatable();
                                } else {
                                    toastr.error(response.msg);
                                }
                            }
                        })

                    }
                })
            })

            $(document).ready(function() {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    todayHighlight: true,
                    autoclose: true
                }).datepicker('setDate', new Date());
                getFormHtml($('#date').val());
            })
        })
    </script>
@endsection
