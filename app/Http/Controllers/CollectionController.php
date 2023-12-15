<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Collection;
use App\Models\Log;
use Session;
class CollectionController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        if($user){
            $collection = Collection::paginate(10);;
            return View('admin.collection',compact('collection'));
        }
        else{
            return view('admin.login');
        }
    }
    public function getCollection(Request $request)
    {
        $collection = Collection::get()->toArray();
        if ($collection) {
            $success = array('data' => '1','collection'=>$collection);
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function createCollection(Request $request, Response $response)
    {
        $body =  $request->all();
        $title = $body['title'];
        $des = $body['des'];
        $parent_id = $body['parent_id'];
        $handle = $this->convert_handle($title);
        $collection = new Collection;
        $collection->title = $title;
        $collection->description = $des;
        $collection->parent_id = $parent_id;
        $collection->slug = $handle;
        $collection->type = 'category';
        $collection->created_at = date('Y-m-d H:i:s');
        $collection->updated_at = date('Y-m-d H:i:s');
        $moduleLog = 'create_collection';
        $messageLog = 'Tạo mới danh muc '.$collection->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($collection->title));
        if ($collection->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function deleteItemCollection(Request $request)
    {
        $id = $request->route('id');
        $item = Collection::find($id);
        $moduleLog = 'delete_collection';
        $messageLog = 'xoa mới danh muc '.$item->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($item->title));
        if ($item->delete()) {
            $success = array('data' => '1');
            return $success;
        }
        $error = array('data' => '-1',);
        return $error;
    }
    public function editCollection(Request $request)
    {
        $body =  $request->all();
        $collection = Collection::find($body['id']);
        $collection->title = $body['title'];;
        $collection->description = $body['des'];;
        $collection->parent_id = $body['parent_id'];
        $collection->slug = $this->convert_handle($body['title']);
        $collection->type = 'category';
        $collection->created_at = date('Y-m-d H:i:s');
        $collection->updated_at = date('Y-m-d H:i:s');
        $moduleLog = 'update_collection';
        $messageLog = 'sua mới danh muc '.$collection->title;
        $log = Log::add($moduleLog, $messageLog, json_encode($collection->title));
        if ($collection->save()) {
            $success = array('data' => '1');
            return $success;
        };
        $error = array('data' => '-1',);
        return $error;
    }
    public function getParentCollection(Request $request)
    {
        $body =  $request->all();
        $id = $request->route('id');
        $parent_id = $body['parent'];
        $collectionNotIn = Collection::whereNotIn('id', [$id])->get();
        if ($parent_id == 0) {
            $item = '';
            if ($collectionNotIn) {
                foreach ($collectionNotIn as $value) {
                    $item .= <<<EOT
                    <option value={$value->id}>{$value->title}</option>'
                    EOT;
                }
                return array('data' => $item, 'status' => '1');
            }
            return array('status' => '-1');
        };
        $itemone = '';
        if ($collectionNotIn) {
            foreach ($collectionNotIn as $value) {
                if($value->id == $parent_id){
                    $itemone .= <<<EOT
                    <option value={$value->id} selected>{$value->title}</option>'
                    EOT; 
                }else{
                    $itemone .= <<<EOT
                    <option value={$value->id}>{$value->title}</option>'
                    EOT;
                }
               
            }
            return array('data' => $itemone, 'status' => '1');
        }
        return array('status' => '-1');
    }
    public function convert_handle($str)
    {
        $str = trim($str);
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(' ', '-', $str);
        $str = str_replace('.', '-', $str);
        $str = strtolower($str);
        $str = preg_replace('/[^A-Za-z0-9-]+/', '-', $str);
        $str = str_replace('&', '-', $str);
        $str = str_replace('"', '-', $str);
        $str = str_replace('--', '-', $str);
        $str = str_replace('--', '-', $str);
        $str = str_replace('--', '-', $str);
        $str = str_replace('--', '-', $str);
        if (substr($str, -1) == '-') $str = substr($str, 0, -1);
        return $str;
    }
}
