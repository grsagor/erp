<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Helper;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    public function index()
    {
        return view('backend.pages.example.index');
    }
    public function getList(Request $request)
    {

        $data = User::query()->where('role', '3')->orderBy('created_at', 'desc');
        if ($request->name) {
            $data->where(function ($query) use ($request) {
                $query->where('name', 'like', "%" . $request->name . "%");
            });
        }

        if ($request->email) {
            $data->where(function ($query) use ($request) {
                $query->where('email', 'like', "%" . $request->email . "%");
            });
        }

        if ($request->phone) {
            $data->where(function ($query) use ($request) {
                $query->where('phone', 'like', "%" . $request->phone . "%");
            });
        }


        return Datatables::of($data)

            ->editColumn('profile_image', function ($row) {
                return ($row->profile_image) ? '<img class="profile-img" src="' . asset($row->profile_image) . '" alt="profile image">' : '<img class="profile-img" src="' . asset('assets/img/no-img.jpg') . '" alt="profile image">';
            })

            ->editColumn('name', function ($row) {
                return '<a href="' . route('admin.user.details', ['id' => $row->id]) . '">' . $row->name . '</a>';
            })

            ->editColumn('role', function ($row) {
                return optional($row->roles)->name;
            })

            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success-200 text-success-700 rounded-pill w-80">Active</span>';
                } else {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Inactive</span>';
                }
            })

            ->addColumn('action', function ($row) {
                $btn = '';
                if (Helper::hasRight('user.edit')) {
                    $btn = $btn . '<a href="" data-id="' . $row->id . '" class="edit_btn btn btn-sm text-gray-900"><i class="fa-solid fa-pencil"></i></a>';
                }
                if (Helper::hasRight('user.delete')) {
                    $btn = $btn . '<a class="delete_btn btn btn-sm text-gray-900" data-id="' . $row->id . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['profile_image', 'name', 'role', 'status', 'action'])->make(true);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|string|max:255',
            'address' => 'required',
            'profile_image' => 'required|image|mimes:jpg,png|max:20480'
        ], [
            'phone.unique' => 'This phone number has already been taken.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $example = new User();
            $example->name = $request->name;
            $example->username = time();
            $example->email = $request->email;
            $example->phone = $request->phone;
            $example->address = $request->address;
            $example->status  = ($request->status) ? 1 : 0;
            $example->role = 3;

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/user-images'), $filename);
                $example->profile_image = 'uploads/user-images/' . $filename;
            }
            $example->save();

            DB::commit();

            $response = [
                'status' => 1,
                'msg' => 'User created successfully.',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ];
            return response()->json($response, 200);
        }
    }

    public function edit(Request $request)
    {
        $example = User::find($request->id);

        $data = [
            'example' => $example,
        ];

        return view('backend.pages.example.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|string|max:255',
            'address' => 'required',
            'profile_image' => 'image|mimes:jpg,png|max:20480'
        ], [
            'phone.unique' => 'This phone number has already been taken.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $example = User::find($request->id);

            if (!$example) {
                $response = [
                    'status' => 0,
                    'msg' => 'User not found.',
                ];
                return response()->json($response, 200);
            }

            $example->name = $request->name;
            $example->username = time();
            $example->email = $request->email;
            $example->phone = $request->phone;
            $example->address = $request->address;
            $example->status  = ($request->status) ? 1 : 0;
            $example->role = 3;

            if ($request->hasFile('profile_image')) {
                if ($example->profile_image != Null && file_exists(public_path($example->profile_image))) {
                    unlink(public_path($example->profile_image));
                }
                $image = $request->file('profile_image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/user-images'), $filename);
                $example->profile_image = 'uploads/user-images/' . $filename;
            }
            $example->save();

            DB::commit();

            $response = [
                'status' => 1,
                'msg' => 'User created successfully.',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ];
            return response()->json($response, 200);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $example = User::find($request->id);

            if (!$example) {
                $response = [
                    'status' => 0,
                    'msg' => 'User not found.',
                ];
                return response()->json($response, 200);
            }

            $example->delete();
            DB::commit();

            $response = [
                'status' => 1,
                'msg' => 'User deleted successfully.',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ];
            return response()->json($response, 200);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $example = User::find($request->user_id);
        if ($example) {
            $example->password = Hash::make($request->password);
            $example->save();
            return response()->json([
                'type' => 'success',
                'message' => 'User password changed successfully.',
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found.',
            ]);
        }
    }

    public function userDetails($id)
    {
        $example = User::find($id);
        $data = [
            'user' => $example,
        ];
        return view('backend.pages.example.user_details', $data);
    }

    public function getDetailList(Request $request)
    {

        $data = Order::where('user_id', $request->id)->get();

        return Datatables::of($data)

            ->addColumn('order_id', function ($row) {
                return $row->id;
            })
            ->addColumn('pickup_location', function ($row) {
                return $row->pickup_location;
            })
            ->addColumn('drop_location', function ($row) {
                return $row->drop_location;
            })

            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success-200 text-success-700 rounded-pill w-80">Pending</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Driver Assigned</span>';
                } elseif ($row->status == 3) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">User declined</span>';
                } elseif ($row->status == 4) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Dispatcher Cancel</span>';
                } elseif ($row->status == 5) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Driver Cancel</span>';
                } elseif ($row->status == 6) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Driver Accept</span>';
                } elseif ($row->status == 7) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Active</span>';
                } elseif ($row->status == 8) {
                    return '<span class="badge bg-gray-200 text-gray-600 rounded-pill w-80">Complete</span>';
                }
            })

            ->addColumn('action', function ($row) {
                $btn = '';
                if (Helper::hasRight('user.edit')) {
                    $btn = $btn . '<a href="" data-id="' . $row->id . '" class="edit_btn btn btn-sm text-gray-900"><i class="fa-solid fa-pencil"></i></a>';
                }
                if (Helper::hasRight('user.delete')) {
                    $btn = $btn . '<a class="delete_btn btn btn-sm text-gray-900" data-id="' . $row->id . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['order_id', 'pickup_location', 'drop_location', 'status', 'action'])->make(true);
    }
}
