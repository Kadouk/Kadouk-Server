<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\UserHasContent;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Response;

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
    
    public function checkUpdate(Request $request){
        
        
    }
    
    public function imageDownload($publisher_id, $content_id, $filename){

        $file_path = storage_path('app/games/' . $publisher_id . '/' . $content_id . '/' . $filename);
    
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
            return Response()->file($file_path);
        }
        else{
            exit('Requested file does not exist on our server!');
        }
        
        $file_path = storage_path('app/files/' . $publisher_id . '/' . $content_type . '/' . $content_id . '/' . $filename);
        if (file_exists($file_path)){
              $size =filesize($file_path);
            $content = \App\Content::find($content_id);
            $content->users()->attach($user);
			$headers=array('Content-Length : ' . $size);
			$headers = [
              'Content-Length' => 1000,
           ];
		//    $file = "original.pdf"
// $size = filesize($file);

		//    $headers = array('Content-Length'=> 'application/pdf');
			//  return $headers;
			header("Content-Type: application/force-download");
	header("Content-Length: " .(string)(filesize($file_path)) );

	return file_get_contents($file_path);
	die();
			return response($file_path,200,$headers);
            // return response()->download($file_path,'a', $headers);
			$response = Response::file($file_path, $headers);
   			// $response->header('Content-Length', 1000);
   			return $response;
        }
        else{
            exit('Requested file does not exist on our server!');
        }
    }
    
    public function mediaDownload($publisher_id, $content_id, $filename){

        $file_path = storage_path('app/games/' . $publisher_id . '/' . $content_id . '/media/' . $filename);
    
        if (file_exists($file_path)){
            return Response()->file($file_path);
        }
        else{
            exit('Requested file does not exist on our server!');
        }

    }
}
