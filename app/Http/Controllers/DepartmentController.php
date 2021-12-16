<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        
        $department = new Department;
        $department->code = $request->code;
        $department->name = $request->name;
        $department->is_active = $request->is_active;
        $department->save();
        
        return redirect()->route('departments.index')->with('status', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department=Department::find($id);
        return view('departments.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department=Department::find($id);
        return view('departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = $request->all();
        $department = Department::find($id);
        $department->code = $request['code'];
        $department->name = $request['name'];
        
        $department->save();
        return redirect()->route('departments.show',$id)->with('status', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if ($department->is_active == 1) {
            $department->is_active = 0;
        }
        else if ($department->is_active == 0) {
            $department->is_active = 1;
        }
        $department->save();
        return redirect()->route('departments.show',compact('departments','id'))->with('status', 'เปลี่ยนสถานะเรียบร้อยแล้ว!');
    }
}
