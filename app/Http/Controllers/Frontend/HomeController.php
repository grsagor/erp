<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function check()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect(route('login.form'));
        } elseif ($user->role == 1) {
            return redirect(route('admin.index'));
        } elseif ($user->role == 3) {
            return redirect(route('user.add.order.index'));
        }
    }

    public function userOrderPage()
    {
        return view('frontend.order.add');
    }
    public function userOrders()
    {
        return view('frontend.order.index');
    }
    public function userOrdersList(Request $request)
    {
        $user = Auth::user();
        $data = Order::where('customer_id', $user->id)->get();

        return DataTables::of($data)

            ->addColumn('customer_name', function ($row) {
                return $row->customer->name;
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-primary w-80">Pending</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge bg-danger w-80">In Progress</span>';
                } elseif ($row->status == 3) {
                    return '<span class="badge bg-primary w-80">Completed</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="d-flex justify-content-center align-items-center gap-2">';
                $btn = $btn . '<a href="" data-id="' . $row->id . '" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="' . $row->id . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                return $btn . '</div>';
            })
            ->rawColumns(['status', 'action'])->make(true);
    }

    public function edit(Request $request){
        $order = Order::find($request->id);
        $data = [
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

            $order->quantity = $request->quantity;
            $order->delivery_date = $request->delivery_date;
    
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

}
