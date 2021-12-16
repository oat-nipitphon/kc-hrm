<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_group extends Model
{
    public function permission()
    {
        return $this->hasMany('App\Permission','display_name','group_name');
    }

    public function subgroups()
    {
        return $this->hasMany('App\Permission_subgroup','permission_groups_id','id');
    }
    
}
