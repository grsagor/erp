<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Auth;
use Helper;
use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('dashboard.view') !=  true) {
                Auth::logout();
                $request->session()->invalidate();
                session()->flash('error', 'You can not access! Login first.');
                // return redirect()->route('admin.index');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Controller logic to get attendance data
        $attendanceData = Attendance::with('employee')
            ->get()
            ->groupBy(function ($attendance) {
                // Convert the string date format to Y-m-d for uniform grouping
                return Carbon::createFromFormat('d/m/Y', $attendance->date)->format('Y-m-d');
            })
            ->map(function ($attendances) {
                return $attendances->sum(function ($attendance) {
                    return $attendance->getHoursWorked(); // Use the method to calculate total hours
                });
            });

        $orderStatusData = Order::with('customer')
            ->get()
            ->groupBy('status')
            ->map(function ($orders) {
                return $orders->count(); // Count orders by status
            });

        // Controller Logic using Eloquent relationships
        $productHistory = Product::with('type')
            ->get()
            ->groupBy(function ($product) {
                return $product->created_at->format('Y-m-d'); // Group by creation date
            })
            ->map(function ($products) {
                return $products->count(); // Count products created per day
            });


        $rawMaterialImports = RawMaterial::with('type')
            ->get()
            ->groupBy(function ($rawMaterial) {
                // Parse the string date (e.g., '29/09/2024') into a Carbon instance
                return Carbon::createFromFormat('d/m/Y', $rawMaterial->date)->format('Y-m-d');
            })
            ->map(function ($rawMaterials) {
                // Sum the 'quantity' of raw materials imported on each day
                return $rawMaterials->sum('quantity');
            });

        // Controller Logic using Eloquent relationships
        $salaryData = Salary::with('employee')
            ->get()
            ->groupBy('employee_id')
            ->map(function ($salaries) {
                return [
                    'employee_name' => $salaries->first()->employee->name,
                    'total_paid' => $salaries->sum('paid'),  // Total paid salary
                    'total_due'  => $salaries->sum('due')    // Total due salary
                ];
            });

            // return $salaryData;

        $data = [
            'attendanceData' => $attendanceData,
            'orderStatusData' => $orderStatusData,
            'productHistory' => $productHistory,
            'rawMaterialImports' => $rawMaterialImports,
            'salaryData' => $salaryData,
        ];


        return view('backend.pages.dashboard', $data);
    }
}
