<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\UserHasContent;

class DownloadController extends Controller
{
    //
    
    public function showHistory(Request $request){
        $c=[];
        $i=0;
        
        $user = Auth::user(); 
        
        $contents = $user->contents;
        
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
    
    public function imageDownload($publisher_id, $content_type, $content_id, $filename){

        $file_path = storage_path('app/files/' . $publisher_id . '/' . $content_type . '/' . $content_id . '/' . $filename);
    
        if (file_exists($file_path)){
            return Response()->file($file_path);
        }
        else{
            exit('Requested file does not exist on our server!');
        }

    }
    
    public function apkDownload($publisher_id, $content_type, $content_id, $filename){

        $user = Auth::user();
        
        $file_path = storage_path('app/files/' . $publisher_id . '/' . $content_type . '/' . $content_id . '/' . $filename);
        if (file_exists($file_path)){
            $content = \App\Content::find($content_id);
            $content->users()->attach($user);
            return Response()->file($file_path);
        }
        else{
            exit('Requested file does not exist on our server!');
        }
    }
}
