<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\collectionProduct;
use App\Models\Log;
use App\Http\Controllers\CollectionController;
use App\Models\product;
use App\Models\variant;
use App\Models\Attribute;
use Session;
use DB;
class ProductController extends Controller
{
    public function index(Request $request)
    {
       
        $user = Session::get('user');
        if($user){
            if($request->input('search')){
                $product = DB::table('product as p')->join('variant as v','v.product_id','=','p.id')->groupBy('p.id')
                ->select('p.id','p.title','p.display','p.slug','p.price','p.highlights','p.created_at','p.image',DB::raw('sum(v.quality) as qualityProduct'))
                ->where('title','LIKE',"%".$request->search."%")->orderBy('created_at','DESC')
                ->paginate(10);
                $type = $request->search;
                return view('admin.product',compact('product','type'));
            }else{
                $product = DB::table('product as p')->join('variant as v','v.product_id','=','p.id')->groupBy('p.id')
                ->select('p.id','p.title','p.display','p.slug','p.price','p.highlights','p.created_at','p.image',DB::raw('sum(v.quality) as qualityProduct'))->orderBy('created_at','DESC')
                ->paginate(10);
                return view('admin.product',compact('product'));
            }

        }
        else{
            return view('admin.login');
        }
    }
    public function createProduct()
    {
        $user = Session::get('user');
        if($user){
            $gender = Attribute::where('type','gender')->get()->toArray();
            $size = Attribute::where('type','size')->get()->toArray();
            $collectionProduct = collectionProduct::get()->toArray();
            return view('admin.createProduct',compact('collectionProduct','gender','size'));
        }
        else{
            return view('admin.login');
        }
    }
    public function createProductimage(Request $request)
    {
        $images = array();
        $image = $request->file('file');
        if($request->hasFile('file')){
            foreach($image as $key => $file){
                $name =hexdec(uniqid()) .'.'.$file->getClientOriginalExtension();
                $file->move(public_path('/upload/product'),$name);
                $images[]=$name;
            }
            if($images){
                $success = array('data' => '1','images'=>$images);
                return $success;
            };
            $error = array('data' => '-1',);
            return $error;
        }
       

    }
    public function deleteImage(Request $request)
    {
        $body = $request->all();
        $image_path = public_path("/upload/product/".$body['image']); 
        if (file_exists($image_path)) {
            unlink($image_path);
            $success = array('data' => '1');
            return $success;
        }
           
        $error = array('data' => '-1',);
        return $error;
    }
    public function create(Request $request)
    {
       $body=$request->all();
       $product = new product;
       $product->title = $body['title'];
       $product->slug = (new CollectionController)->convert_handle($body['title']);
       $product->collection_id = $body['collection'];
       $product->description = $body['description'];
       if(!empty($body['first_image'])){
        $product->image = $body['first_image'];
       }
       if(!empty($body['price'])){
        $product->price = $body['price'];
       }
       $product->product_gender = $body['gender'];
       $product->display = $body['display'];
       if(!empty($body['image'])){
        $product->list_image = $body['image'];
       }
       $product->highlights = $body['highlight'];
       $product->meta_title = $body['meta_title'];
       $product->created_at = date('Y-m-d H:i:s');
       $product->updated_at = date('Y-m-d H:i:s');
       $moduleLog = 'create__product';
       $messageLog = 'Tạo mới san pham '.$product->title;
       $log = Log::add($moduleLog, $messageLog, json_encode($product->title));
       if ($product->save()) {
           for($i = 0; $i < count($body['size']) ;$i++){
                $variant = new variant();
                $variant->product_id = $product->id;
                $variant->attribute_id = $body['size'][$i];
                $variant->quality = $body['quality'][$i];
                $variant->created_at = date('Y-m-d H:i:s');
                $variant->updated_at = date('Y-m-d H:i:s');
                $variant->save();
           }
           $success = array('data' => '1');
           return $success;
       };
       $error = array('data' => '-1',);
       return $error;
    }
    public function editProduct(Request $request)
    {
        $user = Session::get('user');
        if($user){
        $body = $request->route('id');
        $checkV = array();
        $option = '';
        $optionCheck = '';
        $product = product::find($body);
        $variant = variant::where('product_id',$body)->join('attribute','attribute.id','=','variant.attribute_id')
        ->select('variant.id','variant.attribute_id','variant.quality','attribute.title')->get()->toArray();
        $gender = Attribute::where('type','gender')->get()->toArray();
        $collectionProduct = collectionProduct::get()->toArray();
        if(!empty($variant)){
            $variantCheck =  variant::where('product_id',$body)->select('variant.attribute_id')->get()->toArray();
            if($variantCheck){
                foreach($variantCheck as $value){
                    $checkV[] = $value['attribute_id'];
                }
            }
            $size = Attribute::where('type','size')->whereIn('id',$checkV)->get()->toArray();
            $sizeNoCheck = Attribute::where('type','size')->whereNotIn('id',$checkV)->get()->toArray();
            if($size || $sizeNoCheck){
                foreach($size as $value){
                    $optionCheck .= '<option value="'.$value['id'].'" data-size="'.$value['title'].'" selected disabled >'.$value['title'].'</option>';
                }
                foreach($sizeNoCheck as $value){
                    $optionCheck .= '<option value="'.$value['id'].'" data-size="'.$value['title'].'" >'.$value['title'].'</option>';
                }
            }
        
            return view('admin.editProduct',compact('product','collectionProduct','gender','size','variant','optionCheck'));
        }
        $size = Attribute::where('type','size')->get()->toArray();
        return view('admin.editProduct',compact('product','collectionProduct','gender','size'));
        }
        else{
            return view('admin.login');
        }
    }
    public function edit(Request $request)
    {
        $body = $request->all();
        $product = product::find($body['id']);
        $product->title = $body['title'];
        $product->slug = (new CollectionController)->convert_handle($body['title']);
        $product->collection_id = $body['collection'];
        $product->description = $body['description'];
        if(!empty($body['first_image'])){
            $product->image = $body['first_image'];
        }
        if(!empty($body['price'])){
        $product->price = $body['price'];
        }
        $product->product_gender = $body['gender'];
        $product->display = $body['display'];
        if(!empty($body['image'])){
            $product->list_image = $body['image'];
        }
        $product->highlights = $body['highlight'];
        $product->meta_title = $body['meta_title'];
        $product->updated_at = date('Y-m-d H:i:s');
        $moduleLog = 'edit__product';
        $messageLog = 'chinh sua san pham '.$product->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($product->title));
        if ($product->save()) {
            for($i = 0; $i < count($body['size']) ;$i++){
                $variant = variant::where('product_id',$body['id'])->where('attribute_id',$body['size'][$i])->get();
                if(!empty($variant)){
                    $variant = new variant();
                }
                $variant->product_id = $product->id;
                $variant->attribute_id = $body['size'][$i];
                $variant->quality = $body['quality'][$i];
                $variant->created_at = date('Y-m-d H:i:s');
                $variant->updated_at = date('Y-m-d H:i:s');
                $variant->save();
           }
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function delete(Request $request)
    {
        $id = $request->route('id');
        $item = product::find($id);
        $moduleLog = 'delete_product';
        $messageLog = 'xoa product '.$item->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($item->title));
        if ($item->delete()) {
            $success = array('data' => '1');
            return $success;
        }
        $error = array('data' => '-1',);
        return $error;
    }

