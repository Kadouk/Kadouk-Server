<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ContentController;
use Illuminate\Support\Facades\Response;
use App\Content;

class PublisherController extends Controller {

    //
    public function contentList(Request $request) {

        $publisher_id = $request->id;
        $num = $request->num;
        $user = \App\User::where('phone', $request->token)->first();

        if ($num == -1) {
            $contents = Content::where('publisher_id', $publisher_id)
                    ->get();
        } else {
            $contents = Content::where('publisher_id', $publisher_id)
                    ->take($num)
                    ->get();
        }
        $contents = ContentController::addImageUrls($contents, $user);

        return response()->json(['contents' => $contents], 200);
    }

}
