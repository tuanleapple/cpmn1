<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\CollectionController;
use App\Models\Collection;
use App\Models\Post;
use App\Models\postCollection;
use App\Models\UserAdmin;
use Session;
class PostController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        if($user){
            return View('admin.post');
        }
        else{
            return view('admin.login');
        }
        
    }

    public function createPost()
    {
        $user = Session::get('user');
        if($user){
            return View('admin.createPost');
        }
        else{
            return view('admin.login');
        }
       
    }

    public function getTablePost(Request $request)
    {
       $renderPost =Post::from('post as p')->select('p.id','p.title','u.fullname','p.created_at','p.img',\DB::raw('GROUP_CONCAT(c.title) as categories' ))
       ->leftjoin('post_collection as pc','p.id','=','pc.post_id')
       ->leftjoin('collection as c',function($join){
           $join->on('c.id','=','pc.collection_id')
           ->where('c.type',"=","category");
       })
       ->leftJoin('user_admin as u','u.id','=','p.user_id')
       ->OrderBy('p.created_at', 'DESC')
       ->groupBy('p.id', 'p.title', 'u.fullname','p.created_at','p.img')
       ->get()->toArray();
        if($renderPost){
                $success = array('data' => '1','renderPost'=>$renderPost);
                return $success;
        }
        $error = array('data' => '-1',);
        return $error; 

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

    public function uploadImagesVs5(){
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        $mainUrl = url('/').'/';
        $imageFolder = "upload/post/";
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder, 0777);
        }
        reset($_FILES);
        $temp = current($_FILES);
        if ($temp['tmp_name']) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }
            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }
            
            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            return response()->json(array(
                'code' => 1,
                'filename' => $filetowrite,
                'location' => $mainUrl . $filetowrite
            ));
        } else {
            return response()->json(array(
                'code' => -1,
                'message' => 'Error'
            ));
        }
    }
    public function getCollection(Request $request)
    {
        $collection = Collection::get();
        return $collection;
    }
    public function createPostZing(Request $request){
        $body = $request->all();
        $attribute = [];
        $tag = $body['tag'];
        foreach($tag as $value){
            $attribute[] = Collection::addTag($value);
        }
        $post = new Post();
        $post->title = $body['title'];
        $post->slug = (new CollectionController)->convert_handle($body['title']);
        $post->content = $body['content'];
        $post->img = $body['image'];
        $post->user_id = 140;
        $post->created_at = date('Y-m-d H:i:s');
        $post->updated_at = date('Y-m-d H:i:s');
       
        if ($post->save()) {
            foreach($attribute as $value){
                $attribute = postCollection::addPostCollection($post->id,$value);
            } 
            foreach($body['parent_id'] as $value){
                $attribute = postCollection::addPostCollection($post->id,$value);
            } 
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
}
