<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class DeviceController extends Controller
{
    public $successStatus = 200;
    
    /**
     * Get api version of android devices and save 
     * in devices table.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVersion(Request $request){
        $validator = Validator::make($request->all(), [ 
            'version' => 'required',          
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        $input = $request->all();
        $user = \App\Device::create($input); 
             
        $success['status'] =  200;
        return response()->json($success, $this-> successStatus); 
    }
}
