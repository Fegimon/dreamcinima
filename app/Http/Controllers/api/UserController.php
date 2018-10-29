<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Response;
class UserController extends Controller 
{
public $successStatus = 200;

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        { 
            $user = Auth::user(); 
            if ($user) {
                return Response::json([
                    'status' => 1,
                    'data'   => $user,
                ], 200);} else {
                return Response::json([
                    'status'  => 0,
                    'message' => 'user not fount',
                ], 400);
            }
            //return response()->json(['success' => $user], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request) 
    { 
        //dd('user');
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
        $user = User::create($input); 
        //$success['token'] =  $user->createToken('MyApp')-> accessToken; 
        if ($user) {
            return Response::json([
                'status' => 1,
                'data'   => $user,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'user not fount',
            ], 400);
        }
        // $success['name'] =  $user->name;
        // return response()->json(['success'=>$success], $this-> successStatus); 
    }

    public function details() 
    { 
        $user = DB::table('users')->get(); 
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
            ], 400);
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
            ], 400);
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
            ], 400);
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
            ], 400);
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
            ], 400);
        }
    }  

    
}