<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_worktime extends Model
{
    public function workTime()
	{
        return $this->hasOne('App\Work_time','id','work_time_id');
	}

}
