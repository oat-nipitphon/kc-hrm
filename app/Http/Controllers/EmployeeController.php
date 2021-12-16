<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use App\Title;
use App\Employee_guest;
use App\Employee_position;
use App\Permission;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use DB;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('employees.index');
    }

    public function leave_demo()
    {
        return view('employees.leave-demo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = Title::all();
        $warehouses = Warehouse::all();
        $actions = 'create';
        $id = null;
        return view('employees.create',compact('titles','warehouses','actions','id'));
    }

    public function show($id)
    {
        $titles = Title::all();
        $warehouses = Warehouse::all();
        $actions = 'view';
        return view('employees.create',compact('titles','warehouses','actions','id'));
    }

    public function edit($id)
    {
        $titles = Title::all();
        $warehouses = Warehouse::all();
        $actions = 'edit';
        return view('employees.create',compact('titles','warehouses','actions','id'));
    }

    public function create_excel()
    {
        return view('employees.create-excel');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {

        // return $request;
        $image_path = null;
        $employee = new Employee;
        $employee->emp_id = $this->getEmpID();
        $employee->th_firstname = $request->th_firstname;
        $employee->th_lastname = $request->th_lastname;
        $employee->en_firstname = null;
        $employee->en_lastname = null;
        $employee->image = $image_path;
        $employee->title = $request->title;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->relation_status = $request->relation_status;
        $employee->sex = $request->sex;
        $employee->email_address = $request->email_address;
        $employee->tel_number = $request->tel_number;
        $employee->national = $request->national;
        $employee->id_passport = $request->id_passport;
        $employee->is_active = 1;
        $employee->save();

        if($request->guarantor_firstname){
            $data_guarantor = [
                'firstname' => $request->guarantor_firstname,
                'lastname' => $request->guarantor_lastname,
                'relative' => $request->guarantor_relative,
                'employee_id' => $employee->id,
                'rule' => 'ผู้ค้ำประกัน',
                'rule_type' => '1',
            ];
            Employee_guest::create($data_guarantor);           
        }

        if($request->emergency_firstname){
            $data_emergency = [
                'firstname' => $request->emergency_firstname,
                'lastname' => $request->emergency_lastname,
                'relative' => $request->emergency_relative,
                'employee_id' => $employee->id,
                'rule' => 'ผู้ติดต่อยามฉุกเฉิน',
                'rule_type' => '2',
            ];
            Employee_guest::create($data_emergency);           
        }

        if($request->emp_image){
            $request->validate([
                'emp_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
            $image_type = '.'.$request->emp_image->getClientOriginalExtension();
            $image_name = $employee->id.$image_type;
            $image_path_upload = 'employee-profile/';                        
            $request->file('emp_image')->storeAs('public/'.$image_path_upload,$image_name);
            $employee->image = $image_path_upload.$image_name;
            $employee->save();
        }

        if(count($request->warehouse_position_id)){
            foreach ($request->warehouse_position_id as $emp_position) {
                $position = new Employee_position;
                $position->employee_id = $employee->id;
                $position->warehouse_position_id = $emp_position;
                $position->save();
            }           
        }

        return redirect()->route('employees.index')->with('status', 'เพิ่มพนักงานเรียบร้อย!');
    }

    private function getEmpID()
    {
        $lastEmpCode = Employee::where('emp_id','!=',null)->orderBy('id','desc')->limit(1)->first();
        if($lastEmpCode){
            $EmpCode = ++$lastEmpCode->emp_id;
        }else{
            $EmpCode = null;
        }
        return $EmpCode;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $titles = Title::all();
    //     $employee = Employee::find($id);
    //     $guarantor = Employee_guest::where(['employee_id'=> $id,'rule_type' => 1])->first();
    //     $emergency = Employee_guest::where(['employee_id'=> $id,'rule_type' => 2])->first();
    //     return view('employees.edit',compact('employee','id','titles','guarantor','emergency'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        $employee->th_firstname = $request->th_firstname;
        $employee->th_lastname = $request->th_lastname;
        $employee->en_firstname = '-';
        $employee->en_lastname = '-';
        $employee->title = $request->title;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->relation_status = $request->relation_status;
        $employee->sex = $request->sex;
        $employee->email_address = $request->email_address;
        $employee->tel_number = $request->tel_number;
        $employee->national = $request->national;
        $employee->id_passport = $request->id_passport;

        if($request->emp_image){
            $request->validate([
                'emp_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
            $image_type = '.'.$request->emp_image->getClientOriginalExtension();
            $image_name = $employee->id.$image_type;
            $image_path_upload = 'employee-profile/';
            $request->file('emp_image')->storeAs('public/'.$image_path_upload,$image_name);
            $employee->image = $image_path_upload.$image_name;
        }
        $employee->save();

        if(count($request->warehouse_position_id)){
            $emp_positions = Employee_position::where('employee_id',$id)->delete();
            foreach ($request->warehouse_position_id as $emp_position) {
                $position = new Employee_position;
                $position->employee_id = $employee->id;
                $position->warehouse_position_id = $emp_position;
                $position->save();
            }           
        }
        return redirect()->route('employees.show',compact('employee'))->with('status', 'แก้ไขพนักงานเรียบร้อย!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant=Restaurant::find($id);
        if ($restaurant->is_active == 0) {
            $restaurant->is_active = 1;
        }
        else if ($restaurant->is_active == 1) {
            $restaurant->is_active = 0;
        }
        $restaurant->save();
        return redirect()->route('restaurant.show',compact('restaurant','id'))->with('status', 'เปลี่ยนสถานะเรียบร้อย!');
    }

    public function save_excel(Request $req)
    {   
        $employees = json_decode($req->employees);
           foreach ($employees as $key => $empx) {    
            
                    $emp = Employee::where('emp_id',@$empx->emp_code)->first();
                    if($emp){
                        $emp->emp_time_attendance = $empx->mCode;
                        $emp->save();
                    }  
             
                          
           }
      
        return 'success';
    }
    
    public function getEmployees(Request $req)
    {
        if(@$req->is_permission){

            $division = @$req->search_data['division'];
            $position = @$req->search_data['position'];
            $section = @$req->search_data['section'];
            $warehouse = @$req->search_data['warehouse'];

            $data = datatables()->of(Employee::query()
            ->with('title_name',
                    'emp_type',
                    'emp_position.warehouse_position.get_warehouse',
                    'emp_position.warehouse_position.get_position.get_section.get_division'
                )
            ->where('user_id',null)
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


        }else{
            $data['data'] = Employee::query()
            ->with('title_name',
                    'emp_type',
                    'emp_position.warehouse_position.get_warehouse',
                    'emp_position.warehouse_position.get_position.get_section.get_division'
                )
                
            ->orderBy('emp_id','asc')
            ->get();
        }
        return $data;
    }

    public function get_employee_self(Request $req)
    {
        return Employee::with('title_name',
            'emp_type',
            'emp_position.warehouse_position.get_warehouse',
            'emp_position.warehouse_position.get_position.get_section.get_division'
        )->find($req->id);
    }
   
}
