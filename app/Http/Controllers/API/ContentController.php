<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User; 
use App\Content;
use App\Catagory;
use App\ContentImage;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $contents = Content::all();
       $c=[];
       $i=0;
        foreach($contents as $content)
        {
            
            $image = $content->image->path;
            //echo $image;
            //if($image)
           // echo $image->path;
            //if($image)
              // $image = $image->toArray();
            //$content = $content->toArray();
            
            //echo $content->image;
            //echo $content->crossJoin($image);
            if($content->image){
               // echo $image->path;
           // $content->pull($content->image);
            $content = $content->toArray();
            $content['image']=$image;
            $c[$i]=$content;
            //return $content;
          //  echo $content;
            $i++;
            }
        }
        //return $c;
        return response()->json( ['contents' => $c], 200); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function showContent(Request $request){
        $content = Content::find($request->id);
                  
            $image = $content->image->path;
            $file = $content->file->path;
            $media = $content->media;
            
            
            //echo $image;
            //if($image)
           // echo $image->path;
            //if($image)
              // $image = $image->toArray();
            //$content = $content->toArray();
            
            //echo $content->image;
            //echo $content->crossJoin($image);
            
            if($content->image){
               // echo $image->path;
           // $content->pull($content->image);
            $content = $content->toArray();
            //$c['media'] = $media;
            $content['image']=$image;
            $content['file']=$file;
            //$c[$i]=$content;
            //return $content;
          //  echo $content;
            }
        //return $c;
        return response()->json(  $content, 200);
        
    }
    
    /**
     * Send all catagories in case that cat is -1
     *  and send one catagory when cat is catagory id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cat
     * @param  int  $num
     * 
     * @return \Illuminate\Http\Response
     */
    
    public function showCatContent(Request $request){
        
        $user = Auth::user();
        
        $catID = $request->cat;
        $num = $request->num;
        

        $cat = \App\Catagory::where('id', $catID)->first();
        if($cat){
            $catName = $cat->name;
        }
        else{
            $catName = "سایر";
        }
        
        if($num){
            $contents = Content::where('catagory_id', $catID)
                    ->take($num)
                    ->get();
            $c=[];
       $i=0;
       
        foreach($contents as $content)
        {
            $image = $content->image->path;
//            
            if($content->image){
                $content = $content->toArray();
                $content['image']=$image;
                $c[$i]=$content;

                $i++;
            }
        }
        }
        else{
            $contents = Content::where('catagory_id', $catID)
                    ->get();
            $c=[];
       $i=0;
       
        foreach($contents as $content)
        {
            $image = $content->image->path;
//            
            if($content->image){
                $content = $content->toArray();
                $content['image']=$image;
                $c[$i]=$content;

                $i++;
            }
        }
        }
        $d = [];
        $j=0;
        if($catID==-1){
//             $count = \App\Catagory::where('id', $catID)->first();
            
            for($k=1;$k<6;$k++){
                $cat = \App\Catagory::where('id', $k)->first();
        if($cat){
            $catName = $cat->name;
        }
        else{
            $catName = "سایر";
        }
           $contents = Content::where('catagory_id', $k)
                    ->get();
           $c=[];
       $i=0;
       
        foreach($contents as $content)
        {
            $image = $content->image->path;
//            
            if($content->image){
                $content = $content->toArray();
                $content['image']=$image;
                $c[$i]=$content;

                $i++;
            }
            //$c['catName']=$catName;
        }
        
        $d[$j] = ['contents' => $c, 'catName' => $catName]; 
        $j++;
            }
            
            return response()->json( ['cats' => $d], 200);     
        }
        
       
        
        
        return response()->json( ['contents' => $c, 'catName' => $catName], 200);       
    }
    
    
    
    public function showSearch(Request $request){
        $user = Auth::user();
        
        $search = $request->s;
        
        $contents = Content::where('name', 'LIKE', $search.'%')
                ->orwhere('desc', 'LIKE', $search.'%')
                ->select('name')
                ->orderBy('dl_count','desc')
                ->take(10)
                ->get();
  
        return response()->json( ['contents' => $contents], 200);   
        
    }
    
    public function searchContent(Request $request){
        
        $user = Auth::user();
        
        $search = $request->s;
        
        $contents = Content::where('name', 'LIKE', $search.'%')
                ->orwhere('desc', 'LIKE', $search.'%')
                
                ->get();
       $c=[];
       $i=0;
       
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
    
    public function getVersionAll(Request $request){
        
        $user = Auth::user();
        
        $search = $request->s;
        
        $contents = Content::select('name', 'id', 'version')
                ->get();

        return response()->json( ['contents' => $contents], 200);
    }
    
    public function ageFilter(Request $request){
        
    }
}
