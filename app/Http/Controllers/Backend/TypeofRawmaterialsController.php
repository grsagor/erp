<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\TypeOfRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TypeofRawmaterialsController extends Controller
{
    public function index(){
        return view('backend.pages.typeofrawmaterials.index');
    }

    public function getList(Request $request){

        $data = TypeOfRawMaterial::all();        
       
        return DataTables::of($data)
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
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            return response()->json($data, 422);
        }

        try {
            DB::beginTransaction();
            $typeofrawmaterials = new TypeOfRawMaterial();

            $typeofrawmaterials->name = $request->name;
    
            $typeofrawmaterials->save();
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
        $typeofrawmaterial = TypeOfRawMaterial::find($request->id);
        $data = [
            'typeofrawmaterial' => $typeofrawmaterial,
        ];
        return view('backend.pages.typeofrawmaterials.edit', $data);
    }

    public function update(Request $request){
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
            $typeofrawmaterials = TypeOfRawMaterial::find($request->id);

            $typeofrawmaterials->name = $request->name;
    
            $typeofrawmaterials->save();
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
            $typeofrawmaterials = TypeOfRawMaterial::find($request->id);
            if ($typeofrawmaterials) {
                $typeofrawmaterials->delete();
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
