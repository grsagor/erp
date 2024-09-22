<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\ProductType;
use App\Models\TypeOfRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(){
        $types = ProductType::all();
        $material_types = TypeOfRawMaterial::all();
        return view('backend.pages.products.index', compact('types', 'material_types'));
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
            $product = new Product();

            $product->product_type_id = $request->product_type_id;
            $product->quantity = $request->quantity;
            $product->date = $request->date;
    
            $product->save();

            Helper::productsQuantityUpdate($request->product_type_id, $request->quantity, 'plus');

            foreach ($request->material_id as $index => $id) {
                $p_material = new ProductMaterial();
                $p_material->product_id = $product->id;
                $p_material->material_id = $id;
                $p_material->quantity = $request->material_quantity[$index];
                $p_material->save();

                Helper::rawMaterialsQuantityUpdate($id, $request->material_quantity[$index], 'minus');
            }

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
        $material_types = TypeOfRawMaterial::all();
        $p_materials = ProductMaterial::where('product_id', $request->id)->with(['material_type'])->get();
        $data = [
            'product' => $product,
            'types' => $types,
            'material_types' => $material_types,
            'p_materials' => $p_materials,
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
            $product = Product::find($request->id);
            
            $product->product_type_id = $request->product_type_id;
            $product->quantity = $request->quantity;
            $product->date = $request->date;
    
            $product->save();

            ProductMaterial::where('product_id', $product->id)->delete();

            foreach ($request->material_id as $index => $id) {
                $p_material = new ProductMaterial();
                $p_material->product_id = $product->id;
                $p_material->material_id = $id;
                $p_material->quantity = $request->material_quantity[$index];
                $p_material->save();
            }

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

    public function addMaterialRow() {
        $material_types = TypeOfRawMaterial::all();
        $time = time();
        $html = view('backend.pages.products.add_material', compact('material_types', 'time'))->render();
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }
}