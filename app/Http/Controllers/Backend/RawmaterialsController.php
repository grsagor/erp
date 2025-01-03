<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\TypeOfRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RawmaterialsController extends Controller
{
    public function index(){
        $types = TypeOfRawMaterial::all();
        return view('backend.pages.rawmaterials.index', compact('types'));
    }

    public function getList(Request $request){

        $data = RawMaterial::all();        
       
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
            'type_id' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $rawmaterials = new RawMaterial();

            $rawmaterials->type_id = $request->type_id;
            $rawmaterials->quantity = $request->quantity;
            $rawmaterials->price = $request->price;
            $rawmaterials->date = $request->date;
    
            $rawmaterials->save();

            $metadata = [
                'order_id' => '',
                'employee_id' => '',
                'raw_material_id' => $rawmaterials->id,
                'reason' => 'raw_material',
            ];
            Helper::currentAmountUpdate($request->price, 0, $metadata);

            Helper::rawMaterialsQuantityUpdate($request->type_id, $request->quantity, 'plus');
            
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
        $rawmaterial = RawMaterial::find($request->id);
        $types = TypeOfRawMaterial::all();
        $data = [
            'rawmaterial' => $rawmaterial,
            'types' => $types,
        ];
        return view('backend.pages.rawmaterials.edit', $data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'type_id' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $rawmaterials = RawMaterial::find($request->id);

            $transaction_amount = $request->price - $rawmaterials->price;

            Helper::rawMaterialsQuantityUpdate($rawmaterials->type_id, ($request->quantity - $rawmaterials->quantity), 'plus');
            
            $rawmaterials->type_id = $request->type_id;
            $rawmaterials->quantity = $request->quantity;
            $rawmaterials->price = $request->price;
            $rawmaterials->date = $request->date;
    
            $rawmaterials->save();

            $metadata = [
                'order_id' => '',
                'employee_id' => '',
                'raw_material_id' => $rawmaterials->id,
                'reason' => 'raw_material',
            ];
            Helper::currentAmountUpdate($transaction_amount, 0, $metadata);

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
            $rawmaterials = RawMaterial::find($request->id);
            if ($rawmaterials) {
                Helper::rawMaterialsQuantityUpdate($rawmaterials->type_id, $rawmaterials->quantity, 'minus');
                $rawmaterials->delete();
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