@extends('backend.layout.app')
@section('title', 'Dashboard | ' . Helper::getSettings('application_name') ?? 'ERP')
@section('content')
    <div class="container-fluid px-5 pt-4">
        <h4 class="mt-2">Dashboard</h4>
        <div class="row">
            <div class="col-4">
                <canvas id="attendanceChart"></canvas>
            </div>
            <div class="col-4">
                <canvas id="orderStatusChart"></canvas>
            </div>
            <div class="col-4">
                <canvas id="productHistoryChart"></canvas>
            </div>
            <div class="col-6">
                <canvas id="rawMaterialImportChart"></canvas>
            </div>
            <div class="col-6">
                <canvas id="salaryChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const attendanceData = {!! json_encode($attendanceData) !!};
        const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctxAttendance, {
            type: 'line',
            data: {
                labels: Object.keys(attendanceData),
                datasets: [{
                    label: 'Hours Worked per Day',
                    data: Object.values(attendanceData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
        });
    </script>

    <script>
        const orderStatusData = {!! json_encode($orderStatusData) !!};
        const ctxOrderStatus = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(ctxOrderStatus, {
            type: 'pie',
            data: {
                labels: Object.keys(orderStatusData),
                datasets: [{
                    label: 'Order Status Breakdown',
                    data: Object.values(orderStatusData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                }]
            },
        });
    </script>

    <script>
        const productHistory = {!! json_encode($productHistory) !!};
        const ctxProductHistory = document.getElementById('productHistoryChart').getContext('2d');
        new Chart(ctxProductHistory, {
            type: 'bar',
            data: {
                labels: Object.keys(productHistory),
                datasets: [{
                    label: 'Products Made per Day',
                    data: Object.values(productHistory),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                }]
            },
        });
    </script>

    <script>
        const rawMaterialImport = {!! json_encode($rawMaterialImports) !!};
        const ctxRawMaterialImport = document.getElementById('rawMaterialImportChart').getContext('2d');
        new Chart(ctxRawMaterialImport, {
            type: 'line',
            data: {
                labels: Object.keys(rawMaterialImport),
                datasets: [{
                    label: 'Raw Material Imports (Bamboo) per Day',
                    data: Object.values(rawMaterialImport),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                }]
            },
        });
    </script>

    <script>
        const salaryLabels = {!! json_encode($salaryData->pluck('employee_name')) !!};
        const salaryPaid = {!! json_encode($salaryData->pluck('total_paid')) !!};
        const salaryDue = {!! json_encode($salaryData->pluck('total_due')) !!};

        console.log("salaryDue", salaryDue);

        const ctxSalary = document.getElementById('salaryChart').getContext('2d');
        new Chart(ctxSalary, {
            type: 'bar',
            data: {
                labels: salaryLabels,
                datasets: [{
                        label: 'Total Paid',
                        data: salaryPaid,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                    },
                    {
                        label: 'Total Due',
                        data: salaryDue,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                    }
                ]
            },
        });
    </script>
@endsection
