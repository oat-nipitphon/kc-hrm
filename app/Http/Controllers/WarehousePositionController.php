<?php

namespace App\Http\Controllers;

use App\Warehouse_position;
use Illuminate\Http\Request;

class WarehousePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse-positions.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse_position  $Warehouse_position
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse_position $Warehouse_position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse_position  $Warehouse_position
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse_position $Warehouse_position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse_position  $Warehouse_position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse_position $Warehouse_position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse_position  $Warehouse_position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse_position $Warehouse_position)
    {
        //
    }
}
