<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
	// use SoftDeletes;
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function getActiveNameAttribute()//Mulators
	{
		return (($this->is_active) == 1 ? "ทำงาน" : "หยุดทำงาน" );
	}

	public function getActiveCssAttribute()
	{
		return (($this->is_active) == 1 ? "primary" : "danger" );
	}

	public function getSexNameAttribute()
	{		
		return (($this->sex) == 1 ? "ชาย" : "หญิง" );
	}

	public function getRelationNameAttribute()
	{		
		if($this->relation_status == 1){
			$rel = 'โสด';
		}elseif($this->relation_status == 2){
			$rel = 'แต่งงานแล้ว';
		}elseif($this->relation_status == 3){
			$rel = 'หม้าย';
		}elseif($this->relation_status == 4){
			$rel = 'หย่า หรือแยกกันอยู่';
		}else{
			$rel = null;
		}
		return $rel;
	}

	public function title_name()
    {
        return $this->belongsTo('App\Title','title');
	}
	
	public function emp_type()
    {
        return $this->belongsTo('App\EmployeeType','employee_type_id');
	}
	
	public function warehouse_position()
    {
        return $this->belongsTo('App\Warehouse_position','warehouse_position_id');
	}

	public function emp_position()
    {
        return $this->hasMany('App\Employee_position','employee_id','id');
	}
	
	public function emp_user()
	{
		return $this->belongsTo('App\User','user_id','id');
	}

	public function emp_workTime()
	{
		return $this->hasOne('App\Employee_worktime','employee_id','id');
	}

	
}
