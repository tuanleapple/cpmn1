<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model{
    protected $table = 'attribute';
    public $timestamps = false;
    public static function createAttribute($title,$type){
        $checkTitle = Attribute::where('title',$title)->first();
        if($checkTitle){
            $checkTitle->created_at = date('Y-m-d H:i:s');
            $checkTitle->updated_at = date('Y-m-d H:i:s');
            $checkTitle->save();
            return $checkTitle->id;
        }else{
            $attribute = new Attribute();
            $attribute->title = $title;
            $attribute->type = $type;
            $attribute->created_at = date('Y-m-d H:i:s');
            $attribute->updated_at = date('Y-m-d H:i:s');
            $attribute->save();
            return $attribute->id;
        }

    }
}