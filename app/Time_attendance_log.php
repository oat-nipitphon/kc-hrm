<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time_attendance_log extends Model
{
    public function employee_log(){
        return $this->hasOne('App\Employee','emp_time_attendance','userSn');
        
    }
}
