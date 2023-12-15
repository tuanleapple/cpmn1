<?php

namespace App\Http\Controllers;
use App\Models\Collection;
use App\Models\collectionProduct;
use App\Http\Controllers\BillController;
use App\Models\product;
use App\Models\cart;
use App\Models\other;
use App\Models\city;
use App\Models\address;
use App\Models\district;
use App\Models\ward;
use App\Models\Variant;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Cookie_token;
use App\Models\customer;
use App\Models\Print_history;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Cookie\CookieJar;
use Illuminate\Contracts\Cookie\Factory;
use Illuminate\Support\Facades\Hash;
use Google_Client;
use Google_Service_PeopleService;
use DB;
class HomeController extends Controller
{
    protected static $user_id = null;
    public static function getCart($request)
    {
        $cart = cart::where('cookie_token',$request)
        ->where('cart.payment','<',1)
        ->join('product','product.id','=','cart.product_id')
        ->OrderBy('cart.created_at','DESC')
        ->select('cart.id','cart.payment','cart.product_id','product.image','product.slug','product.price','cart.quality','cart.size','product.title')
        ->get()->toArray();
        if($cart){
            return $cart;
        }
    }
    public function index(Request $request,Factory $cookie)
    { 
        if(empty($request->cookie('key_post'))){
            $cookie2 = Cookie_token::add('','','');
            $cookie->queue(cookie()->make('key_post', $cookie2, 2628000));
        }
        $type = 'ALL COLLECTION';
        $user = Cookie_token::where('token_id', $request->cookie('key_post'))->first();
        if ($user) {
            $admin = Admin::where('user_id', $user->user_id)->first();
            if ($admin->id_admin === 1) {
                $collection = Print_history::get()->toArray();
            } else {
                $collection = Print_history::where('user_id', $user->user_id)->get()->toArray();
            }
        }
        $collection = Print_history::get()->toArray();
        return view('main',compact('collection'));
    }
    public function seacherOther(Request $request)
    {
        $body = $request->all();
        $productSeacher = product::where('title','LIKE',"%".$request->search."%")
        ->select('product.title','product.price','product.slug','product.image')->orderBy('created_at', 'DESC')
        ->get();
        if($productSeacher){
            $success = array('data' => '1','productSeacher'=>$productSeacher);
            return $success;
        }else{
            $error = array('data' => '-1',);
            return $error;
        }
    }
    public function checkLinhProduct(Request $request, Factory $cookie)
    {
        if(empty($request->cookie('key_post'))){
            $cookie2 = Cookie_token::add('','','');
            $cookie->queue(cookie()->make('key_post', $cookie2, 2628000));
        }
        $variant ='';
        $type = 'ALL COLLECTION';
        $cart = $this->getCart($request->cookie('key_post'));
        $collection = Collection::get()->toArray();
        $body = $request->route('title');
        $product = product::where('slug',$body)->first();
        $variant = DB::table('variant as v')->where('product_id',$product['id'])->join('attribute as a','a.id','v.attribute_id')
        ->select('v.id','v.product_id','a.title','v.quality')
        ->get()->toArray();
        $sum = Variant::where('product_id',$product['id'])
        ->select(DB::raw('sum(quality) as qualityProduct'))
        ->get()->toArray();
        $productRelated = product::where('collection_id', $product['collection_id'])->where('id','!=', $product['id'])->paginate(4);
        return view('product_info',compact('product','collection','variant','productRelated','cart','type','sum'));
    }

    public function login(Request $request)
    {
        if(empty($request->cookie('key_post'))){
            $cookie = Cookie_token::add('','','');
        }
        return view('login');
       
    }
    public function signUp(Request $request)
    {
        $type = 'Đăng Ký';
        $cart = $this->getCart($request->cookie('key_post'));
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $collection = Collection::get()->toArray();
        if(!empty($user[0]['user_id'])){
            $checkUser = customer::where('id',$user[0]['user_id'])->get()->toArray();
            $type = 'Thông Tin Cá Nhân';
            return view('user',compact('cart','type','collection','checkUser'));
        }else{
            return view('signup',compact('collection','type','cart'));
        }
    }

