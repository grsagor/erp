@extends('backend.layout.app')
@section('title', 'Attendance | ' . Helper::getSettings('application_name') ?? 'ERP')
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Attendance Management</h4>
        <div class="mb-3 row">
            <label for="date" class="form-label m-0 d-flex align-items-center col-12 col-md-2">Select Date</label>
            <div class="col-12 col-md-10">
                <input type="text" class="form-control datepicker" id="date" placeholder="Select Date">
            </div>
        </div>

        <div id="attendance_container"></div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true
            }).datepicker('setDate', new Date());
            getFormHtml($('#date').val());

            $('#date').on('change', function() {
                getFormHtml($(this).val());
            })
        })

        function getFormHtml(date) {
            console.log(date)
            $.ajax({
                url: "{{ route('admin.attendance.single.day') }}",
                type: "get",
                data: {
                    date: date
                },
                dataType: "json",
                success: function(response) {
                    $('#attendance_container').html('');
                    $('#attendance_container').html(response.html);
                }
            })
        }
    </script>
@endsection
