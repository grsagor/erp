<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Helper;

class EmployeeController extends Controller
{
    public function index(){
        return view('backend.pages.employee.index');
    }

    public function getList(Request $request){

        $data = User::query();        
       
        return DataTables::of($data)

        ->editColumn('profile_image', function ($row) {
            return ($row->profile_image) ? '<img class="profile-img" src="'.asset($row->profile_image).'" alt="profile image">' : '<img class="profile-img" src="'.asset('assets/utils/images/no-img.jpg').'" alt="profile image">';
        })

        // ->editColumn('first_name', function ($row) {
        //     return $row->first_name .' '.$row->last_name;
        // })

        // ->editColumn('role', function ($row) {
        //     return optional($row->roles)->name;
        // })

        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<span class="badge bg-primary w-80">Active</span>';
            }else{
                return '<span class="badge bg-danger w-80">Inactive</span>';
            }
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('employee.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('employee.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['profile_image','first_name','role','status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:user',
			'phone' => 'required|unique:user',
			'role' => 'required',
		]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role  = $request->role;
        $user->password  = Hash::make($request->password ?? $request->phone);
        if ($user->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'User created successfully.',
            ]);
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('backend.pages.employee.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone' => 'required',
			'role' => 'required',
		]);

        $user = User::find($id);
        $user->first_name = $request->first_name ?? $user->first_name;
        $user->last_name = $request->last_name ?? $user->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone ?? $user->phone;
        $user->role  = $request->role ?? $user->role;
        $user->status  = ($request->status) ? 1 : 0;
        $user->password  = (!empty($request->password)) ? Hash::make($request->password) : $user->password;
        if ($user->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'User updated successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'success',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return json_encode(['success' => 'User deleted successfully.']);
        }else{
            return json_encode(['error' => 'User not found.']);
        }
    }
}