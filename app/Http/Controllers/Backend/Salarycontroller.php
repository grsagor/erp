<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Models\Salary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class Salarycontroller extends Controller
{
    public function index(Request $request)
    {
        $todayMonth = $request->month ? $request->month : Carbon::now()->month;
        $todayYear = $request->year ? $request->year : Carbon::now()->year;
        $data = [
            'todayMonth' => $todayMonth,
            'todayYear' => $todayYear,
        ];
        return view('backend.pages.salary.index', $data);
    }

    public function getList(Request $request)
    {
        $todayMonth = $request->month ? intval($request->month) : Carbon::now()->month;
        $todayYear = $request->year ? intval($request->year) : Carbon::now()->year;

        $query = Salary::query();
        $query->where('month', $todayMonth);
        $query->where('year', $todayYear);
        $data = $query->get();

        return DataTables::of($data)
            ->addColumn('name', function ($row) {
                return $row->employee->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="d-flex justify-content-center align-items-center gap-2">';
                if (Helper::hasRight('employee.edit')) {
                    $btn = $btn . '<a href="" data-id="' . $row->id . '" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
                }
                if (Helper::hasRight('employee.delete')) {
                    $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="' . $row->id . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                return $btn . '</div>';
            })
            ->rawColumns(['status', 'action'])->make(true);
    }

    public function makeSalary(Request $request) {
        try {
            DB::beginTransaction();
            $employees = User::where([['role', 2]])->get();
            $todayMonth = $request->month ? $request->month : Carbon::now()->month;
            $todayYear = $request->year ? $request->year : Carbon::now()->year;
            foreach ($employees as $employee) {
                $working_hours = Helper::getWorkingHours($employee->id, $todayMonth, $todayYear);
                $total_salary = $employee->salary * $employee->working_hours;
                $employee->total_salary = $employee->salary * $employee->working_hours;
    
                $salary = Salary::where([['employee_id', $employee->id], ['month', $todayMonth], ['year', $todayYear]])->first();
                if (!$salary) {
                    $salary = new Salary();
                }
                $salary->employee_id = $employee->id;
                $salary->month = $todayMonth;
                $salary->year = $todayYear;
                $salary->total_hour = $working_hours;
                $salary->total_salary = $total_salary;
                $salary->paid = $request->paid ? $request->paid : 0;
                $salary->due = $request->paid ? ($total_salary - $request->paid) : $total_salary;
    
                $salary->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $product_type = new ProductType();

            $product_type->name = $request->name;

            $product_type->save();
            $response = [
                'status' => 1,
                'msg' => 'Material type created successfully.'
            ];
            DB::commit();
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    public function edit(Request $request)
    {
        $product_type = ProductType::find($request->id);
        $data = [
            'product_type' => $product_type,
        ];
        return view('backend.pages.producttype.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $product_type = ProductType::find($request->id);

            $product_type->name = $request->name;

            $product_type->save();
            $response = [
                'status' => 1,
                'msg' => 'Material type updated successfully.'
            ];
            DB::commit();
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $product_type = ProductType::find($request->id);
            if ($product_type) {
                $product_type->delete();
                $response = [
                    'status' => 1,
                    'msg' => 'Material type deleted successfully.'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Material type does not found.'
                ];
            }
            DB::commit();
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }
}
