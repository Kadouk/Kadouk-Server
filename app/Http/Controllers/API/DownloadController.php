<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\UserHAsContent;

class DownloadController extends Controller
{
    //
    
    public function History(Request $request){
        $c=[];
        $i=0;
        
        $user = Auth::user(); 
        
        $cat = \App\UserHAsContent::where('users_id', $user->user_id)->get();
        
        foreach($contents as $content)
        {
            $image = $content->image->path;
            
            if($content->image){
                $content = $content->toArray();
                $content['image']=$image;
                $c[$i]=$content;
                $i++;
            }
        }
        return response()->json( ['contents' => $c], 200); 
        
    }
}
