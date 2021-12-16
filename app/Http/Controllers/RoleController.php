<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Role;
use App\Permission;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if ( Auth::user()->hasRole('admin') == false ) {
        return view('home');
      }

      $roles = Role::all();
      return view('roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if ( Auth::user()->hasRole('admin') == false ) {
        return view('home');
      }
      $permissions = Permission::all();
      return view('roles.create')->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
      $role = new Role();
      $role->display_name = $request->display_name;
      $role->name = $request->name;
      $role->description = $request->description;
      $role->save();

      return redirect()->route('roles.show',$role->id)->with('status','สร้างเสร็จเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if ( Auth::user()->hasRole('admin') == false ) {
        return view('home');
      }
      $role = Role::where('id', $id)->with('permissions')->first();
      return view('roles.show')->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if ( Auth::user()->hasRole('admin') == false ) {
        return view('home');
      }
      $role = Role::where('id', $id)->with('permissions')->first();
      $permissions = Permission::all();
      return view('roles.edit')->withRole($role)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
      $role = Role::findOrFail($id);
      $role->display_name = $request->display_name;
      $role->description = $request->description;
      $role->save();

      if ($request->permission==null) {
        $role->detachPermission($request->permission);
      }else{
        $role->syncPermissions($request->permission);
      }

      return redirect()->route('roles.show', $id)->with('status','แก้ไขเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if ( Auth::user()->hasRole('admin') == false ) {
        return view('home');
      }
        Role::destroy($id);
        return redirect()->route('roles.index')->with('status','ลบเรียบร้อยแล้ว');
    }

}
