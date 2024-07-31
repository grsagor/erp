<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(){


        try {
            DB::beginTransaction();

            /* Your transactions */

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }


    }

    public function getList(Request $request){

        $data = Customer::all();        
       
        return DataTables::of($data)

        ->editColumn('image', function ($row) {
            return ($row->image) ? '<img class="profile-img" src="'.asset($row->image).'" alt="profile image">' : '<img class="profile-img" src="'.asset('assets/utils/images/no-img.jpg').'" alt="profile image">';
        })
        ->addColumn('action', function ($row) {
            $btn = '<div class="d-flex justify-content-center align-items-center gap-2">';
            if (Helper::hasRight('customer.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('customer.delete')) {
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
            'image' => 'required|image|mimes:jpg,png|max:20480'
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $customer = new Customer();

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/customer-images'), $filename);
                $customer->image = 'uploads/customer-images/' . $filename;
            }
    
            $customer->save();
            $response = [
                'status' => 1,
                'msg' => 'Customer created successfully.'
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
        $customer = Customer::find($request->id);
        return view('backend.pages.customer.edit', compact('customer'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'image' => 'image|mimes:jpg,png|max:20480'
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $customer = Customer::find($request->id);

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
    
            if ($request->hasFile('image')) {
                if ($customer->image != Null && file_exists(public_path($customer->image))) {
                    unlink(public_path($customer->image));
                }
                $image = $request->file('image');
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/customer-images'), $filename);
                $customer->image = 'uploads/customer-images/' . $filename;
            }
    
            $customer->save();
            $response = [
                'status' => 1,
                'msg' => 'Customer updated successfully.'
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
            $customer = Customer::find($request->id);
            if ($customer) {
                if ($customer->image != Null && file_exists(public_path($customer->image))) {
                    unlink(public_path($customer->image));
                }
                $customer->delete();
                $response = [
                    'status' => 1,
                    'msg' => 'Customer deleted successfully.'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'msg' => 'Customer does not found.'
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
