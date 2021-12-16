<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestWorkTime;

class HrmReportController extends Controller
{

    public function index()
    {
        return view('hrm-report.index');
    }

    public function getReport(Request $req)
    {   
            if($req->check_type)
            {
                if($req->check_type == 'all')
                {
                    $check_type = ['OT','Leave'];
                }
                else
                {
                    $check_type = [$req->check_type];
                }
            }

            if($req->check_status)
            {
                if($req->check_status == 'all')
                {
                    
                    $check_status = [1,2,3];
                }
                else
                {
                    $check_status= [$req->check_status];
                }
            }
            
            $data['data'] ='';
            $list = $data['data'] = RequestWorkTime::with('leave','user','employee','approves')
            ->whereIn('request_type', $check_type);
            
            if($check_status)
            {
                if($check_status)
                {
                    $list->whereIn('status', $check_status);
                }
                else{

                }
            }

            if($req->type_date)
            {
            
                if($req->type_date == 'day')
                {
                    $list->whereBetween('start_time', [$req->start_date,$req->end_date]);
                }
                else if($req->type_date == 'mon')
                {
                    $list->whereBetween('start_time', [$req->start_date.'-01',$req->end_date.'-31']);
                }
                else if($req->type_date == 'year')
                {
                    $list->whereBetween('start_time', [$req->start_date.'-01-01',$req->end_date.'-12-31']);
                }
                else if($req->type_date == 'start_date'){
                    $list->whereDate('start_time','>=',[$req->start_date]); 
                }
                else if($req->type_date == 'end_date'){
                    $list->whereDate('start_time','<=',[$req->end_date]); 
                }
                else if($req->type_date == 'timenow'){
                    $list->whereDate('start_time','<=',[$req->start_date]);
                }
                else
                {

                }

            }

            if($req->check_name)
            {
                $name = $req->check_name;
                    $list->whereHas('employee', function ($query) use ($name) {
                        return $query->where('th_firstname', 'LIKE', '%'.$name.'%');
                    });
            }
            else{

            }
            // ,'OR','th_lastname', 'LIKE', '%'.$name.'%'
            $data['data'] = $list->get();
            return $data;
    }
}