    public function addCartProduct(Request $request)
    {
        $body = $request->all();
        $cartCheck = cart::where('product_id',$body['id'])->where('size',$body['size'])->where('cookie_token',$request->cookie('key_post'))->get()->toArray();
        if(!empty($cartCheck)){
            $cartupdate = cart::find($cartCheck[0]['id']);
            $cartupdate->product_id = $cartCheck[0]['product_id'];
            $cartupdate->size = $cartCheck[0]['size'];
            $cartupdate->quality = $cartCheck[0]['quality']+ $body['quality'];
            $cartupdate->payment = 0;
            $cartupdate->cookie_token = $cartCheck[0]['cookie_token'];
            $cartupdate->updated_at = date('Y-m-d H:i:s');
            if ($cartupdate->save()){
                $cart = cart::find($cartupdate['id'])
                ->join('product','product.id','=','cart.product_id')
                ->OrderBy('cart.created_at','DESC')
                ->select('cart.id','product.image','product.slug','cart.price','cart.quality','cart.size','product.title')
                ->first();
                $success = array('data'=>'1','cart'=>$cart);
                return $success;
            }
            $error = array('data' => '-1',);
            return $error;
        }else{
            if($request->cookie('key_post')){
                $cart = cart::add($body['id'],$body['size'],$body['quality'],'',$request->cookie('key_post'));
                if ($cart->save()) {
                    $cartcheck = cart::find($cart['id'])
                    ->join('product','product.id','=','cart.product_id')
                    ->OrderBy('cart.created_at','DESC')
                    ->select('cart.id','product.image','product.slug','product.price','cart.quality','cart.size','product.title')
                    ->first();
                    $success = array('data'=>'1','cart'=>$cartcheck);
                    return $success;
                }
                $error = array('data' => '-1',);
                return $error;
            }
        }
        
    }

