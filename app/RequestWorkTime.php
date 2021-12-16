<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestWorkTime extends Model
{
    public function employee(){
        return $this->hasOne('App\Employee','id','employee_id');
    }
    
    public function ot(){
        return $this->hasOne('App\Work_time_ot','id','request_id');
    }

    public function leave(){
        return $this->hasOne('App\Work_time_leave','id','request_id');
    }

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function approves(){
        return $this->hasOne('App\User','id','approve_by');
    }
}
