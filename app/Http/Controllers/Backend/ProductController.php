<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(){
        $types = ProductType::all();
        return view('backend.pages.products.index', compact('types'));
    }

    public function getList(Request $request){

        $data = Product::all();        
       
        return DataTables::of($data)
        ->addColumn('type', function ($row) {
            return $row->type->name;
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
        ->rawColumns(['action'])->make(true);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'product_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $products = new Product();

            $products->product_type_id = $request->product_type_id;
            $products->quantity = $request->quantity;
            $products->date = $request->date;
    
            $products->save();
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

    public function edit(Request $request){
        $product = Product::find($request->id);
        $types = ProductType::all();
        $data = [
            'product' => $product,
            'types' => $types,
        ];
        return view('backend.pages.products.edit', $data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'product_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $products = Product::find($request->id);
            
            $products->product_type_id = $request->product_type_id;
            $products->quantity = $request->quantity;
            $products->date = $request->date;
    
            $products->save();
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

    public function delete(Request $request){
        try {
            DB::beginTransaction();
            $products = Product::find($request->id);
            if ($products) {
                $products->delete();
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