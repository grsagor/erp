<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(){
        $customers = User::where('role', 3)->get();
        $data = [
            'customers' => $customers,
        ];
        return view('backend.pages.order.index', $data);
    }

    public function getList(Request $request){

        $data = Order::all();        
       
        return DataTables::of($data)

        ->addColumn('customer_name', function ($row) {
            return $row->customer->name;
        })
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<span class="badge bg-primary w-80">Pending</span>';
            }elseif($row->status == 2){
                return '<span class="badge bg-danger w-80">In Progress</span>';
            } elseif($row->status == 3) {
                return '<span class="badge bg-primary w-80">Completed</span>';
            }
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
        ->rawColumns(['status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'quantity' => 'required',
            'delivery_date' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $order = new Order();

            $order->customer_id = $request->customer_id;
            $order->quantity = $request->quantity;
            $order->delivery_date = $request->delivery_date;
            $order->status = 1;
    
            $order->save();
            $response = [
                'status' => 1,
                'msg' => 'Order created successfully.'
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
        $order = Order::find($request->id);
        $customers = User::where('role', 3)->get();
        $data = [
            'customers' => $customers,
            'order' => $order,
        ];
        return view('backend.pages.order.edit', $data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'quantity' => 'required',
            'delivery_date' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $order = Order::find($request->id);

            $order->customer_id = $request->customer_id;
            $order->quantity = $request->quantity;
            $order->delivery_date = $request->delivery_date;
            $order->status = $request->status;
    
            $order->save();
            $response = [
                'status' => 1,
                'msg' => 'Order updated successfully.'
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
            $order = Order::find($request->id);
            if ($order) {
                $order->delete();
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