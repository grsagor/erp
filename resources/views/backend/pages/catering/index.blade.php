@extends('backend.layout.app')
@section('title', 'Catering | ' . Helper::getSettings('application_name') ?? 'Alexandros')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/tagsinput/tagsinput.css') }}">
@endsection
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Catering Management</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Catering List</h5>
                        </div>
                        @if (Helper::hasRight('catering.create'))
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.pages.catering.modal')
    @push('footer')
        <script src="{{ asset('assets/vendor/tagsinput/tagsinput.js') }}"></script>
        <script type="text/javascript">
            function getArtist(name = null, phone = null, type = null, status = null) {
                var table = jQuery('#dataTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('admin/catering/get/list') }}",
                        type: 'GET',
                        data: {
                            'name': name,
                            'phone': phone,
                            'type': type,
                            'status': status,
                        },
                    },
                    aLengthMenu: [
                        [25, 50, 100, 500, 5000, -1],
                        [25, 50, 100, 500, 5000, "All"]
                    ],
                    iDisplayLength: 25,
                    "order": [
                        [1, 'asc']
                    ],
                    columns: [
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'title',
                            name: 'title'
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
            getArtist();


            $(document).on('click', '#filterBtn', function(e) {
                e.preventDefault();
                let name = $('#filter_form #name').val();
                let phone = $('#filter_form #phone').val();
                let type = $('#filter_form #type').val();
                let status = $('#filter_form #status').val();

                $('#dataTable').DataTable().destroy();
                getArtist(name, phone, type, status);
            })


            $(document).on('click', '#addPartnerBtn', function(e) {
                e.preventDefault();
                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#createModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    let form = document.getElementById('partnerCreateForm');
                    var formData = new FormData(form);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.catering.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            let heading = response.type.charAt(0).toUpperCase() + response.type.slice(1);
                            toastr.success(response.msg);
                            $('#dataTable').DataTable().destroy();
                            getArtist();
                            form.reset();
                            $('#createModal').modal('hide');
                        },
                        error: function(xhr) {

                            let errorMessage = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += ('' + value + '<br>');
                            });
                            $('#partnerEditForm .server_side_error').empty();
                            $('#partnerCreateForm .server_side_error').html(
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
                    url: "{{ route('admin.catering.edit') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(data) {
                        $('#editModal .modal-content').html(data);
                        $('#editModal').modal('show');
                    }
                })
            });

            $(document).on('click', '#editPartnerBtn', function(e) {
                e.preventDefault();
                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#editModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    let form = document.getElementById('partnerEditForm');
                    var formData = new FormData(form);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.catering.update') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            let heading = response.type.charAt(0).toUpperCase() + response.type.slice(1);
                            toastr.success(response.msg);
                            $('#dataTable').DataTable().destroy();
                            getArtist();
                            $('#editModal').modal('hide');
                        },
                        error: function(xhr) {

                            let errorMessage = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += ('' + value + '<br>');
                            });
                            $('#partnerEditForm .server_side_error').empty();
                            $('#partnerEditForm .server_side_error').html(
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
                            url: "{{ route('admin.catering.delete') }}",
                            type: "GET",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                let heading = response.type.charAt(0).toUpperCase() + response.type
                                    .slice(1);
                                toastr.success(response.msg);
                                $('#dataTable').DataTable().destroy();
                                getArtist();
                            }
                        })

                    }
                })
            })

            $(document).on('click', '.view_btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ url('/admin/artist/view/') }}/" + id,
                    type: "GET",
                    dataType: "html",
                    success: function(data) {
                        $('#viewModal .modal-content').html(data);
                        $('#viewModal').modal('show');
                    }
                })
            });

            // next button
            $(document).on('click', '#createModal .next_btn', function(e) {
                e.preventDefault();
                let step = $(this).attr('data-step-open');
                let step_btn = $(this).attr('data-step-button');

                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#createModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    $('#createModal .step').removeClass('active show');
                    $('#createModal .step_btn').removeClass('d-block');
                    $('#createModal .step_btn').addClass('d-none');

                    $('#createModal .' + step).addClass('active show');
                    $('#createModal .' + step_btn).removeClass('d-none');
                    $('#createModal .' + step_btn).addClass('d-block');
                }

            })

            $(document).on('click', '#editModal .next_btn', function(e) {
                e.preventDefault();
                let step = $(this).attr('data-step-open');
                let step_btn = $(this).attr('data-step-button');

                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#editModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    $('#editModal .step').removeClass('active show');
                    $('#editModal .step_btn').removeClass('d-block');
                    $('#editModal .step_btn').addClass('d-none');

                    $('#editModal .' + step).addClass('active show');
                    $('#editModal .' + step_btn).removeClass('d-none');
                    $('#editModal .' + step_btn).addClass('d-block');
                }
            })

            function incrementRow(first_div, second_div, copy_single = null) {
                console.log(copy_single);
                if (copy_single == null) {
                    var maindiv = $('.' + first_div);
                } else {
                    var maindiv = $(copy_single).closest('.' + first_div);
                }
                var copydiv = maindiv.find('.' + second_div + ':last');
                var clonedDiv = copydiv.clone(true);
                var rowNumber = parseInt(copydiv.attr('data-row-no')) + 1;
                clonedDiv.attr('data-row-no', rowNumber);
                clonedDiv.insertAfter(copydiv);
            }

            function removeRow(event) {
                event.preventDefault();
                var row = event.target.closest('tr');
                row.remove();
            }
        </script>
    @endpush
@endsection
