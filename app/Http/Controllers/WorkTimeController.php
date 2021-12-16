<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work_time;
use App\Work_time_leave;
use App\Work_time_ot;
use App\Warehouse;
use App\Section;
use App\Division;
use App\Position;
use App\Employee;
use App\Employee_worktime;

class WorkTimeController extends Controller
{
    public function index(){
        return view('worktime.index');
    }

    public function index_leave(){
        return view('settings.work_time_leaves');
    }

    public function index_ot(){
        return view('settings.work_time_ot');
    }

   

    public function get_work_time(Request $req){
        if(@$req->id){
            $data = Work_time::find($req->id);
        }else{
            $data['data'] = Work_time::all();
        }        
        return $data;
    }

    public function work_time_save(Request $req){
        $work_time = new Work_time;
        $work_time->name = $req->name;
        $work_time->start_time = $req->start_time;
        $work_time->end_time = $req->end_time;
        $work_time->total_time = $req->total_time;
        $work_time->types = $req->types;
        if($work_time->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function work_time_edit(Request $req){
        $work_time = Work_time::find($req->id);
        $work_time->name = $req->name;
        $work_time->start_time = $req->start_time;
        $work_time->end_time = $req->end_time;
        $work_time->total_time = $req->total_time;
        $work_time->types = $req->types;
        if($work_time->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function workTimeview(){
        $data['warehouses'] = Warehouse::all();
        $data['sections'] = Section::all();
        $data['divisions'] = Division::all();
        $data['positions'] = Position::all();
        $data['worktimes'] = Work_time::all();
        return view('worktime.workTimeEmployee')->with($data);
    }

    public function create_workTime_employee(Request $req){
  
        $work_time_id = $req->work_time;
        foreach ($req->emp_id as $emp_id) {
            $employee = Employee_worktime::where('employee_id',$emp_id)->first();
            if(!$employee){
                $employeeWorktime = new Employee_worktime;
                $employeeWorktime->employee_id = $emp_id;
                $employeeWorktime->work_time_id = $work_time_id;
                $employeeWorktime->save();
            }else{
                $employee->work_time_id = $work_time_id;
                $employee->save();
            }
        }
        $data = [
            'title' => 'สำเร็จ',
            'msg' => 'บันทึกข้อมูลสำเร็จ',
            'status' => 'success',                
        ];
        return $data;
    }

    public function getEmployees(Request $req)
    {  
        $division = @$req->search_data['division'];
        $position = @$req->search_data['position'];
        $section = @$req->search_data['section'];
        $warehouse = @$req->search_data['warehouse'];

        $data = datatables()->of(Employee::query()
        ->with('title_name',
                'emp_type',
                'emp_position.warehouse_position.get_warehouse',
                'emp_position.warehouse_position.get_position.get_section.get_division',
                'emp_workTime.workTime'
            )
        // ->where('user_id',null)
        ->whereHas('emp_position.warehouse_position.get_warehouse',function($query) use($warehouse) {
            if($warehouse){
                $query->where('id',$warehouse);
            }
        })
        ->whereHas('emp_position.warehouse_position.get_position',function($query) use($position) {
            if($position){
                $query->where('id',$position);
            }
        })
        ->whereHas('emp_position.warehouse_position.get_position.get_section',function($query) use($section) {
            if($section){
                $query->where('id',$section);
            }
        })
        ->whereHas('emp_position.warehouse_position.get_position.get_section.get_division',function($query) use($division) {
            if($division){
                $query->where('id',$division);
            }
        })
        ->orderBy('emp_id','asc')
        )->toJson();

        return $data;
    }

    public function get_work_time_leave(Request $req){
        if(@$req->id){
            $data = Work_time_leave::find($req->id);
        }else{
            $data['data'] = Work_time_leave::all();
        }        
        return $data;
    }

    public function work_time_leave_save(Request $req){
        $work_time_leave = new Work_time_leave;
        $work_time_leave->name = $req->name;
        $work_time_leave->days = $req->days;
        $work_time_leave->remark = $req->remark;
        if($work_time_leave->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function work_time_leave_edit(Request $req){
        $work_time_leave = Work_time_leave::find($req->id);
        $work_time_leave->name = $req->name;
        $work_time_leave->days = $req->days;
        $work_time_leave->remark = $req->remark;
        if($work_time_leave->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function get_work_time_ot(Request $req){
        if(@$req->id){
            $data = Work_time_ot::find($req->id);
        }else{
            $data['data'] = Work_time_ot::all();
        }        
        return $data;
    }

    public function work_time_ot_save(Request $req){
        $work_time_leave = new Work_time_ot;
        $work_time_leave->name = $req->name;
        $work_time_leave->ratio_rate = $req->ratio_rate;
        $work_time_leave->time_rate = $req->time_rate;
        $work_time_leave->remark = $req->remark;
        if($work_time_leave->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function work_time_ot_edit(Request $req){
        $work_time_leave = Work_time_ot::find($req->id);
        $work_time_leave->name = $req->name;
        $work_time_leave->ratio_rate = $req->ratio_rate;
        $work_time_leave->time_rate = $req->time_rate;
        $work_time_leave->remark = $req->remark;
        if($work_time_leave->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }




}
