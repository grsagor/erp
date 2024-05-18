<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Helper;

class EmployeeController extends Controller
{
    public function index(){
        return view('backend.pages.employee.index');
    }

    public function getList(Request $request){

        $data = Employee::all();        
       
        return DataTables::of($data)

        ->editColumn('image', function ($row) {
            return ($row->image) ? '<img class="profile-img" src="'.asset($row->image).'" alt="profile image">' : '<img class="profile-img" src="'.asset('assets/utils/images/no-img.jpg').'" alt="profile image">';
        })
        ->addColumn('action', function ($row) {
            $btn = '<div class="d-flex justify-content-center align-items-center gap-2">';
            if (Helper::hasRight('employee.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('employee.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn . '</div>';
        })
        ->rawColumns(['image','action'])->make(true);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png|max:20480'
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $employee = new Employee();

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->department = $request->department;
            $employee->position = $request->position;
            $employee->salary = $request->salary;
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/employee-images'), $filename);
                $employee->image = 'uploads/employee-images/' . $filename;
            }
    
            $employee->save();
            $response = [
                'status' => 1,
                'msg' => 'Employee created successfully.'
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

    public function edit(Request $request){
        $employee = Employee::find($request->id);
        return view('backend.pages.employee.edit', compact('employee'));
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'image' => 'image|mimes:jpg,png|max:20480'
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $employee = Employee::find($request->id);

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->department = $request->department;
            $employee->position = $request->position;
            $employee->salary = $request->salary;
    
            if ($request->hasFile('image')) {
                if ($employee->image != Null && file_exists(public_path($employee->image))) {
                    unlink(public_path($employee->image));
                }
                $image = $request->file('image');
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/employee-images'), $filename);
                $employee->image = 'uploads/employee-images/' . $filename;
            }
    
            $employee->save();
            $response = [
                'status' => 1,
                'msg' => 'Employee updated successfully.'
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

    public function delete(Request $request){
        try {
            DB::beginTransaction();
            $employee = Employee::find($request->id);
            if ($employee) {
                if ($employee->image != Null && file_exists(public_path($employee->image))) {
                    unlink(public_path($employee->image));
                }
                $employee->delete();
                $response = [
                    'status' => 1,
                    'msg' => 'Employee deleted successfully.'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Employee does not found.'
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