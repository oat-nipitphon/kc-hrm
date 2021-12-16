<?php

namespace App\Http\Controllers;

use App\Section;
use App\Division;
use Illuminate\Http\Request;

class SectionController extends Controller
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
        $divisions = Division::get();
        return view('sections.index')->with(compact('divisions'));
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

    public function get_sections(){
        $data['data'] = Section::with('division_name')->get();
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
        $section = new Section;
        $section->name = $req->name;
        $section->division_id = $req->division_id;
        if($section->save()){
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
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        return Section::find($req->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        return Section::find($req->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $sections = Section::find($req->id);
        $sections->name = $req->name;
        $sections->division_id = $req->division_id;
        
        if($sections->save()){
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
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(sections $sections)
    {
        //
    }
}
