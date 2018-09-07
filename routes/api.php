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
});




Route::middleware('auth:api')->get('download/image/{filename}', function($filename)
{
    // Check if file exists in app/storage/file folder
    //$file_path = public_path() .'/images/'. $filename;
    $file_path = storage_path('app/images/contents/' . $filename);
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