    public function deleteVariant(Request $request)
    {
        $id = $request->route('id');
        $item = variant::find($id);
        $moduleLog = 'delete_product_variant';
        $messageLog = 'xoa product variant '.$item->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($item->title));
        if ($item->delete()) {
            $success = array('data' => '1');
            return $success;
        }
        $error = array('data' => '-1',);
        return $error;
    }
    public function changeDisplay(Request $request)
    {
        $body = $request->all();
        $display = product::where('id',$body['id'])->first();
        if($display->display == 0){
            $display->display = 1;
            if ($display->save()) {
                $success = array('data' => '1');
                return $success;
            }
            $error = array('data' => '-1',);
            return $error;
        }else{
            $display->display = 0;
            if ($display->save()) {
                $success = array('data' => '1');
                return $success;
            }
            $error = array('data' => '-1',);
            return $error;
        }
    }
    public function changeHighlight(Request $request)
    {
        $body = $request->all();
        $display = product::where('id',$body['id'])->first();
        if($display->highlights == 0){
            $display->highlights = 1;
            if ($display->save()) {
                $success = array('data' => '1');
                return $success;
            }
            $error = array('data' => '-1',);
            return $error;
        }else{
            $display->highlights = 0;
            if ($display->save()) {
                $success = array('data' => '1');
                return $success;
            }
            $error = array('data' => '-1',);
            return $error;
        }
    }
}
