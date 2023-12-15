<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    public $timestamps = false;
    public static function add($module,$message, $data)
    {
        $sesion = Session::get('user');
        $newLog = new self();
        $newLog->user_id =  $sesion->id;
        $newLog->module = $module;
        $newLog->message = $message;
        $newLog->data = $data;
        $newLog->created_at = date('Y-m-d H:i:s');
        $newLog->updated_at = date('Y-m-d H:i:s');
        $newLog->save();
        return $newLog;
    }
}
