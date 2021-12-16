<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use session;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeUserRequest;
use DB;

class EmployeeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('employees.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $employees=Employee::find($id);
        return view('employees.create_user',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeUserRequest $request)
    {
        //dd($request->employees_id);

        //$user->employee_id = $request->employees_id;
        //dd($user->name,$user->employee_id);

        $employees=Employee::find($request->employees_id);
        if ($employees!=null) {
            DB::beginTransaction();

            $user=new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $employees->user_id=$user->id;
            $employees->save();

            DB::commit();
        }
        else{
            if ($user->id != 1) {
                DB::rollback();
            }
            return redirect()->route('employees.index')->with('status', 'ข้อมูลผิดพลาด!');
        }
        

        return redirect()->route('employees.index')->with('status', 'เพิ่มUserเรียบร้อย!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
