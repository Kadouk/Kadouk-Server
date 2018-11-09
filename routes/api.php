<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@Postlogin');
Route::post('get/phone', 'API\UserController@getPhone');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::post('/download/history/show', 'API\DownloadController@showHistory');
});

Route::get('/content/show/all', 'API\ContentController@show');

Route::post('/content/show/page', 'API\ContentController@showContent');

Route::post('/content/search', 'API\ContentController@searchContent');

Route::post('/content/show/cat', 'API\ContentController@showCatContent');




Route::post('get/version', 'API\DeviceController@getVersion');




Route::get('download/image/{publisher_id}/{content_type}/{content_id}/{filename}', function($publisher_id, $content_type, $content_id, $filename)
{
    // Check if file exists in app/storage/file folder
    //$file_path = public_path() .'/images/'. $filename;
    $file_path = storage_path('app/files/' . $publisher_id . '/' . $content_type . '/' . $content_id . '/' . $filename);
    if (file_exists($file_path))
    {
        // Send Download
        return Response()->file($file_path);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+');

Route::get('download/apk/{publisher_id}/{content_id}/{filename}', function($publisher_id, $content_id, $filename)
{
    // Check if file exists in app/storage/file folder
    //$file_path = public_path() .'/images/'. $filename;
     $file_path = storage_path('app/files/' . $publisher_id . '/' . $content_id . '/' . $filename);
    if (file_exists($file_path))
    {
        // Send Download
        return Response()->file($file_path);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+');

