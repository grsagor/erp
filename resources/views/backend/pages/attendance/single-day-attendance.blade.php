<form action="{{ route('admin.attendance.single.day.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="date" value="{{ $date }}">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Check In Time</th>
                <th scope="col">Check Out Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $i => $employee)
                <input type="hidden" name="employee_id[{{ $i }}]" value="{{ $employee->id }}">
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $employee->name }}</td>
                    <td><input type="time" name="check_in[{{ $i }}]" class="form-control" value="{{ isset($employee->attendances[0]) ? $employee->attendances[0]->check_in : '' }}"></td>
                    <td><input type="time" name="check_out[{{ $i }}]" class="form-control" value="{{ isset($employee->attendances[0]) ? $employee->attendances[0]->check_out : '' }}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
