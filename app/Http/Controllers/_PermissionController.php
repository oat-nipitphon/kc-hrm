<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Permission;
use Auth;

class PermissionController extends Controller
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
      $permissions = Permission::all();
      return view('permissions.index')->withPermissions($permissions);
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
      return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->display_name = $request->display_name;
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();
        
        return redirect()->route('permissions.show',$permission->id)->with('status','สร้างเสร็จเรียบร้อย');
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
      $permission = Permission::findOrFail($id);
      return view('permissions.show')->withPermission($permission);
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
      $permission = Permission::findOrFail($id);
      return view('permissions.edit')->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
      $permission = Permission::findOrFail($id);
      $permission->display_name = $request->display_name;
      $permission->description = $request->description;
      $permission->save();

      return redirect()->route('permissions.show', $id)->with('status','แก้ไขเรียบร้อยแล้ว');
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
        Permission::destroy($id);
        return redirect()->route('permissions.index')->with('status','ลบเรียบร้อยแล้ว');
    }
}
