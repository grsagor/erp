@extends('backend.layout.app')
@section('title', 'Product Type | ' . Helper::getSettings('application_name') ?? 'ERP')
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Product Type Management</h4>
        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Product Type List</h5>
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
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.pages.producttype.modal')
@endsection

@section('script')
    <script type="text/javascript">
        function initialDatatable(name = null, email = null, phone = null) {
            var table = jQuery('#dataTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.producttype.get.list') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        "className": "text-center w-10"
                    },
                ]
            });
        }
        initialDatatable();

        $(document).on('click', '#filterBtn', function(e) {
            e.preventDefault();
            let name = $('#filter_form #name').val();
            let email = $('#filter_form #email').val();
            let phone = $('#filter_form #phone').val();

            $('#dataTable').DataTable().destroy();
            initialDatatable(name, email, phone);
        })

        $(document).on('click', '#submitCreateForm', function(e) {
            e.preventDefault();
            let go_next_step = true;
            if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                go_next_step = check_validation_Form('#createModal .' + $(this).attr('data-check-area'));
            }
            if (go_next_step == true) {
                let form = document.getElementById('createForm');
                var formData = new FormData(form);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.producttype.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.msg);
                            $('#dataTable').DataTable().destroy();
                            initialDatatable();
                            $('#createModal').modal('hide');
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        $('#createForm .server_side_error').html(
                            '<div class="alert alert-danger" role="alert">' + errorMessage +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        );
                    },
                })
            }
        })

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('admin.producttype.edit') }}",
                type: "GET",
                data: {
                    id: id
                },
                dataType: "html",
                success: function(data) {
                    $('#editModal .modal-content').html(data);
                    $('#editModal').modal('show');

                    // Reinitialize the datepicker for the newly loaded content
                    $('#editModal .datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                        todayHighlight: true,
                        autoclose: true
                    }).datepicker('setDate', new Date());
                }
            })
        });

        $(document).on('click', '#submitEditForm', function(e) {
            e.preventDefault();
            let go_next_step = true;
            if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                go_next_step = check_validation_Form('#editModal .' + $(this).attr('data-check-area'));
            }
            if (go_next_step == true) {
                let form = document.getElementById('editForm');
                var formData = new FormData(form);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.producttype.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.msg);
                            $('#dataTable').DataTable().destroy();
                            initialDatatable();
                            $('#editModal').modal('hide');
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        $('#editForm .server_side_error').html(
                            '<div class="alert alert-danger" role="alert">' + errorMessage +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        );
                    },
                })
            }
        })

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
                        url: "{{ route('admin.producttype.delete') }}",
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
    </script>
@endsection
