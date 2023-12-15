<?php

namespace App\Http\Controllers;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;
use Session;
class UserController extends Controller
{
    public function index(Request $res)
    {
        $user = Session::get('user');
        if($user){
            $user = UserAdmin::paginate(10);
            return view('admin.user',compact('user'));
        }
        else{
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            return view('admin.login',compact('actual_link'));
        }
    
    }
    public function createUser(Request $res)
    {
        $body = $res->all();
        $user = new UserAdmin;
        $user->fullname = $body['username'];
        $user->password =Hash::make($body['password']);
        $user->email = $body['email'];
        $user->role = $body['role'];
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $moduleLog = 'create_user';
        $messageLog = 'create user '.$user->fullname;
        $log = Log::add($moduleLog, $messageLog, json_encode($user->fullname));
        if ($user->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function getUser($id)
    {
        $user = UserAdmin::find($id);
        if ($user->save()) {
            $success = array('data' => '1','user'=>$user);
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function editUser(Request $res)
    {
        $body = $res->all();
        $user = UserAdmin::find($body['id']);
        $user->fullname = $body['username'];
        $user->password =Hash::make($body['password']);
        $user->email = $body['email'];
        $user->role = $body['role'];
        // $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $moduleLog = 'edit_user';
        $messageLog = 'edit user '.$user->fullname;
        $log = Log::add($moduleLog, $messageLog, json_encode($user->fullname));
        if ($user->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function deleteUser(Request $request)
    {
        $id = $request->route('id');
        $user = UserAdmin::find($id);
        $moduleLog = 'delete_user';
        $messageLog = 'xoa mới user '.$user->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($user->fullname));
        if ($user->delete()) {
            $success = array('data' => '1');
            return $success;
        }
        $error = array('data' => '-1',);
        return $error;
    }
}
