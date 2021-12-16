<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Permission_group;
use App\Permission_subgroup;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.index');
    }



    public function get_group_permissions()
    {
        return Permission_group::all();
    }

    public function get_sub_group_permissions(Request $req)
    {
        return Permission_subgroup::where('permission_groups_id',$req->group_id)->get();
    }

    public function save_group_permission(Request $req)
    {
        $group = new Permission_group;
        $group->name = $req->name;
        $group->save();
        return $group->id;
    }

    public function save_permission(Request $req)
    {
        $permission = new Permission;
        $permission->display_name = $req->display_name;
        $permission->name = $req->name;
        $permission->description = $req->description;
        if($permission->save()){
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
