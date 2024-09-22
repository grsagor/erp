@extends('backend.layout.app')
@section('title', 'Salary | ' . Helper::getSettings('application_name') ?? 'ERP')
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Salary Management</h4>

        <div class="card my-2">
            <div class="card-body pb-0">
                <form method="" id="filter_form">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="month" id="month" class="form-control" required>
                                <option value="">Select Month</option>
                                <option {{ $todayMonth == '1' ? 'selected' : '' }} value="01">January</option>
                                <option {{ $todayMonth == '2' ? 'selected' : '' }} value="02">February</option>
                                <option {{ $todayMonth == '3' ? 'selected' : '' }} value="03">March</option>
                                <option {{ $todayMonth == '4' ? 'selected' : '' }} value="04">April</option>
                                <option {{ $todayMonth == '5' ? 'selected' : '' }} value="05">May</option>
                                <option {{ $todayMonth == '6' ? 'selected' : '' }} value="06">June</option>
                                <option {{ $todayMonth == '7' ? 'selected' : '' }} value="07">July</option>
                                <option {{ $todayMonth == '8' ? 'selected' : '' }} value="08">August</option>
                                <option {{ $todayMonth == '9' ? 'selected' : '' }} value="09">September</option>
                                <option {{ $todayMonth == '10' ? 'selected' : '' }} value="10">October</option>
                                <option {{ $todayMonth == '11' ? 'selected' : '' }} value="11">November</option>
                                <option {{ $todayMonth == '12' ? 'selected' : '' }} value="12">December</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="year" id="year" class="form-control" required>
                                <option value="">Select Year</option>
                                <option {{ $todayYear == '2024' ? 'selected' : '' }} value="2024">2024</option>
                                <option {{ $todayYear == '2023' ? 'selected' : '' }} value="2023">2023</option>
                                <option {{ $todayYear == '2022' ? 'selected' : '' }} value="2022">2022</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-end mt-2">
                                <button type="submit" id="filterBtn" name="submit" class="btn btn-primary"><i
                                        class="feather icon-file mr-2"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Order List</h5>
                        </div>
                        {{-- @if (Helper::hasRight('order.create'))
                            <button type="button" class="btn btn-primary btn-create-user create_form_btn"
                                data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa-solid fa-plus"></i>
                                Add</button>
                        @endif --}}
                        @if (Helper::hasRight('order.create'))
                            <button type="button" class="btn btn-primary" id="make-salary-sheet"><i
                                    class="fa-solid fa-plus"></i>
                                Make Salary Sheet</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>Employee Name</th>
                            <th>Total Hour</th>
                            <th>Total Salary</th>
                            <th>Total Paid</th>
                            <th>Total Due</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.pages.salary.modal')
@endsection

@section('script')
    <script type="text/javascript">
        function initialDatatable(month = null, year = null) {
            var table = jQuery('#dataTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.salary.get.list') }}",
                    type: 'GET',
                    data: {
                        'month': month,
                        'year': year,
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
                        data: 'total_hour',
                        name: 'total_hour'
                    },
                    {
                        data: 'total_salary',
                        name: 'total_salary'
                    },
                    {
                        data: 'paid',
                        name: 'paid'
                    },
                    {
                        data: 'due',
                        name: 'due'
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
            let month = $('#filter_form #month').val();
            let year = $('#filter_form #year').val();

            $('#dataTable').DataTable().destroy();
            initialDatatable(month, year);
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
                    url: "{{ route('admin.salary.store') }}",
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
                url: "{{ route('admin.salary.edit') }}",
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
                    url: "{{ route('admin.salary.update') }}",
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
                        url: "{{ route('admin.salary.delete') }}",
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
        $(document).on('click', '#make-salary-sheet', function(e) {
            e.preventDefault();
            const month = $('#month').val();
            const year = $('#year').val();
            $.ajax({
                url: "{{ route('admin.salary.make.sheet') }}",
                type: "GET",
                data: {
                    month, year
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        // toastr.success(response.msg);
                        $('#dataTable').DataTable().destroy();
                        initialDatatable();
                    } else {
                        toastr.error(response.msg);
                    }
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
