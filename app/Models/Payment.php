<?php

namespace App\Models;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function savePayment($input) {  
       // dd($input);     
        $query = DB::table('paymentdetails');
        if ($input['id']) {
    
            $input['updated_at'] = Carbon::now()->toDateTimeString();
            $result = $query->where([['id', $input['id']]])->update($input);
            return $input['id'];
            
        } else {
        
            $input['created_at'] = Carbon::now()->toDateTimeString();
            $result = $query->insertGetId($input);
            return $result;
        }
   }
   public function saveUsergift($input) {  
    // dd($input);     
     $query = DB::table('user_gift');
     if ($input['id']) {
 
         $input['updated_at'] = Carbon::now()->toDateTimeString();
         $result = $query->where([['id', $input['id']]])->update($input);
         return $input['id'];
         
     } else {
     
         $input['created_at'] = Carbon::now()->toDateTimeString();
         $result = $query->insertGetId($input);
         return $result;
     }
}
}
