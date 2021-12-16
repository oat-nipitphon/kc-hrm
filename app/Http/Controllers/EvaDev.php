<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission_subgroup;
use App\Permission_group;

class EvaDev extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dev(Request $req)
    {
      return json_decode($req);
    }
}
