<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_position extends Model
{
    public function get_warehouse()
    {
        return $this->belongsTo('App\Warehouse','warehouse_id');
    }
    
    public function get_position()
    {
        return $this->belongsTo('App\Position','position_id');
	}

}
