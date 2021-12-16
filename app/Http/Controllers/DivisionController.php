<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
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
        return view('divisions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function get_divisions(){
        $data['data'] = Division::get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $divisions = new Division;
        $divisions->name = $req->name;
        
        if($divisions->save()){
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

    /**
     * Display the specified resource.
     *
     * @param  \App\divisions  $divisions
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        return Division::find($req->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\divisions  $divisions
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        return Division::find($req->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\divisions  $divisions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $divisions = Division::find($req->id);
        $divisions->name = $req->name;
        
        if($divisions->save()){
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\divisions  $divisions
     * @return \Illuminate\Http\Response
     */
    public function destroy(divisions $divisions)
    {
        //
    }

    public function save_divisions(Request $req)
    {
        foreach ($req->name as $division_name) {
            $division = new Division;
            $division->name = $division_name;
            $division->save();            
        }
        $data = [
            'title' => 'สำเร็จ',
            'msg' => 'บันทึกข้อมูลสำเร็จ',
            'status' => 'success',                
        ];
        return $data;
    }
}
