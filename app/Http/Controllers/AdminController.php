<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Response;
use DB;
use Session;
use Redirect;
use App\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{

    public function __construct() {
        $this->admin = new Admin();
    }

    public function adduser(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'name' => isset($data['name']) ? $data['name'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'phone' => isset($data['phone']) ? $data['phone'] : '',
                'dob' => isset($data['dob']) ? $data['dob'] : '',
                'gender' => isset($data['gender']) ? $data['gender'] : '',
                'address' => isset($data['address']) ? $data['address'] : '',
                'subscription' => isset($data['subscription']) ? $data['subscription'] : '',
               
            ];
            //dd($input);
            $verifyuser = DB::table('users')->where('email',$input['email'])->where('phone',$input['phone'])->first();
            //dd($verifyuser);
            if(empty($verifyuser)){
                //dd($verifyuser);
            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subscription' => 'required',
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                // return Response::json([
                //             'status' => 0,
                //             'message' => $checkValid->errors()->all()
                //                 ], 400);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                // $userInput = array(
                //     'id' => $input['id'],
                //     'name' => $input['name'],
                //     'email' => $input['email'],
                //     'phone'=>$input['phone'],
                //     'dob' => $input['dob'],
                //     'gender' => $input['gender'],
                //     'address' => $input['address'],
                //     'subscription' => $input['subscription'],
                //     'status'=>1
                // );
                //$userid = $this->admin->saveUser($userInput);
                $userid = User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'dob' => $input['dob'],
                    'gender' => $input['gender'],
                    'address' => $input['address'],
                    'subscription' => $input['subscription'],
                    'status' => 1,
                    //'password' => 123456,
                ]);
               if ($userid) {
                   
                return redirect('admin/userlist');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('login')->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            $data = Session::flash('error', 'Already User Exists!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            // return Response::json([
            //             'status' => 0,
            //             'message' => "No data"
            // ]);
        }
       }
    }
    public function edituser(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'name' => isset($data['name']) ? $data['name'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'phone' => isset($data['phone']) ? $data['phone'] : '',
                'dob' => isset($data['dob']) ? $data['dob'] : '',
                'gender' => isset($data['gender']) ? $data['gender'] : '',
                'address' => isset($data['address']) ? $data['address'] : '',
                'subscription' => isset($data['subscription']) ? $data['subscription'] : '',
               
            ];
            //dd($input);
           
            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subscription' => 'required',
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                // return Response::json([
                //             'status' => 0,
                //             'message' => $checkValid->errors()->all()
                //                 ], 400);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'phone'=>$input['phone'],
                    'dob' => $input['dob'],
                    'gender' => $input['gender'],
                    'address' => $input['address'],
                    'subscription' => $input['subscription'],
                    'status'=>1
                );
                $userid = $this->admin->updateUser($userInput);
               if ($userid) {
                   
                return redirect('admin/userlist');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('login')->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }
    public function addcategory(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'category_name' => isset($data['category_name']) ? $data['category_name'] : '',
                'sub_category' => isset($data['sub_category']) ? $data['sub_category'] : '',
                'description' => isset($data['description']) ? $data['description'] : '',
                'category_image' => isset($data['category_image']) ? $data['category_image'] : '',
                'status' => isset($data['status']) ? $data['status'] : '',
            
               
            ];
            //dd($input);
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image')->getClientOriginalExtension();
                $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
                $imageName = 'Category' . '-' . $rand . '.' . $image;
                //print_r($imageName);die;
        
                $imagePath = $request->file('category_image')->move(public_path() . '/upload/category', $imageName);
                //print_r($imagePath);die;
                $img = Image::make($imagePath->getRealPath());
        
                
            }

            else{
                $imageName= '';
            } 
            $rules = array(
                'category_name' => 'required',
                'sub_category' => 'required',
              
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                // return Response::json([
                //             'status' => 0,
                //             'message' => $checkValid->errors()->all()
                //                 ], 400);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
                if($imageName!=''){
                $dataInput = array(
                    'id' => $input['id'],
                    'category_name' => $input['category_name'],
                    'sub_category' => $input['sub_category'],
                    'description'=>$input['description'],
                    'category_image'=>$imageName,
                    'status'=>1
                );
            }else{
                $dataInput = array(
                    'id' => $input['id'],
                    'category_name' => $input['category_name'],
                    'sub_category' => $input['sub_category'],
                    'description'=>$input['description'],
                    //'category_image'=>$imageName,
                    'status'=>1
                );
            }
                $userid = $this->admin->saveCategory($dataInput);
              
               if ($userid) {
                   
                return redirect('admin/categorylist');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('login')->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }

    public function addbannercategory(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'name' => isset($data['name']) ? $data['name'] : '',
               
            
               
            ];
            //dd($input);
           
            $rules = array(
                'name' => 'required',
    
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                // return Response::json([
                //             'status' => 0,
                //             'message' => $checkValid->errors()->all()
                //                 ], 400);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
              
                $dataInput = array(
                    'id' => $input['id'],
                    'name' => $input['name'],
                    'status'=>1
                );
                //dd($dataInput);
                $bannerid = $this->admin->savebannerCategory($dataInput);
              
               if ($bannerid) {
                   
                return redirect('admin/bannercategory');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('login')->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }

    public function editbanner($id)
    {
        header('Access-Control-Allow-Origin: *');
       
        $banner = DB::table('banner-category')->where('id',$id)->first();

        if ($banner) {
            return Response::json([
                'status' => 1,
                'data'   => $banner,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'Banner not found',
            ], 400);
        }
    }
    public function deletbanner($id)
    {
        //dd($id);
        $category = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecategory=DB::table('banner-category')->where('id', $id)->update($category);

        if($updatecategory){
            return redirect('admin/bannercategory ');
        }
        else{
            return redirect('admin/bannercategory');
        }
    }
    public function addvideo(Request $request)
    {
        $data=$request->all();
        // dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'title' => isset($data['title']) ? $data['title'] : '',
                'video_description' => isset($data['video_description']) ? $data['video_description'] : '',
                'thumb_image' => isset($data['thumb_image']) ? $data['thumb_image'] : '',
                'cast_name' => isset($data['cast_name']) ? $data['cast_name'] : '',
                'director_name' => isset($data['director_name']) ? $data['director_name'] : '',
                'musicdirector' => isset($data['musicdirector']) ? $data['musicdirector'] : '',
                'producer' => isset($data['producer']) ? $data['producer'] : '',
               
            ];

            if ($request->hasFile('thumb_image')) {
                $image = $request->file('thumb_image')->getClientOriginalExtension();
                $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
                $thumbimage = 'image' . '-' . $rand . '.' . $image;
                //print_r($thumbimage);die;
        
                $imagePath = $request->file('thumb_image')->move(public_path() . '/upload/gallery/original', $thumbimage);
                //print_r($imagePath);die;
                $img = Image::make($imagePath->getRealPath());
                $thumbnail = $img->resize(200, 200)->save(public_path() . '/upload/gallery/thumbnail/' . $thumbimage);

        
                
            }

            else{
                $thumbimage= '';
            } 

            $rules = array(
                'title' => 'required',
               'video_description'=> 'required',
               
                
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                //dd('sds');
                // return Response::json([
                //             'status' => 0,
                //             'message' => $checkValid->errors()->all()
                //                 ], 400);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
               if($thumbimage!=''){
                $dataInput = array( 
                    'id'=>$input['id'],
                    'title' => $input['title'],
                    'video_description' => $input['video_description'],
                    'thumb_image'=>$thumbimage,
                    'cast_name' => $input['cast_name'],
                    'director_name' => $input['director_name'],
                    'musicdirector' => $input['musicdirector'],
                    'producer' => $input['producer'],
                    'status' => 1,
                    
                );
            }else{
                $dataInput = array( 
                    'id'=>$input['id'],
                    'title' => $input['title'],
                    'video_description' => $input['video_description'],
                    //'thumb_image'=>$thumbimage,
                    'cast_name' => $input['cast_name'],
                    'director_name' => $input['director_name'],
                    'musicdirector' => $input['musicdirector'],
                    'producer' => $input['producer'],
                    'status' => 1,
                    
                );
            }
                //dd($dataInput);
                $userid = $this->admin->saveVideo($dataInput);
               if ($userid) {
                   
                return redirect('admin/videolist');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('login')->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }

    public function addbanners(Request $request)
    {
        $data=$request->all();
      
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'title' => isset($data['title']) ? $data['title'] : '',
                'category' => isset($data['category']) ? $data['category'] : '',
                'image' => isset($data['image']) ? $data['image'] : '',
                'status' => isset($data['status']) ? $data['status'] : '',
            
               
            ];
            //dd($input);
            if ($request->hasFile('image')) {
                $image = $request->file('image')->getClientOriginalExtension();
                $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
                $imageName = 'image' . '-' . $rand . '.' . $image;
                //print_r($imageName);die;
        
                $imagePath = $request->file('image')->move(public_path() . '/upload/banner', $imageName);
                //print_r($imagePath);die;
                $img = Image::make($imagePath->getRealPath());
        
                
            }

            else{
                $imageName= '';
            } 
            $rules = array(
                'title' => 'required',
                'category' => 'required',
              
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                // return Response::json([
                //             'status' => 0,
                //             'message' => $checkValid->errors()->all()
                //                 ], 400);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
                if($imageName!=''){
                $dataInput = array(
                    'id' => $input['id'],
                    'title' => $input['title'],
                    'category' => $input['category'],
                    'image'=>$imageName,
                    'status'=>1
                );
            }else{
                $dataInput = array(
                    'id' => $input['id'],
                    'title' => $input['title'],
                    'category' => $input['category'],
                   // 'image'=>$imageName,
                    'status'=>1
                );
            }
                $bannerid = $this->admin->savebanner($dataInput);
               if ($bannerid) {
                   
                return redirect('admin/banners');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('banners')->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }
    public function banneredit($id)
    {
        header('Access-Control-Allow-Origin: *');
       
        $banner = DB::table('banners')->where('id',$id)->first();

        if ($banner) {
            return Response::json([
                'status' => 1,
                'data'   => $banner,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'Banner not found',
            ], 400);
        }
    }
    public function bannerdelete($id)
    {
        $category = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecategory=DB::table('banners')->where('id', $id)->update($category);

        if($updatecategory){
            return redirect('admin/banners ');
        }
        else{
            return redirect('admin/banners');
        }
    }

    public function addimage(Request $request)
    {
        $data=$request->all();
       //dd($data);
        $input = [
            'id' => isset($data['id']) ? $data['id'] : false,
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : '',
            'gallery' => isset($data['gallery']) ? $data['gallery'] : '', 
        ];
      
        // if ($request->hasFile('thumb_image')) {
        //     $image = $request->file('thumb_image')->getClientOriginalExtension();
        //     $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
        //     $imageName = 'image' . '-' . $rand . '.' . $image;
        //     $imagePath = $request->file('thumb_image')->move(public_path() . '/upload/videos', $imageName);
        //     $img = Image::make($imagePath->getRealPath()); 
        // }
        // else{
        //     $imageName= '';
        // } 
        $images=array();
        if($files=$request->file('gallery')){
            foreach($files as $file){
                $name=$file->getClientOriginalExtension();
                $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
                $image = 'gallery' . '-' . $rand . '.' . $name;
                $file->move(public_path() . '/upload/gallery', $image);
                $images[]=$image;
            }
        }
                $dataInput = array(
                    'id' => $input['id'],
                    'parent_id' => $input['parent_id'],
                    'gallery' => implode(",",$images),
                    'status'=>1
                );
                $bannerid = $this->admin->savegallery($dataInput);
               if ($bannerid) {
                   return Response::json([
                                'status' => 1,
                                'message' => 'Successfully Added'
                                    ], 200);
                     //return redirect('admin/videolist');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('banners')->with(['data', $data], ['warning', $data]);
                }
            }

    public function videoadd(Request $request)
    {
        $data=$request->all();
       //dd($data);
        $input = [
            'id' => isset($data['id']) ? $data['id'] : false,
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : '',
            'video_url' => isset($data['video_url']) ? $data['video_url'] : '',
            'video' => isset($data['video']) ? $data['video'] : '', 
        ];
      
        if(!empty($input['video']))
        {
             if($request->ajax('video'))
             {
            $file = $request->file('video');
            //dd($file);
            $filename = $request->file('video')->getClientOriginalExtension();
            //dd($filename);
            $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
            $video = 'Video' . '-' . $rand . '.' . $filename;
            $videoPath =$request->file('video')->move(public_path() . '/upload/videos', $video);
            } 
        }
        if(!empty($input['video_url'])){
            $video=$input['video_url'];

        }
           
                $dataInput = array(
                    'id' => $input['id'],
                    'parent_id' => $input['parent_id'],
                    'video' => $video,
                    'status'=>1
                );
          
                //dd($dataInput);
                $bannerid = $this->admin->addvideo($dataInput);
               if ($bannerid) {
                   return Response::json([
                                'status' => 1,
                                'message' => 'Successfully Added'
                                    ], 200);
                     //return redirect('admin/videolist');
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('banners')->with(['data', $data], ['warning', $data]);
                }
            }

            public function uploadgallery(Request $request)
            {
                $parentid=$request->segment(3);
                $data=$request->all();
            //dd($data);
                $input = [
                    'id' => isset($data['id']) ? $data['id'] : false,
                ];
                if(isset($_FILES['file']['name'][0])) 
                { 
                $images=array();
                foreach($_FILES['file']['name'] as $keys => $values) 
                { 
                $SourcePath = $_FILES['file']['tmp_name'][$keys]; 
                $img=$_FILES['file']['type'][$keys];
                $ext = strtolower(substr(strrchr($values, '.'), 1));
                //dd($ext);
                $rand=substr(number_format(time() * rand(), 0, '', ''), 0, 4);
                $name = 'image' . '-' . $rand . '.' . $ext;
                //dd($name);
                $TargetPath = public_path().'/upload/gallery/' . $name; 
                $imagepath=move_uploaded_file($SourcePath, $TargetPath); 
                $images[]=$name;
                } 
                //dd($images);
                }
                $dataInput = array(
                    'id' => $input['id'],
                    'parent_id' => $parentid,
                    'gallery' => implode(",",$images),
                    'status'=>1
                );
                //dd($dataInput);
                $bannerid = $this->admin->savegallery($dataInput);
               if ($bannerid) {
                   return Response::json([
                                'status' => 1,
                                'message' => 'Successfully Added'
                                    ], 200);
                } else {
                    // return Response::json([
                    //             'status' => 0,
                    //             'message' => 'Please provide valid details'
                    //                 ], 400);
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return redirect('videolist')->with(['data', $data], ['warning', $data]);
                 }
                } 
               
 }

    
