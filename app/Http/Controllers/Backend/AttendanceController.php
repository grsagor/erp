<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(){
        return view('backend.pages.attendance.index');
    }
    public function getSingleDayAttendance(Request $request) {
        $date = $request->date;
        $employees = User::where('role', 2)->with(['attendances' => function($query) use ($date) {
            $query->where('date', $date);
        }])->get();
        $html = view('backend.pages.attendance.single-day-attendance', compact('employees', 'date'))->render();
        $response = [
            'status' => 1,
            'html' => $html,
            'employees' => $employees
        ];
        return response()->json($response);
    }
    public function postSingleDayAttendance(Request $request) {
        try {
            DB::beginTransaction();
            foreach ($request->employee_id as $index => $id) {
                $attandance = Attendance::where([['date', $request->date], ['employee_id', $id]])->first();
                if (!$attandance) {
                    $attandance = new Attendance();
                }

                $attandance->employee_id = $id;
                $attandance->date = $request->date;
                $attandance->check_in = $request->check_in[$index];
                $attandance->check_out = $request->check_out[$index];
                $attandance->save();
            }
            DB::commit();
            return back()->with('success', 'Saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}