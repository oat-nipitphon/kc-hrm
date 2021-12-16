<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestWorkTime;
class ReportController extends Controller
{
    public function report_ot(){
        return view('reports.ot-report');
    }

    public function report_work_time(Request $req){
        if($req->status){
            if($req->status == 'all'){
                $status = [1,2,3];
            }else{
                $status = [$req->status];
            }
        }else{
            $status = [2];
        }

        $data['data'] = '';
        $raw = RequestWorkTime::with('employee','user','approves','leave')
                            ->whereIn('status',$status);
        if($req->report_id == 'Leave'){
            $raw->where(['request_type'=>'Leave','request_id'=> 8]);
        }else{
            $raw->where('request_type' , 'OT');
        }

        if($req->date_type == 'dmy'){
            $raw->whereBetween('start_time',[$req->date_start,$req->date_end]);
        }elseif($req->date_type == 'my'){
            $raw->whereBetween('start_time',[$req->date_start.'-01',$req->date_end.'-31']);
        }elseif($req->date_type == 'year'){
            $raw->whereBetween('start_time',[$req->date_start.'-01-01',$req->date_end.'-12-31']);
        }else{

        }


        $data['data'] = $raw->get();
        return $data;
    }
}
