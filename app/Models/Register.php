<?php

namespace App\Models;
use Carbon\Carbon;
use DB;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    public function saveUser($input) {        
        $query = DB::table('users');
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