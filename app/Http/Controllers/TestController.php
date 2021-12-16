<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Division;
use App\Time_attendance_log;
class TestController extends Controller
{
    public function dev(Request $req)
    {
        $jsons = json_decode($req->times);
        foreach ($jsons as $key => $value) {
            $log = new Time_attendance_log;
            $log->userSn = $value->userSn;
            $log->deviceUserId = $value->deviceUserId;
            $log->ip = $value->ip;
            $log->recordTime = $value->recordTime;
            $log->save();
        }
        return 'success';
    }

    public function getatt(){
        $data['data'] = Time_attendance_log::with('employee_log.emp_position.warehouse_position.get_warehouse','employee_log.emp_position.warehouse_position.get_position.get_section.get_division')->get();
        return $data;
    }
}
