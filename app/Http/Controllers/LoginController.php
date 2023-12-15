<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Hash;
use Session;
class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function forget_password(){
        return view('admin.forget_password');
    }
    public function pageError(){
        return view('page404');
    }
    public function checkLogin(Request $res)
    {
        Session::forget('user');
        $body= $res->all();
        $user = UserAdmin::where('email',$body['user'])
        ->where('role','>=',0)
        ->first();
        if($user){
            Session::put('user',$user);
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
    public function block_ips(Request $res)
    {
        dd($_SERVER['REMOTE_ADDR']);
    }
 
}
