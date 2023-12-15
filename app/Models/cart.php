<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'cart';
    public $timestamps = false;
    public static function add($product_id,$size,$quality,$price,$cookie_token)
    {
      
        $cart = new cart;
        $cart->product_id = $product_id;
        $cart->size = $size;
        $cart->quality = $quality;
        $cart->price = $price;
        $cart->payment = 0;
        $cart->cookie_token = $cookie_token;
        $cart->created_at = date('Y-m-d H:i:s');
        $cart->updated_at = date('Y-m-d H:i:s');
        if ($cart->save()) {
            return $cart;
        }
        $error = array('data' => '-1',);
        return $error;

       
    }
}
