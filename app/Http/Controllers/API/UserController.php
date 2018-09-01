<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
    /** 
    * login api 
    * 
    * @param  string  $phone  The phone number of a User
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function login(){ 
        if(Auth::attempt(['phone' => request('phone')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json( $success, $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
    
        
    /** 
     * Register api 
     * POST /register/
     * 
     * @param  string  $name  The name of a User
     * @param  string  $phone  The phone number of a User
     * @param  string  $gender The gender of a User
     * @param  string  $birth  The birth of a User
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required', 
            'gender' => 'required', 
            'birth' => 'required', 
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        //$input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json($success, $this-> successStatus); 
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() { 
        $user = Auth::user(); 
        return response()->json( $user, $this-> successStatus); 
    } 
}