<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin.pages.login');
    }
    public function dashboard()
    {
        $usercount = DB::table('dream_user')->where('status',1)->count();
        $categorycount = DB::table('category')->where('status',1)->count();
        $bannerscount = DB::table('banners')->where('status',1)->count();



        return view('admin.pages.dashboard')->with('usercount',$usercount)->with('categorycount',$categorycount)
        ->with('bannerscount',$bannerscount);
    }
    public function adduser()
    {
        return view('admin.pages.adduser');
    }
    public function userlist()
    {
        $userrs = DB::table('dream_user')->where('status',1)->get();
        return view('admin.pages.userlist')->with('userrs',$userrs);
    }
    public function edituser($id)
    {
        $userrs = DB::table('dream_user')->where('id',$id)->first();
        return view('admin.pages.edituser')->with('userrs',$userrs);
    }

    public function addcategory()
    {
        $category = DB::table('category')->get();
          // dd($category);
        return view('admin.pages.addcategory')->with('category',$category);
    }
    public function categorylist()
    {
        $category = DB::table('category')->where('status',1)->get();
        return view('admin.pages.categorylist')->with('category',$category);
    }
    public function editcategory($id)
    {
        $category = DB::table('category')->where('id',$id)->first();
        $category_val = DB::table('category')
        //->join('category.sub_category','=','category.id')
        ->get();
        //dd($category_val);
        return view('admin.pages.editcategory')->with('category',$category)->with('category_val',$category_val);
    }
    public function deletecategory($id)
    {
        //dd($id);
        $category = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecategory=DB::table('category')->where('id', $id)->update($category);

        if($updatecategory){
            return redirect('admin/categorylist ');
        }
        else{
            return redirect('admin/categorylist');
        }
    }
    public function viewcategory($id)
    {
        //dd($id);
        $category = DB::table('category')->where('id',$id)->first();
        //dd($studentrs);
        return view('admin.pages.viewcategory')->with('category',$category);
    }
    public function deleteuser($id)
    {
        //dd($id);
        $category = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecategory=DB::table('users')->where('id', $id)->update($category);

        if($updatecategory){
            return redirect('admin/userlist ');
        }
        else{
            return redirect('admin/userlist');
        }
    }
    public function viewuser($id)
    {
        //dd($id);
        $userrs = DB::table('users')->where('id',$id)->first();
        //dd($studentrs);
        return view('admin.pages.viewuser')->with('userrs',$userrs);
    }
   
    public function bannercategory()
    {
        $bannerrs = DB::table('banner-category')->where('status',1)->get();
        return view('admin.pages.bannerscategory')->with('bannerrs',$bannerrs);
    }
    public function videolist()
    {
        $videors = DB::table('video-details')->where('status',1)->get();
        return view('admin.pages.videolist')->with('videors',$videors);
    }
    public function viewvideo($id)
    {
        $video = DB::table('video-details')->where('id',$id)->first();
        return view('admin.pages.viewvideo')->with('video',$video);
    }
    public function imagegallery($id)
    {
        return view('admin.pages.imagegallery');
    }
    public function banners()
    {
        $category = DB::table('banner-category')->get();
        $banners = DB::table('banners')->where('status',1)->get();

        return view('admin.pages.banners')->with('category',$category)->with('banners',$banners);
    }
    public function addvideo()
    {
        $category = DB::table('category')->get();

        return view('admin.pages.createvideo')->with('category',$category);
    }
    public function videoadd($id)
    {
        return view('admin.pages.videoadd');
    }
    public function videogallery($id)
    {
        $video = DB::table('videos')->where('video_id',$id)->where('status',1)->get();
         //dd($video);
        return view('admin.pages.videogallery')->with('video',$video);
    }
    public function editvideo($id)
    {
        $video = DB::table('video-details')->where('id',$id)->first();
        $category = DB::table('category')->get();
        //dd($video);
        return view('admin.pages.editvideo')->with('video',$video)->with('category',$category);
    }
    public function deletevideo($id)
    {
        //dd($id);
        $category = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecategory=DB::table('video-details')->where('id', $id)->update($category);

        if($updatecategory){
            return redirect('admin/videolist ');
        }
        else{
            return redirect('admin/videolist');
        }
    }
    public function gallerylist($id)
    {
        $images = DB::table('gallery')->where('video_id',$id)->where('status',1)->get();
        return view('admin.pages.gallerylist')->with('gallery',$images);
    }
    public function paymentdetails()
    {
        $paymentrs = DB::table('paymentdetails')
                ->select('paymentdetails.*','dream_user.name')
                ->join('dream_user','dream_user.id','=','paymentdetails.user_id')
                ->where('paymentdetails.status',1)
                ->get();
        //dd($paymentrs);
        return view('admin.pages.paymentdetailslist')->with('paymentrs',$paymentrs);
    }
    public function viewpayment($id)
    {
        $paymentrs = DB::table('paymentdetails')
                ->select('paymentdetails.*','dream_user.name')
                ->join('dream_user','dream_user.id','=','paymentdetails.user_id')
                ->first();
        return view('admin.pages.viewpayment')->with('paymentrs',$paymentrs);
    }
    public function deletpayment($id)
    {
        //dd($id);
        $payment = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatepayment=DB::table('paymentdetails')->where('id', $id)->update($payment);

        if($updatepayment){
            return redirect('admin/paymentdetails ');
        }
        else{
            return redirect('admin/paymentdetails');
        }
    }
    public function subscriptionlist()
    {
        $date = Carbon::now()->toDateString();
        
        $paymentrs = DB::table('subscribe_history')
                    ->select('subscribe_history.*','dream_user.name','dream_user.email','paymentdetails.payment_amount')
                    ->join('dream_user','dream_user.id','=','subscribe_history.user_id')
                    ->join('paymentdetails','paymentdetails.user_id','=','subscribe_history.user_id')
                    ->where('subscribe_history.subscribe_date','=',$date)
                    ->get();
        //dd($paymentrs);
        return view('admin.pages.subscriptionlist')->with('paymentrs',$paymentrs);
    }

    public function viewsubscription($id)
    {
        $paymentrs = DB::table('subscribe_history')
                    ->select('subscribe_history.*','dream_user.name','dream_user.email','paymentdetails.payment_amount')
                    ->join('dream_user','dream_user.id','=','subscribe_history.user_id')
                    ->join('paymentdetails','paymentdetails.user_id','=','subscribe_history.user_id')
                    ->where('subscribe_history.id','=',$id)
                    ->first();
        //dd($paymentrs);
        return view('admin.pages.viewsubscription')->with('paymentrs',$paymentrs);
    }

}
