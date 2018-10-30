<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\Register;
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Response;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller 
{
    public $successStatus = 200;

    public function __construct() {
        $this->register = new Register();
    }

    public function register(Request $request) 
    { 
         $data=$request->all();
                //dd($data);
            if ($data != null) {

                $input = [
                    'id' => isset($data['id']) ? $data['id'] : false,
                    'name' => isset($data['name']) ? $data['name'] : '',
                    'email' => isset($data['email']) ? $data['email'] : '',
                    'phone' => isset($data['phone']) ? $data['phone'] : '',
                    'password' => isset($data['password']) ? $data['password'] : '',
                    'c_password' => isset($data['c_password']) ? $data['c_password'] : '',
                    
                ];
                //dd($input);
                $verifyUser = DB::table('users')->where('email',$input['email'])->where('phone',$input['phone'])->first();
               if(empty($verifyUser))
               {
                $rules = array(
                    'name' => 'required', 
                    'email' => 'required|email', 
                    'phone' => 'required', 
                    'password' => 'required', 
                    'c_password' => 'required|same:password',
                    
                );
                $checkValid = Validator::make($input, $rules);
                if ($checkValid->fails()) {
                    return Response::json([
                                'status' => 0,
                                'message' => $checkValid->errors()->all()
                                    ], 400);
                } else { 
                    
                    $userInput = array(
                        'id' => $input['id'],
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'phone'=>$input['phone'],
                        'password' => bcrypt($input['password']),
                        'status'=>1
                    );
                    $userid = $this->register->saveUser($userInput);
                    $userrs = DB::table('users')->where('id',$userid)->first();
                    if ($userrs) { 
                        return Response::json([
                            'status' => 1,
                            'userid'   => $userrs->id,
                            'name' =>$userrs->name,
                            ], 200);
                    } else {
                        return Response::json([
                            'status' => 0,
                            'message' => 'Please provide valid details'
                                ], 200);    
                    }
                 }
                } else {
                return Response::json([
                            'status' => 0,
                            'message' => "User Already Registered."
                ]);
            }
        } 
    }
    public function login(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        $data = $request->all();
        //dd($user);
        $user = DB::table('users')->where('email',$data['email'])->first();
        if(!empty($user))
        { 
            if ($user && Hash::check($data['password'], $user->password)) 
            {
                return response()->json(['loggedstatus' => 'success','userdata' => $user], $this-> successStatus); 
            }else{
                return response()->json(['loggedstatus' => 'invalid','userdata' => ''], $this-> successStatus); 
            }
        }else{
            return response()->json(['loggedstatus' => 'User Not Registered','userdata' => ''], $this-> successStatus);
        }
        
    }
}