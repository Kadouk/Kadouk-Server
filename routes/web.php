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
//use Zarinpal\Zarinpal;
use App\User;
use Illuminate\Http\Request;
use Zarinpal\Laravel\Facade\Zarinpal;
use Illuminate\Support\Facades\Auth; 
Route::get('/', function () {
    return view('welcome');
});

 Route::get('docs', function(){
    return View::make('docs.api.index');
 });
 
 Route::get('/test', 'API\ContentController@show');

  Route::get('bb', function(Request $request){
// $transaction = \App\Transaction::where('transaction_id',$request->get('Authority'))->first();
// 
//Zarinpal::verify('OK',$transaction->price,$request->Authority);
//
//echo $request['Authority'];
//$transaction->status = $request->Status;
//$transaction->save();
      
      try { 
   
   $gateway = \Gateway::verify();
   $trackingCode = $gateway->trackingCode();
   $refId = $gateway->refId();
   $cardNumber = $gateway->cardNumber();
   $transaction = \App\Transaction::where('transaction_id',$refId)->first();
   $transaction->status = 'OK';
   $transaction->save();
   

            
           $user_content = new \App\UserHasContent;
            $user_content->content_id = $transaction->content_id;
            $user_content->user_id = 6;
            $user_content->payed = 1;
            $user_content->save();
    // تراکنش با موفقیت سمت بانک تایید گردید
    // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

} catch (\Larabookir\Gateway\Exceptions\RetryException $e) {

    // تراکنش قبلا سمت بانک تاییده شده است و
    // کاربر احتمالا صفحه را مجددا رفرش کرده است
    // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم
    
    echo $e->getMessage() . "<br>";
    
    
} catch (\Exception $e) {
   
    // نمایش خطای بانک
    echo $e->getMessage();
    
}  

  });
 Route::get('aa', function(Request $request){
 
//$zarinpal = new Zarinpal('XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX');
//$zarinpal->enableSandbox(); // active sandbox mod for test env
//// $zarinpal->isZarinGate(); // active zarinGate mode
//$results = $zarinpal->request(
//    'http://127.0.0.1:8000/bb',          //required
//    1000,                                  //required
//    'testing',                             //required
//    'me@example.com',                      //optional
//    '09000000000',                         //optional
//    [                          //optional
//        "Wages" => [
//            "zp.1.1"=> [
//                "Amount"=> 120,
//                "Description"=> "part 1"
//            ],
//            "zp.2.5"=> [
//                "Amount"=> 60,
//                "Description"=> "part 2"
//            ]
//        ]
//    ]
//);
//echo json_encode($results);
//if (isset($results['Authority'])) {
//    file_put_contents('Authority', $results['Authority']);
//    $zarinpal->redirect();
//}
//it will redirect to zarinpal to do the transaction or fail and just echo the errors.
//$results['Authority'] must save somewhere to do the verification
//////////////
//$results = Zarinpal::request(
//    'http://127.0.0.1:8000/bb',          //required
//    1000,                                  //required
//    'testing',                             //required
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
//$transaction = new \App\Transaction;
//$transaction->transaction_id = $results['Authority'];
//$transaction->user_id = 6;
//$transaction->price = 1000;
//$transaction->save();
//
//// save $results['Authority'] for verifying step
//Zarinpal::redirect(); // redirect user to zarinpal
//
//// after that verify transaction by that $results['Authority']
//Zarinpal::verify('OK',1000,$results['Authority']);
     
//   //////////  
//     $user = Auth::user(); 
     $price = $request->get('price');
     $content_id = $request->get('content_id');
     
     if(\App\Content::find($content_id)->cost == $price){
     
        try {

           //$gateway = \Gateway::make(new \Zarinpal());
           $gateway = Gateway::make(new Larabookir\Gateway\Zarinpal\Zarinpal());
            $gateway->setCallback(url('/bb')); //You can also change the callback
           $gateway
                ->price($price)
                // setShipmentPrice(10) // optional - just for paypal
                // setProductName("My Product") // optional - just for paypal
                ->ready();

           $refId =  $gateway->refId(); // شماره ارجاع بانک
           $transID = $gateway->transactionId(); // شماره تراکنش
            $transaction = new \App\Transaction;
            $transaction->transaction_id = $refId;
            $transaction->user_id = 6;
            $transaction->price = $price;
            $transaction->content_id = $content_id;
            $transaction->save();
           //return $refId . '+++' . $transID;
          // در اینجا
          //  شماره تراکنش  بانک را با توجه به نوع ساختار دیتابیس تان 
          //  در جداول مورد نیاز و بسته به نیاز سیستم تان
          // ذخیره کنید .

           return $gateway->redirect();

        } catch (\Exception $e) {

                echo $e->getMessage();
        }
     }
//    $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';  //Required
//    $Amount = 1000; //Amount will be based on Toman  - Required
//    $Description = 'توضیحات تراکنش تستی';  // Required
//    $Email = 'UserEmail@Mail.Com'; // Optional
//    $Mobile = '09123456789'; // Optional
//    $CallbackURL = 'http://www.m0b.ir/verify.php';  // Required
//
//    // URL also can be ir.zarinpal.com or de.zarinpal.com
//    $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
//
//    $result = $client->PaymentRequest([
//        'MerchantID'     => $MerchantID,
//        'Amount'         => $Amount,
//        'Description'    => $Description,
//        'Email'          => $Email,
//        'Mobile'         => $Mobile,
//        'CallbackURL'    => $CallbackURL,
//    ]);
//
//    //Redirect to URL You can do it also by creating a form
//    if ($result->Status == 100) {
//        header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
//    } else {
//        echo'ERR: '.$result->Status;
//    }


//$user = User::find(6);
//$user->balance; // 0
//
//$user->deposit(100);
//$user->balance; // 100
//
//$user->withdraw(50);
//$user->balance; // 50
//
//$user->forceWithdraw(200);
//$user->balance; // -150
//$user = User::find(6);
//$user->deposit(100, 'deposit', ['stripe_source' => 'ch_BEV2Iih1yzbf4G3HNsfOQ07h', 'description' => 'Deposit of 100 credits from Stripe Payment']);
//$user->withdraw(10, 'withdraw', ['description' => 'Purchase of Item #1234']);
 });