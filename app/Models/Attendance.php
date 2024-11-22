<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function getHoursWorked()
    {
        if (!($this->check_in) || !($this->check_out)) {
            return 0; // Return 0 if check-in or check-out time is not available
        }
        $checkIn = Carbon::createFromFormat('H:i', $this->check_in);
        $checkOut = Carbon::createFromFormat('H:i', $this->check_out);
        return $checkIn->diffInHours($checkOut); // Calculate hours worked
    }
}
