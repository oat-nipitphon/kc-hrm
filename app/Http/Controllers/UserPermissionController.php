<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_permission;
use App\Employee;
use App\Permission;
use App\Permission_user;
use App\Permission_group;
use App\Permission_subgroup;
use App\Warehouse;
use App\Section;
use App\Division;
use App\Position;
use Hash;

class UserPermissionController extends Controller
{
    public function index()
    {
        $data['warehouses'] = Warehouse::all();
        $data['sections'] = Section::all();
        $data['divisions'] = Division::all();
        $data['positions'] = Position::all();
        return view('users.user-permission')->with($data);
    }

    public function permission_user_view($user_id = null)
    {
        $data['user_id'] = $user_id;
        $data['groups'] = Permission_group::with('subgroups.permission')->get();
        return view('users.user-permission-manage')->with($data);
    }

    public function get_edit_permission(Request $req)
    {
        return Permission_user::where('user_id',$req->user_id)->get();
    }

    public function show_employee_user()
    {
        $data['warehouses'] = Warehouse::all();
        $data['sections'] = Section::all();
        $data['divisions'] = Division::all();
        $data['positions'] = Position::all();
        return view('users.user-create')->with($data);
    }

    public function get_user(Request $req)
    {
        $division = @$req->search_data['division'];
        $position = @$req->search_data['position'];
        $section = @$req->search_data['section'];
        $warehouse = @$req->search_data['warehouse'];
        $id = 160;
        $data['data'] = Employee::with(
            ['title_name',
                'emp_type',
                'emp_user',
                'emp_position.warehouse_position.get_warehouse',
                'emp_position.warehouse_position.get_position.get_section.get_division']
            )
           
        ->where('user_id','!=',null)
        ->orderBy('emp_id','asc')
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
        ->get();
        return $data;
    }

    public function create_employee_user(Request $req)
    {
        $employee = Employee::find($req->employee_id);
        if(!$employee->user_id){
            $user = new User;
            $user->username = $req->username;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->save();

            $employee->user_id = $user->id;           
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
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'พนักงานมี Username เรียบร้อยแล้ว',
                'status' => 'error',                
            ];
        }        
        return $data;
    }

    public function get_permissions()
    {
        $data = Permission_group::with('subgroups')->get();
        return $data;
    }

    // public function save_user_permission(Request $req)
    // {
    //     $user_permissions = $req->permission;
    //     Permission_user::where('user_id',$req->user_id)->delete();
    //     foreach ($user_permissions as $user_permission) {
    //         $permission_user = new Permission_user;
    //         $permission_user->permission_id = $user_permission;
    //         $permission_user->user_id = $req->user_id;
    //         $permission_user->save();
    //     }
    //     return $req;
    // }

    public function check_employee_user(Request $req)
    {
        if(count($req->all()) > 1){
            $default_password = '123456';
            $employees = Employee::whereIn('id',$req->emp_id)->get();
            $users = [];
            foreach ($employees as $employee) {
                $user = new User;
                $user->username = str_replace('-','',$employee->emp_id);
                $user->email = str_replace('-','',$employee->emp_id).'@kcmetalsheet.com';
                $user->password = Hash::make($default_password);
                $user->name = $employee->th_firstname .' '.$employee->th_lastname;
                $user->save();
                $employee = Employee::find($employee->id);
                $employee->user_id = $user->id;
                $employee->save();
                array_push($users,$user);
            }
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',
                'data' => $users,
                'password' => $default_password,
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'กรุณาเลือกพนักงานที่ต้องการ',
                'status' => 'error',                
            ];
        }

        return $data;
    }

    public function save_user_permission(Request $req)
    {
        $user_ids = $req->user_id;
        $permissions = $req->permissions;
        foreach ($user_ids as $user_id) {
            $delete_permission = Permission_user::where('user_id',$user_id)->delete();
            foreach ($permissions as $permission) {                
                $perm = new Permission_user;
                $perm->permission_id = $permission;
                $perm->user_id = $user_id;
                $perm->user_type = 'App/User';
                $perm->save();
            }
       }
        return redirect()->route('user-permisisons')->with('status', 'เพิ่ม Permission สำเร็จ!');
    }
}
