<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cookie;
class Cookie_token extends Model
{
    protected $table = 'cookie_token';
    public $timestamps = false;
    public static function add($cookie_token,$user_id,$cart_id)
    {
        $cookie = new Cookie_token;
        $cookie->token_id = Str::random(15);
        if(!empty($user_id)){
            $cookie->user_id = $user_id;
        }
        if(!empty($product_id)){
            $cookie->cart_id = $cart_id;
        }
        $cookie->created_at = date('Y-m-d H:i:s');
        $cookie->updated_at = date('Y-m-d H:i:s');
        if($cookie->save()){
            return $cookie->token_id;
        }
        return false;
       
    }
}

