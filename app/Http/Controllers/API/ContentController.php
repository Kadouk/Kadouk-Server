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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $user = Auth::user();
        $contents = Content::all();

        $contents = $this->addImageUrls($contents);
        return response()->json(['contents' => $contents], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function showContent(Request $request) {
        $content = Content::find($request->id);

        $image = $content->image->path;
        $file = $content->file->path;
        $media = $content->media;

        if ($content->image) {
            $content = $content->toArray();
            $content['image'] = $image;
            $content['file'] = $file;
        }
        return response()->json($content, 200);
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
    public function showCatContent(Request $request) {

        $user = Auth::user();
        $user = User::where('phone', '09393212551')->first();
//        return $user->birth;
        $catID = $request->cat;
        $num = $request->num;


        $cat = \App\Catagory::where('id', $catID)->first();
        if ($cat) {
            $catName = $cat->name;
        } else {
            $catName = "سایر";
        }

        if ($num) {
            $contents = Content::where('catagory_id', $catID)
                    ->take($num)
                    ->get();
            $contents = $this->addImageUrls($contents);
        } else {
            // $contents = $this->ageFilter($user, $catID);
            $contents = Content::where('catagory_id', $catID)
                    ->get();
            $contents = $this->addImageUrls($contents);
        }


        $d = [];
        $j = 0;
        if ($catID == -1) {
//             $count = \App\Catagory::where('id', $catID)->first();

            for ($k = 1; $k < 6; $k++) {
                $cat = \App\Catagory::where('id', $k)->first();
                if ($cat) {
                    $catName = $cat->name;
                } else {
                    $catName = "سایر";
                }
                $contents = Content::where('catagory_id', $k)
                        ->get();
                // $contents = $this->ageFilter($user, $k);

                $contents = $this->addImageUrls($contents);

                $d[$j] = ['contents' => $contents, 'catName' => $catName];
                $j++;
            }

            return response()->json(['cats' => $d], 200);
        }




        return response()->json(['contents' => $contents, 'catName' => $catName], 200);
    }

    
    public function showSearch(Request $request) {
        $user = Auth::user();

        $search = $request->s;

        $contents = Content::where('name', 'LIKE', $search . '%')
                ->orwhere('desc', 'LIKE', $search . '%')
                ->select('name')
                ->orderBy('dl_count', 'desc')
                ->take(10)
                ->get();

        return response()->json(['contents' => $contents], 200);
    }

    public function searchContent(Request $request) {

        $user = Auth::user();

        $search = $request->s;

        $contents = Content::where('name', 'LIKE', $search . '%')
                ->orwhere('desc', 'LIKE', $search . '%')
                ->get();

       $contents = $this->addImageUrls($contents);
        return response()->json(['contents' => $contents], 200);
    }

    public function getVersionAll(Request $request) {

        $user = Auth::user();

        $search = $request->s;

        $contents = Content::select('name', 'id', 'version')
                ->get();

        return response()->json(['contents' => $contents], 200);
    }

    public function ageFilter($user, $id) {
        $birth = $this->changeDate($user->birth);
        $age = Carbon::parse($birth)->age;

        $contents = Content::where('catagory_id', $id)->
                where('low_age', '<=', $age)->where('high_age', '>=', $age)
                ->get();
        return $contents;
    }
    
    public function filter(Request $request){
        
        $age = $request->age;
        $cat = $request->cat;
        
        if($age == null){ //cat
            $contents = Content::where('catagory_id', $cat)
                    ->get();        
        }
        
        else if($cat == null){ //age
            $contents = Content::where('high_age', $age)
                    ->get();

        }
        
        else{ //both
            $contents = Content::where('high_age', $age)
                    ->where('catagory_id', $cat)
                    ->get();
        }
        
        $contents = $this->addImageUrls($contents);
        return response()->json(['contents' => $contents], 200);
    }
    
    

    public function changeDate($date) {
        $f = explode("/", $date);
        $d = \Morilog\Jalali\CalendarUtils::toGregorian($f[0], $f[1], $f[2]);
        $f_date = $d[0] . '-' . $d[1] . '-' . $d[2];
        return $f_date;
    }
    
    public function addImageUrls($contents){
        $c = [];
        $i = 0;

        foreach ($contents as $content) {
            $image = $content->image->path;

            if ($content->image) {
                $content = $content->toArray();
                $content['image'] = $image;
                $c[$i] = $content;

                $i++;
            }
        }
        
        return $c;
        
    }

}
