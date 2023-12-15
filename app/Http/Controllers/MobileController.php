<?php

namespace App\Http\Controllers;
use DB;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Session;
class MobileController extends Controller
{
    public function getCart(Request $request)
    {
        return ('chay dc roi');
    }
    public function checkLogin(Request $res)
    {
        $body= $res->all();
        $user = UserAdmin::where('email',$body['user'])
        ->where('role','>=',3)
        ->first();
        if($user){
            if (Hash::check($body['password'], $user->password)) {
                $success = array('data' => '1');
                return $success;
            };
            $error = array('data' => '-1',);
            return $error;
        }else{
            $error = array('data' => '0',);
            return $error;
        }
     
    }
}
