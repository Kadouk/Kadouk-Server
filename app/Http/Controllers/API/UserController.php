<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Token; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;

    
    /** 
     * Get phone number api 
     * POST /register/phone
     * 
     * @param  string  $phone  The phone number of a User
     * @return \Illuminate\Http\Response 
     */ 
    public function getPhone(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'phone' => 'required',          
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if(!User::byPhone($request->phone)){ 
            $input = $request->all(); 
            //$input['password'] = bcrypt($input['password']); 
           $user = User::create($input); 
            
        }
        $this->invite($request->phone);
            
        $success['status'] =  200;
        return response()->json($success, $this-> successStatus); 

        
    }
    
    
    /** 
    * login api 
    * 
    * @param  string  $phone  The phone number of a User
    * 
    * @return \Illumiate\Http\Response 
    */ 
    public function login($user){ 

        if($user->active === 1){ 
            
            Auth::login($user);
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json( $success, $this-> successStatus); 
        }
        else{ 
            return response()->json(['error'=>'Not Register'], $this-> successStatus); 
        }
    }
    
    
    /**
     * Prepare a log in token for the user.
     *
     * @return LoginToken
     */
    protected function getCode(Token $code)
    {
        return $code->user;
    }
    
    /**
     * Prepare a log in token for the user.
     *
     * @return \Illumiate\Http\Response 
     */
    public function postLogin(Request $request)
    {
        $phone = $request->phone;
        $token = $request->code;
        
        $code = Token::byCode($token);
        
        if($code){
            $user = $this->getCode($code);
            if($user && $user->phone == $phone){
                  return $this->login($user);  
                
            }
            else{
                return response()->json(['error'=>'Wrong Code'], $this-> successStatus); 
            }
        }
        else{
            return response()->json(['error'=>'Wrong Code'], $this-> successStatus); 
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
        $input['active'] = 1; 
        $user = User::byPhone($request->phone);
        User::find($user->id)->update($input);
        //$input['password'] = bcrypt($input['password']); 
        //$user = User::create($input); 
        $user = User::byPhone($request->phone);
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
    
    /**
     * Send a sign in invitation to the user.
     */
    public function invite($phone)
    {
        $this->createToken($phone);
    }

    /**
     * Prepare a log in token for the user.
     *
     * @return LoginToken
     */
    protected function createToken($phone)
    {
        $user = User::byPhone($phone);

        return Token::generateFor($user);
    }
    
    public function setPass(Request $request){
        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            'pass' => 'required', 

        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        $input = $request->all(); 
        $input['pass'] = bcrypt($input['pass']); 
        User::find($user->id)->update($input);
        //$user->update($input);

        $success['status'] =  200;
        return response()->json($user, $this-> successStatus); 
    }


}