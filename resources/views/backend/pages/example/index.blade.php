@extends('backend.include.app')
@section('title', 'Example | ' . Helper::getSettings('application_name') ?? 'Kefas')
@section('css')
    <style>
        .profile_image_input--container {
            width: 190px;
            aspect-ratio: 1/1;
        }

        .profile_picture_edit_icon--container {
            width: 24px;
            height: 24px;
            bottom: 3px;
            right: 3px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2 mb-3">Example Management</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Example List</h5>
                        </div>
                        @if (Helper::hasRight('example.create'))
                            <button type="button" class="btn btn-primary"
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
                            <th>Sl No</th>
                            <th>Example ID</th>
                            <th>Example Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.pages.example.modal')
@endsection
@section('script')
    <script type="text/javascript">
    function getList() {
        var table = jQuery('#dataTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.example.list') }}",
                type: 'GET',
            },
            aLengthMenu: [
                [25, 50, 100, 500, 5000, -1],
                [25, 50, 100, 500, 5000, "All"]
            ],
            iDisplayLength: 25,
            columns: [{
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    },
                    "className": "text-center"
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'status',
                    name: 'status',
                    "className": "text-center"
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
    getList();

    $(document).on('click', '#filterBtn', function(e) {
        e.preventDefault();
        let name = $('#filter_form #name').val();
        let email = $('#filter_form #email').val();
        let phone = $('#filter_form #phone').val();

        $('#dataTable').DataTable().destroy();
        getList(name, email, phone);
    })

    $(document).on('click', '#createBtn', function(e) {
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
                url: "{{ route('admin.example.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showToast(response?.status, response?.msg);
                    $('#dataTable').DataTable().destroy();
                    getList();
                    $('#createModal').modal('hide');
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON.msg;
                    $('#createForm .server_side_error').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + errorMessage +
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
            url: "{{ route('admin.example.edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "html",
            success: function(data) {
                $('#editModal .modal-content').html(data);
                $('#editModal').modal('show');
                $('.select2').select2({
                    dropdownParent: $('#editForm')
                });
            }
        })
    });

    $(document).on('click', '#editBtn', function(e) {
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
                url: "{{ route('admin.example.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showToast(response?.status, response?.msg);
                    $('#dataTable').DataTable().destroy();
                    getList();
                    $('#editModal').modal('hide');
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON.msg;
                    $('#editForm .server_side_error').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + errorMessage +
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
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.example.delete') }}",
                    data: { id: id },
                    type: "post",
                    dataType: "json",
                    success: function(response) {
                        showToast(response?.status, response?.msg);
                        $('#dataTable').DataTable().destroy();
                        getList();
                    }
                })

            }
        })
    })

    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#createForm')
        });
    })
</script>
@endsection