<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\Register;
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Response;

class MainController extends Controller 
{
    public function __construct() {
        $this->register = new Register();
    }

    public function userregister(Request $request) 
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
                $verifyUser = DB::table('dream_user')->where('email',$input['email'])->where('phone',$input['phone'])->first();
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
                    $userrs = DB::table('dream_user')->where('id',$userid)->first();
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
                                ], 400);    
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
        $user = DB::table('dream_user')->where('email',$data['email'])->where('password',bcrypt($data['password']))->first();     
        //dd($user);
        if ($user== "") {
            return Response::json([
                        'status' => 0,
                        'message' => 'Please Provide Valid Details',
                            ], 400);
        } else {
            return Response::json([
                        'status' => 1,
                        'uid'=>$user->id,
                        'name'=>$user->name,
                        //'role_id'   => $user->role_id
                            ], 200);
        }
    }
}