<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function section_name()
    {
        return $this->belongsTo('App\Section','section_id');
    }

    public function get_section()
    {
        return $this->belongsTo('App\Section','section_id');
	}

}
