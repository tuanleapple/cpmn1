<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\helperController;
class Collection extends Model{
    protected $table = 'collection';
    public $timestamps = false;

    public static function addTag($title)
    {
        $slug =\Str::slug($title);
        $collection = Collection::where('slug',$slug)->where('type','tag')->first();
        if($collection){
            return $collection->id;
        }
        $collection = new self();
        $collection->title = $title;
        $collection->slug =  $slug;
        $collection->description = "";
        $collection->type = "tag";
        $collection->created_at = date('Y-m-d H:i:s');
        $collection->updated_at = date('Y-m-d H:i:s');
        $collection->save();
        return $collection->id;

    }
}