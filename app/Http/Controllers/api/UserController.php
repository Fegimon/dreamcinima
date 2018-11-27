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
            return response()->json(['regstatus' => 'success','userdata' => $user], $this-> successStatus);
        } else {
            return response()->json(['regstatus' => 'failed','userdata' => ''], $this-> successStatus);

        }
    }else{
        return response()->json(['regstatus' => 'User Already Registered','userdata' => ''], $this-> successStatus);
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
   
    
    public function getmedia() 
    { 
        
        $mediavideo = DB::table('dream_media')->where('media_type','video')->where('status',1)->orderBy('showby_order', 'ASC')->get();
        $mediaaudio = DB::table('dream_media')->where('media_type','audio')->where('status',1)->orderBy('showby_order', 'ASC')->get();
        $mediatrailler = DB::table('dream_media')->where('media_type','trailler')->where('status',1)->orderBy('showby_order', 'ASC')->get();
        $medialatest = DB::table('dream_media')->where('media_type','latest')->where('status',1)->orderBy('showby_order', 'ASC')->get();


            return Response::json([
                'status' => 1,
                'mediavideo'   => $mediavideo,
                'mediaaudio'=> $mediaaudio,
                'mediatrailler'=> $mediatrailler,
                'medialatest'=>$medialatest,
            ], 200);
    }  
    public function getmediahome() 
    { 
        
        $mediavideo = DB::table('dream_media')->where('media_type','video')->where('showin_home',1)->orderBy('showby_order', 'ASC')->where('status',1)->get();
        $mediaaudio = DB::table('dream_media')->where('media_type','audio')->where('showin_home',1)->orderBy('showby_order', 'ASC')->where('status',1)->get();
        $mediatrailler = DB::table('dream_media')->where('media_type','trailler')->where('showin_home',1)->orderBy('showby_order', 'ASC')->where('status',1)->get();
        $medialatest = DB::table('dream_media')->where('media_type','latest')->where('status',1)->orderBy('showby_order', 'ASC')->get();


            return Response::json([
                'status' => 1,
                'mediavideo'   => $mediavideo,
                'mediaaudio'=> $mediaaudio,
                'mediatrailler'=> $mediatrailler,
                'medialatest'=>$medialatest,

            ], 200);
    } 
    
    public function getmediabyCategory(Request $request) 
    { 
        $id = $request->movie_id;

        $movie = DB::table('banners')->where('id',$id)->first();
        
        $mediavideo = DB::table('dream_media')->where('media_type','video')->where('movie_id',$id)->where('status',1)->orderBy('showby_order', 'ASC')->get();
        $mediaaudio = DB::table('dream_media')->where('media_type','audio')->where('movie_id',$id)->where('status',1)->orderBy('showby_order', 'ASC')->get();
        $mediatrailler = DB::table('dream_media')->where('media_type','trailler')->where('movie_id',$id)->where('status',1)->orderBy('showby_order', 'ASC')->get();
        $medialatest = DB::table('dream_media')->where('media_type','latest')->where('movie_id',$id)->where('status',1)->orderBy('showby_order', 'ASC')->get();


            return Response::json([
                'status' => 1,
                'movie'=>$movie,
                'mediavideo'   => $mediavideo,
                'mediaaudio'=> $mediaaudio,
                'mediatrailler'=> $mediatrailler,
                'medialatest'=>$medialatest,
            ], 200);
    }
	
	public function getappupdatenotify() 
    {    

            return Response::json([
                'appversion' => '0.1.4',
                'forcepdate'   => 1,
                'playstoreurl'=> 'https://play.google.com/store/apps/details?id=com.dreamcinemas.app',                
            ], 200);
    } 
	
	public function getsubplansdetails() 
    {    

            return Response::json([
                'plan1' => 99,
				'plan1text' => 'Monthly',
                'plan2'   => 297,
				'plan2text'   => '3 Month',
                'extracharges'=> 40,
				'extratext'=> 'Subscribe 3 Months get a Free Shirt. Rs.40 for courier charges will be added to your subscription payment',
                
            ], 200);
    }

    public function getmovies()
    {
        $movies = DB::table('banners')->where('status',1)->get();

        return Response::json([
           // 'status' => 1,
            'movies'=>$movies,
        ], 200);

    }
}