<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\Payment;
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Response;
use Carbon\Carbon;
class PaymentController extends Controller
{
    public function __construct() {
        $this->payment = new Payment();
    }
    public function paymentdetails(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'user_id' => isset($data['user_id']) ? $data['user_id'] : '',
                'payment_amount' => isset($data['payment_amount']) ? $data['payment_amount'] : '',
                'payment_method' => isset($data['payment_method']) ? $data['payment_method'] : '',
                'transaction_id' => isset($data['transaction_id']) ? $data['transaction_id'] : '',
                'payment_date' => isset($data['payment_date']) ? $data['payment_date'] : '',
                'payment_time' => isset($data['payment_time']) ? $data['payment_time'] : '',
                'payment_status' => isset($data['payment_status']) ? $data['payment_status'] : '',
            
                
            ];
            $verifyUser = DB::table('users')->where('id',$input['user_id'])->first();
            if(!empty($verifyUser))
            {

            $rules = array(
                'user_id' => 'required',
                'payment_amount' => 'required',
                'transaction_id' => 'required',
             
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                return Response::json([
                            'status' => 0,
                            'message' => $checkValid->errors()->all()
                                ], 400);
            } else { 
               
                $paymentInput = array(
                    'id' => $input['id'],
                    'user_id' => $input['user_id'],
                    'payment_amount' => $input['payment_amount'],
                    'payment_method'=> $input['payment_method'],
                    'transaction_id'=>$input['transaction_id'],
                    'payment_date' => $input['payment_date'],
                    'payment_time' => $input['payment_time'],
                    'payment_status' => $input['payment_status'],
                    'status'=>1,
                   
                );
               //dd($paymentInput);
                $paymentid = $this->payment->savePayment($paymentInput);
                $verifyStatus = DB::table('paymentdetails')->where('id',$paymentid)->first();
                $getUser=DB::table('users')->where('id',$input['user_id'])->first();
                $paymentstatus=$verifyStatus->payment_status;
                    if($paymentstatus=='success')
                    {
                        $status = array(
                            'subscription' =>1,
                            'subscribe_expiredate'=>Carbon::now()->addMonths(1),
                        );
                        $updatestatus = DB::table('users')->where('id',$input['user_id'])->update($status);
                        $history = array(
                            'user_id'=>$input['user_id'],
                            'subscribe_date'=>Carbon::now()->toDateString(),
                        );
                         $addhistory=DB::table('subscribe_history')->insertGetId($history);
                         $logs = array(
                            'user_id'=>$input['user_id'],
                        );
                         $paymentlogs=DB::table('payment_logs')->insertGetId($logs);
                        if ($paymentlogs) {
                   
                            return Response::json([
                                'status' => 1,
                                'user_id' => $input['user_id'],
                                    ], 200);
                            } else {
                                return Response::json([
                                            'status' => 0,
                                            'message' => 'Please provide valid details'
                                                ], 400);
                            }
                    }
               
               if ($paymentid) {
                   
                return Response::json([
                    'status' => 1,
                    'payment_id' => $paymentid
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
                        'message' => "No User data"
            ]);
        }
     }
     
    }
    public function getpaymentdetails(Request $request) 
    { 
        $id=$request->id;
        $paymentdetails = DB::table('paymentdetails')->where('id',$id)->first(); 
        if ($paymentdetails) {
            return Response::json([
                'status' => 1,
                'data'   => $paymentdetails,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'paymentdetails   not fount',
            ], 400);
        }
    }

    public function usergift(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'user_id' => isset($data['user_id']) ? $data['user_id'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'transaction_id' => isset($data['transaction_id']) ? $data['transaction_id'] : '',
                'address' => isset($data['address']) ? $data['address'] : '',
                'user_preference' => isset($data['user_preference']) ? $data['user_preference'] : '',
                'delivery_status' => isset($data['delivery_status']) ? $data['delivery_status'] : '',
                'delivery_comments' => isset($data['delivery_comments']) ? $data['delivery_comments'] : '',
                'shipping_info' => isset($data['shipping_info']) ? $data['shipping_info'] : '',
            
                
            ];
           
           

            $rules = array(
                'user_id' => 'required',
                'email' => 'required',
                'transaction_id' => 'required',
                // 'paymentapplied' => 'required',
                // 'datarecived' => 'required',
                // 'amount' => 'required',
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                return Response::json([
                            'status' => 0,
                            'message' => $checkValid->errors()->all()
                                ], 400);
            } else { 
               
                $paymentInput = array(
                    'id' => $input['id'],
                    'user_id' => $input['user_id'],
                    'email' => $input['email'],
                    'address' => $input['address'],
                    'transaction_id'=>$input['transaction_id'],
                    'user_preference' => $input['user_preference'],
                    'delivery_status' => $input['delivery_status'],
                    'delivery_comments' => $input['delivery_comments'],
                    'shipping_info' => $input['shipping_info'],
                    'status'=>1,
                   
                );
               //dd($paymentInput);
                $paymentid = $this->payment->saveUsergift($paymentInput);
                //dd($paymentid);
               if ($paymentid) {
                   
                return Response::json([
                    'status' => 1,
                    'payment_id' => $paymentid
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
                        'message' => "No data"
            ]);
        }
     
    }
    public function getusergift(Request $request) 
    { 
        $id=$request->id;
        $usergift = DB::table('user_gift')->where('id',$id)->first(); 
        if ($usergift) {
            return Response::json([
                'status' => 1,
                'data'   => $usergift,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'usergift   not fount',
            ], 400);
        }
    }
}
