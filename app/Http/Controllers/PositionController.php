<?php

namespace App\Http\Controllers;

use App\Position;
use App\Section;
use App\Warehouse_position;
use Illuminate\Http\Request;



class PositionController extends Controller
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
        $sections = Section::join('divisions','divisions.id','sections.division_id')
                            ->select(
                                     'sections.*',
                                     'divisions.name AS division_name'
                                    )
                            ->orderBy('sections.name','asc')
                            ->get();
        return view('positions.index')->with(compact('sections'));
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

    public function get_positions(){
        $data['data'] = Position::join('sections','sections.id','positions.section_id')
                            ->join('divisions','divisions.id','sections.division_id')
                            ->select(
                                'positions.*',
                                'sections.name AS section_name',
                                'divisions.name AS division_name'
                            )
                            ->get();
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
        $position = new Position;
        $position->name = $req->name;
        $position->section_id = $req->section_id;
  
        if($position->save()){
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
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        return Position::find($req->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        return Position::find($req->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $position = Position::find($req->id);
        $position->name = $req->name;
        $position->section_id = $req->section_id;
        
        if($position->save()){
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
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }



}
