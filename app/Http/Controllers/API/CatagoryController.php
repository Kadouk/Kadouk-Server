<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatagoryController extends Controller
{
    //
    
    public function getCat(){
        $subs = DB::table("catagory")->pluck("name","id");

        return json_encode($subs);
    }
}
