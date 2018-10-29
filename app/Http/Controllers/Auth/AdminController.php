<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Auth;
use Input;
Use Redirect;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function _construct(){
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

   
 public function login()
        {
           // dd('1');

        $rules = array(
            'email'    => 'required|email', 
            'password' => 'required|alphaNum|min:3' 
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //dd('2');
            $data = Session::flash('error', 'Please Provide All Datas!');
            return Redirect::back()
            ->withInput()
            ->withErrors($data);
            // return Redirect::to('login')
            //     ->withErrors($validator) 
            //     ->withInput(Input::except('password')); 
        } else {
            //dd('3');
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );


            if (Auth::attempt($userdata)) {
              
                 return redirect('admin/dashboard');

            } else {        
                // dd('5');
                // return Redirect::to('login');
                $data = Session::flash('error', 'Username or Password is Incorrect!');
                return redirect('login')->with(['data', $data], ['error', $data]);

            }

        }
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
                'dob' => isset($data['dob']) ? $data['dob'] : '',
                'gender' => isset($data['gender']) ? $data['gender'] : '',
                'address' => isset($data['address']) ? $data['address'] : '',
                'subscription' => isset($data['subscription']) ? $data['subscription'] : '',
                'password'=>isset($data['password']) ? $data['password'] : '',
               
            ];
            //dd($input);
            $rules = array(
                'email'    => 'required|email', 
                'password' => 'required|alphaNum|min:3' 
            );
    
            $validator = Validator::make(Input::all(), $rules);
    
            if ($validator->fails()) {
                //dd('2');
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
                // return Redirect::to('login')
                //     ->withErrors($validator) 
                //     ->withInput(Input::except('password')); 
            } else {
                User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    // 'dob' => $input['dob'],
                    // 'gender' => $input['gender'],
                    // 'address' => $input['address'],
                    // 'subscription' => $input['subscription'],
                    'status' => 1,
                   
                    'password' => Hash::make($data['password']),
                ]);
                return redirect('login');
            }
        }
    }
}
