<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\Warehouse_position;
use App\Department;
use App\Position;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\WarehouseRequest;
class WarehouseController extends Controller
{

    public function index()
    {
        return view('warehouses.index');
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $warehouse = new Warehouse;
        $warehouse->code = $request->code;
        $warehouse->name = $request->name;
        $warehouse->line_name = $request->line_name;
        $warehouse->line_token = $request->line_token;
        $warehouse->is_active = $request->is_active;
        $warehouse->save();
        return redirect()->route('warehouses.index')->with('status', 'เพิ่มสาขาเรียบร้อย!');
    }


    public function show($id)
    {
        $warehouse = Warehouse::find($id);        
        return view('warehouses.show',compact('warehouse','id'));
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        return view('warehouses.edit',compact('warehouse','id'));
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->code = $request->code;
        $warehouse->name = $request->name;
        $warehouse->line_name = $request->line_name;
        $warehouse->line_token = $request->line_token;
        $warehouse->is_active = $request->is_active;
        $warehouse->save();
        return redirect()->route('warehouses.index')->with('status', 'แก้ไขสาขา '.$request->name.'('.$request->code.') สำเร็จ!');
    }


    public function get_warehouse()
    {
        $data['data'] = Warehouse::get();
        return $data;
    }

    public function get_warehouse_position(Request $req)
    {
        $data['data'] = Warehouse_position::join('positions','positions.id','warehouse_positions.position_id')
                    ->join('sections','sections.id','positions.section_id')
                    ->join('divisions','divisions.id','sections.division_id')
                    ->where('warehouse_positions.warehouse_id',$req->id)
                    ->select(
                        'warehouse_positions.id',
                        'sections.name as section_name',
                        'positions.name as position_name',
                        'divisions.name as division_name',
                    )
                    ->get();                    
        return $data;
    }



    public function warehouse_position(Request $req)
    {
        $data['data'] = Position::join('sections','sections.id','positions.section_id')
                    ->join('divisions','divisions.id','sections.division_id')
                    ->select(
                        'sections.name as section_name',
                        'positions.name as position_name',
                        'positions.id',
                        'divisions.name as division_name',
                    )
                    ->get();                    
        return $data;
    }

    public function get_warehouse_employees(Request $req)
    {
        $data['data'] = Employee::join('warehouse_positions','warehouse_positions.id','employees.warehouse_position_id')
                    ->join('positions','positions.id','warehouse_positions.position_id')
                    ->join('sections','sections.id','positions.section_id')
                    ->join('divisions','divisions.id','sections.division_id')
                    ->where('warehouse_positions.warehouse_id',$req->id)
                    ->select(
                        'employees.id',
                        'employees.emp_id',
                        'employees.th_firstname',
                        'employees.th_lastname',
                        'sections.name as section_name',
                        'positions.name as position_name',
                        'divisions.name as division_name',
                    )
                    ->get();
        return $data;
    }

    public function get_warehouse_save_employees(Request $req)
    {
        $employee = Employee::find($req->emp_id);
        $employee->warehouse_position_id = $req->warehouses_position_id;
        if($employee->save()){
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



    public function get_warehouse_add_employees()
    {
        $data['data'] = Employee::where('warehouse_position_id',null)->get();
        return $data;
    }
    

    public function warehouse_add_position(Request $req)
    {
        $warehouse = new Warehouse_position;
        $warehouse->warehouse_id = $req->warehouse_id;
        $warehouse->position_id = $req->position_id;
        if($warehouse->save()){
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

    public function get_manpower(Request $req)
    {
        $warehouse['data'] = Employee::join('warehouse_positions','warehouse_positions.id','employees.warehouse_position_id')
                    ->join('positions','positions.id','warehouse_positions.position_id')
                    ->join('sections','sections.id','positions.section_id')
                    ->join('divisions','divisions.id','sections.division_id')
                    ->where('warehouse_positions.warehouse_id',$req->id)
                    ->groupBy('employees.warehouse_position_id')
                    ->selectRaw('count(employees.id) AS count_manpower,
                                positions.name AS position_name,
                                sections.name AS section_name,
                                divisions.name AS division_name,
                                warehouse_positions.manpower,
                                warehouse_positions.id
                                ')
                    ->get();
        return $warehouse;
    }

    public function save_manpower(Request $req)
    {
        $warehouse_position = Warehouse_position::find($req->id);
        $warehouse_position->manpower = $req->manpower;
        if($warehouse_position->save()){
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

    public function view_manage_warehouse()
    {
        return view('warehouses.manage-warehouse');
    }

    
}
