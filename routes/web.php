<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Zarinpal\Laravel\Facade\Zarinpal;
use App\User;
Route::get('/', function () {
    return view('welcome');
});

 Route::get('docs', function(){
    return View::make('docs.api.index');
 });
 
 Route::get('/test', 'API\ContentController@show');

 Route::get('aa', function(){
 $user = User::find(6);
$user->balance; // 0

$user->deposit(100);
$user->balance; // 100

$user->withdraw(50);
$user->balance; // 50

$user->forceWithdraw(200);
$user->balance; // -150
//$results = Zarinpal::request(
//    "example.com/testVerify.php",          1000,           'testing',                             //required
//    'me@example.com',                      //optional
//    '09000000000',                         //optional
//    [                          //optional
//        "Wages" => [
//            "zp.1.1" => [
//                "Amount" => 120,
//                "Description" => "part 1"
//            ],
//            "zp.2.5" => [
//                "Amount" => 60,
//                "Description" => "part 2"
//            ]
//        ]
//    ]
//);
//Zarinpal::redirect(); // redirect user to zarinpal
//// after that verify transaction by that $results['Authority']
//Zarinpal::verify('OK',1000,$results['Authority']);
 });