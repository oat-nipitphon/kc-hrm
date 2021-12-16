<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestWorkTime;
use App\Work_time_leave;
use App\Work_time_ot;
use App\User;
use App\Employee;
use Auth;

class RequestWorkTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
        return view('request-pages.request');
    }

    // function get_request_work_time(Request $req){
        
    //     return RequestWorkTime::with('')->get();
    // }

    function index_approve(){
        $data_ot = RequestWorkTime::with('employee','user','approves','ot')->where('request_type','OT')->orderBy('status','asc')->get();
        $data_leave = RequestWorkTime::with('employee','user','approves','leave')->where('request_type','Leave')->orderBy('status','asc')->get();
        return view('request-pages.approve')->with(compact('data_ot','data_leave'));
    }

    function pages($pages){
        $data = '';
        if($pages == 'history'){
            $data = RequestWorkTime::with('employee','user','approves')->orderBy('status','asc')->get();
        }
        return view('request-pages.pages.'.$pages)->with(compact('data'));
    }

    function save_request(Request $req){
        foreach ($req->employee_id as $employee_id) {
            $requestWork = new RequestWorkTime;
            $requestWork->request_id = $req->request_id;
            $requestWork->request_type = $req->check;
            $requestWork->remark = $req->remark;
            $requestWork->user_id = Auth::user()->id;
            $requestWork->employee_id = $employee_id;
            $requestWork->start_time = $req->start_time;
            $requestWork->end_time = $req->end_time;
            $requestWork->status = 1;
            $requestWork->save();
            $images = [];
            // return $req->file('images');
            if($req->check == 'Leave'){
                if($req->request_id == 1){
                    Employee::find($employee_id)->decrement('la1',1);
                }elseif($req->request_id == 2){
                    Employee::find($employee_id)->decrement('la2',1);
                }elseif($req->request_id == 3){
                    Employee::find($employee_id)->decrement('la3',1);
                }elseif($req->request_id == 4){
                    Employee::find($employee_id)->decrement('la4',1);
                }elseif($req->request_id == 5){
                    Employee::find($employee_id)->decrement('la5',1);
                }else{
                    Employee::find($employee_id)->decrement('la6',1);
                }
            }

            foreach ($req->file('images') as $image) {
                $path = $image->store('evidence','public');
                array_push($images,$path);
            }
            $requestWork->images = json_encode($images);
            $requestWork->save();

        }
        return 'success';
    }

    function save_request_work_time(Request $req){
        if($req->approves == 'approve'){
            $approve = RequestWorkTime::find($req->id);
            $approve->status = 2;
            $approve->approve_by = Auth::user()->id;
            $approve->save();
        }else{
            $approve = RequestWorkTime::find($req->id);
            $approve->status = 3;
            $approve->approve_by = Auth::user()->id;
            $approve->save();
        }
        return 'success';
        
    }
}
