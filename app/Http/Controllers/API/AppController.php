<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\App;

class AppController extends Controller
{
    //
    
    public function checkVersion(Request $r){
        
        $version = $r->version;
        
        $app_version = App::where('meta', 'version')->first()['description'];
        $importance = App::where('meta', 'version')->first()['importance'];
        
        if($app_version != $version){
            if($importance == 0){
                return response()->json( ['update' =>'option'], 200);
            }
            else if($importance == 1){
                return response()->json( ['update' =>'force'], 200);
            } 
        }
        else{
            return response()->json( ['update' =>'No'], 200);
        }
        
    }
}
