<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User; 
use App\Content;
use App\ContentImage;
use Illuminate\Support\Facades\Auth; 
use Validator;

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
            $media = $content->media;
            $file = $content->file;
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
            //$c[$i]=$content;
            //return $content;
          //  echo $content;
            }
        //return $c;
        return response()->json( ['contents' => $content], 200);
        
    }
    
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
        }
        else{
            $contents = Content::where('catagory_id', $catID)
                    ->get();
        }
        
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
    
    public function showSearch(Request $request){
        
    }
    
    public function searchContent(Request $request){
        
        $user = Auth::user();
        
        $search = $request->s;
        
        $contents = Content::where('name', 'LIKE', '%'.$search.'%')
                ->orwhere('desc', 'LIKE', '%'.$search.'%')
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
}
