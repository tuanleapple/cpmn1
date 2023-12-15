<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use DB;
use App\Models\UserAdmin;
use Session;
class LogController extends Controller
{
    public function index(){
        $user = Session::get('user');
        if($user){
            $log = DB::table('log')
            ->join('user_admin','log.user_id','=','user_admin.id')
            ->OrderBy('log.created_at','DESC')
            ->select('log.id','log.module','log.message','log.created_at','log.updated_at','user_admin.fullname')
            ->paginate(10);
            return View('admin.log',compact('log'));
        }
        else{
            return view('admin.login');
        }
       
    }
}
