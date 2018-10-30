<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller 
{
public $successStatus = 200;

        public function __construct() {
           // $this->register = new Register();
        }

    public function login(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        $data = $request->all();
        //dd($user);
        $user = DB::table('dream_user')->where('email',$data['email'])->first();
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
    public function register(Request $request) 
    { 
        //dd('user');
        $input = $request->all(); 

        $verifyUser = DB::table('dream_user')->where('email',$input['email'])->where('phone',$input['phone'])->first();
        if(empty($verifyUser))
        {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
           if ($validator->fails()) 
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $userrs = array(
            'name'=>$input['name'],
            'email'=>$input['email'],
            'phone'=>$input['phone'],
            'password'=>$input['password'],
            'subscribe_expiredate'=>Carbon::now()->toDateString(),
        );
        $user = DB::table('dream_user')->insertGetId($userrs); 
        //$success['token'] =  $user->createToken('MyApp')-> accessToken; 
        if ($user) {
            return response()->json(['status' => 'success','userdata' => $user], $this-> successStatus);
        } else {
            return response()->json(['status' => 'Data not found','userdata' => ''], $this-> successStatus);

        }
    }else{
        return response()->json(['status' => 'User Already Registered','userdata' => ''], $this-> successStatus);
    }
         
    }

    public function details() 
    { 
        $user = DB::table('dream_user')->get(); 
        //dd($user);
        return response()->json(['success' => $user], $this-> successStatus); 
    } 

    public function getcategory() 
    { 
        $category = DB::table('category')->get(); 
        //dd($user);
        return response()->json(['success' => $category], $this-> successStatus); 
    } 
    public function categorybyid(Request $request) 
    { 
        $id=$request->id;
        $category = DB::table('category')->where('id',$id)->first(); 
        if ($category) {
            return Response::json([
                'status' => 1,
                'data'   => $category,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'category not fount',
            ], 200);
        }
    } 
    public function getvideo() 
    { 
        $video = DB::table('video-details')->get(); 
        if ($video) {
            return Response::json([
                'status' => 1,
                'data'   => $video,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'video not fount',
            ], 200);
        }
    } 
    public function videobyid(Request $request) 
    { 
        $id=$request->id;
        $video = DB::table('video-details')->where('id',$id)->first(); 
        if ($video) {
            return Response::json([
                'status' => 1,
                'data'   => $video,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'video not fount',
            ], 200);
        }
    } 
    public function videobycategory(Request $request) 
    { 
        $category=$request->category;
        $video = DB::table('video-details')->where('category',$category)->first(); 
        if ($video) {
            return Response::json([
                'status' => 1,
                'data'   => $video,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'video not fount',
            ], 200);
        }
    }
    public function categorybyparent(Request $request) 
    { 
        $category=$request->category;
        $category = DB::table('category')->where('sub_category',$category)->get(); 
        if ($category) {
            return Response::json([
                'status' => 1,
                'data'   => $category,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'category not fount',
            ], 200);
        }
    }  

    
}