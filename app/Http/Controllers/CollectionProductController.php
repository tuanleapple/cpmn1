<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CollectionController;
use App\Models\collectionProduct;
use App\Models\Log;
use Session;
class CollectionProductController extends Controller
{
    public function index(){
        $user = Session::get('user');
        if($user){
            $collectionProduct = collectionProduct::paginate(10);
            return View('admin.collectionProduct',compact('collectionProduct'));
        }
        else{
            return view('admin.login');
        }
        
    }
    public function createCollectionProduct(){
        $user = Session::get('user');
        if($user){
            $collectionProduct = collectionProduct::get()->toArray();
            return View('admin.createCollectionProduct',compact('collectionProduct'));
        }
        else{
            return view('admin.login');
        }
       
    }
    public function uploadImages(Request $request)
    {
        if ($request->hasFile('post-image')) {
            $image = $request->file('post-image');
            $name_image = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/collectionProduct');
            if($image->move($destinationPath,$name_image)){
                $success = array('data' => '1','name'=>$name_image);
                return $success;
             };
            $error = array('data' => '-1',);
            return $error;
        }
    }
    public function CollectionProductCreate(Request $request){
            $body = $request->all();
           $collectionProduct = new collectionProduct;
           $collectionProduct->title = $body['title'];
           $collectionProduct->title_en = $body['title_en'];
           $collectionProduct->slug = (new CollectionController)->convert_handle($body['title']);
           $collectionProduct->slug_en = (new CollectionController)->convert_handle($body['title_en']);
           $collectionProduct->parent_id = $body['parent_id'];
           $collectionProduct->image = $body['image'];
           $collectionProduct->content = $body['content'];
           $collectionProduct->content_en = $body['content_en'];
           $collectionProduct->description = $body['description'];
           $collectionProduct->description_en = $body['description_en'];
           $collectionProduct->meta_title = $body['meta_title_vi'];
           $collectionProduct->meta_title_en = $body['meta_title_en'];
           $collectionProduct->created_at = date('Y-m-d H:i:s');
           $collectionProduct->updated_at = date('Y-m-d H:i:s');
           $moduleLog = 'create_collection_product';
           $messageLog = 'Tạo mới danh muc san pham '.$collectionProduct->title;
           $log = Log::add($moduleLog, $messageLog, json_encode($collectionProduct->title));
           if ($collectionProduct->save()) {
               $success = array('data' => '1');
               return $success;
           };
           $error = array('data' => '-1',);
           return $error;
    }
    public function editCollectionProduct(Request $request)
    {
        $body = $request->route('id');
        $collectionProduct = collectionProduct::where('id','=',$body)->get()->toArray();
        $collectionProduct_1 = collectionProduct::where('id','!=',$body)->get()->toArray();
        return View('admin.editCollectionProduct',['collectionProduct'=>$collectionProduct[0],'collectionProduct_1'=>$collectionProduct_1]);
    }
    public function edit(Request $request)
    {
        $body = $request->all();
        $collectionProduct = collectionProduct::find($body['id']);
        $collectionProduct->title = $body['title'];
        $collectionProduct->title_en = $body['title_en'];
        $collectionProduct->slug = $body['slug'];
        $collectionProduct->slug_en = $body['slug_en'];
        $collectionProduct->parent_id = $body['parent_id'];
        $collectionProduct->image = $body['image'];
        $collectionProduct->content = $body['content'];
        $collectionProduct->content_en = $body['content_en'];
        $collectionProduct->description = $body['description'];
        $collectionProduct->description_en = $body['description_en'];
        $collectionProduct->meta_title = $body['meta_title_vi'];
        $collectionProduct->meta_title_en = $body['meta_title_en'];
        $collectionProduct->created_at = date('Y-m-d H:i:s');
        $collectionProduct->updated_at = date('Y-m-d H:i:s');
        $moduleLog = 'edit_collection_product';
        $messageLog = 'chỉnh sửa danh mục sản phẩm'.$collectionProduct->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($collectionProduct->title));
        if ($collectionProduct->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }

}