    //check sign up
    public function createUser(Request $request)
    {
        $body = $request->all();
        $user = new customer;
        $user->fullname = $body['fullname'];
        $user->password =Hash::make($body['password']);
        $user->email = $body['email'];
        $user->bri_day = $body['dob'];
        $user->tax = $body['tax'];
        $user->gender = $body['gender'];
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        if ($user->save()) {
            Cookie_token::where('token_id',$request->cookie('key_post'))->update(array('user_id'=> $user->id));
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
     //check Login
    public function checkLoginClient(Request $request)
    {
        $validated = $request->validate([
            'email'=>'required|email',
            'password' => 'required|min:2',
        ]);
        $body= $request->all();
        $user = customer::where('email',$body['email'])
        ->first();
        if (Hash::check($body['password'], $user->password)) {
            Cookie_token::where('token_id', $request->cookie('key_post'))->update(['user_id'=> $user->id]);
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function checkOut(Request $request)
    {
        $cart = $this->getCart($request->cookie('key_post'));
        $total = 0;
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        if(!empty($cart)){
            foreach($cart as $value){
                $total = $total + ($value['price'] * $value['quality']);
            }
        }
        if(!empty($cart)){
            $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
            if($user){
                $checkUser = customer::where('id',$user[0]['user_id'])->get()->toArray();
                $address = address::where('user_id',$user[0]['user_id'])->where('active',1)->get()->toArray();
                return view('checkout',compact('cart','total','checkUser','address'));
            }else{
                return view('checkout',compact('cart','total'));
            }
        }else{
            return view('cart');
        }
        
    }
    public function cart(Request $request)
    {
        $type = 'Giỏ Hàng';
        $cart = $this->getCart($request->cookie('key_post'));
        return view('cart',compact('cart','type'));
    }
    public function deleteCart(Request $request)
    {
        $body = $request->all();
        $cart = cart::find($body['cart']);
        if ($cart->delete()){
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function qualityPlus(Request $request)
    {
        $body = $request->all();
        cart::where('id',$request->route('id'))->update(array('quality'=> $body['quality']));
    }
    public function getCity()
    {
        $city = city::get()->toArray();
        if (!empty($city)){
            $success = array('data' => '1','city'=>$city);
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function getDistrict(Request $request)
    {
        $body = $request->route('id');
        $district = district::where('city_id',$body)->get()->toArray();
        if (!empty($district)){
            $success = array('data' => '1','district'=>$district);
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function getWard(Request $request)
    {
        $body = $request->route('id');
        $ward = ward::where('district_id',$body)->get()->toArray();
        if (!empty($ward)){
            $success = array('data' => '1','ward'=>$ward);
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function user(Request $request)
    {
        $cart = $this->getCart($request->cookie('key_post'));
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $collection = Collection::get()->toArray();
        if(!empty($user[0]['user_id'])){
            $checkUser = customer::where('id',$user[0]['user_id'])->get()->toArray();
            $type = 'Thông Tin Cá Nhân';
            return view('user',compact('cart','type','collection','checkUser'));
        }else{
            return view('login');
        }
    }
    public function avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name_image = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            if($image->move($destinationPath,$name_image)){
                $cookie =  Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
                if($cookie){
                    $user = customer::find($cookie[0]['user_id']);
                    $user->image = $name_image;
                    $user->save();
                }
                $success = array('data' => '1','name'=>$name_image);
                return $success;
             };
            $error = array('data' => '-1',);
            return $error;
        }
    }
    public function other(Request $request)
    {
        $cart = $this->getCart($request->cookie('key_post'));
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $collection = Collection::get()->toArray();
        if(!empty($user[0]['user_id'])){
            $checkUser = customer::where('id',$user[0]['user_id'])->get()->toArray();
            $other = other::where('customer_id','=',$checkUser[0]['id'])->get();
            $type = 'Thông Tin Cá Nhân';
            return view('other',compact('cart','type','collection','checkUser','other'));
        }else{
            return view('login');
        }
    }
    public function address(Request $request)
    {
        $cart = $this->getCart($request->cookie('key_post'));
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $collection = Collection::get()->toArray();
        if(!empty($user[0]['user_id'])){
            $checkUser = customer::where('id',$user[0]['user_id'])->get()->toArray();
            $customer = address::where('user_id',$user[0]['user_id'])
            ->join('city','city.id','=','address.city_id')
            ->join('district','district.id','=','address.district_id')
            ->join('ward','ward.id','=','address.ward_id')
            ->select('address.id','address.fname','address.lname','address.tax','address.active','city.name as city','district.name as district','ward.name as ward','address.info')
            ->get()->toArray();
            $type = 'Thông Tin Cá Nhân';
            return view('address',compact('cart','type','collection','checkUser','customer'));
        }else{
            return view('login');
        }
    }
    public function reset_password(Request $request)
    {
        $cart = $this->getCart($request->cookie('key_post'));
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $collection = Collection::get()->toArray();
        if(!empty($user[0]['user_id'])){
            $checkUser = customer::where('id',$user[0]['user_id'])->get()->toArray();
            $type = 'Thông Tin Cá Nhân';
            return view('resetPassword',compact('cart','type','collection','checkUser'));
        }else{
            return view('login');
        }
    }
    public function checkouts(Request $request)
    {
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $body =$request->all();
        $total = 0;
        $price = cart::whereIn('id',$body['cart'])->get()->toArray();
        foreach($price as $value){
            $cart = cart::find($value['id']);
            $cart->payment = 1;
            $cart->save();
            $priceTotal = product::select('price')->where('id',$value['product_id'])->get()->toArray();
            $total += $priceTotal[0]['price'] * $value['quality'];
        }
        $other = new other();
        $other->cart_id = json_encode($body['cart']);
        if(!empty($user[0]['user_id'])){
            $other->customer_id = $user[0]['user_id'];
        }
        $other->payment_method = 'COD';
        $other->shipping_price = 0;
        $other->customer_name = $body['fullname'];
        $other->status = 1;
        $other->tax = $body['tax'];
        $other->sum_price = $total;
        $other->total_price = $total;
        $other->created_at = date('Y-m-d H:i:s');
        $other->updated_at = date('Y-m-d H:i:s');
        $other->city_id = $body['city'];
        $other->district_id = $body['district'];
        $other->ward_id = $body['ward'];
        $other->info = $body['address'];
        if ($other->save()) {
            (new BillController)->EmailCustomer($body['email'],$other->get()->toArray());
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
        
    }
    public function addressClient(Request $request)
    {
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $body = $request->all();
        $address = new address();
        $address->city_id = $body['city'];
        $address->district_id = $body['district'];
        $address->ward_id = $body['ward'];
        $address->info = $body['info'];
        $address->fname = $body['fname'];
        $address->lname = $body['lname'];
        $address->tax = $body['tax'];
        $address->active = $body['active'];
        $address->user_id = $user[0]['user_id'];
        $address->created_at = date('Y-m-d H:i:s');
        $address->updated_at = date('Y-m-d H:i:s');
        if ($address->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
       
    }
    public function updateAddress(Request $request)
    {
        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $body = $request->all();
        $address = address::find($body['id']);
        // $address->city_id = $body['city'];
        // $address->district_id = $body['district'];
        // $address->ward_id = $body['ward'];
        $address->info = $body['info'];
        $address->fname = $body['fname'];
        $address->lname = $body['lname'];
        $address->tax = $body['tax'];
        $address->active = $body['active'];
        $address->updated_at = date('Y-m-d H:i:s');
        if ($address->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function deletaAddress(Request $request)
    {
        $body = $request->route('id');

        $user = Cookie_token::where('token_id',$request->cookie('key_post'))->get()->toArray();
        $address = address::where('user_id',$user[0]['user_id'])->get()->toArray();
        if(count($address) <= 1){
            $success = array('data' => '2');
            return $success;
        }else{
            $address = address::find($body);
            if ($address->delete()) {
                $success = array('data' => '1');
                return $success;
            };
            $error = array('data' => '-1',);
            return $error;
        }
    }
}
