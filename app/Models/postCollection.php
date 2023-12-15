<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class postCollection extends Model
{
    protected $table = 'post_collection';
    public $timestamps = false;

    public static function addPostCollection($post_id,$collection_id){
        $postCollection = new self();
        $postCollection->post_id=$post_id;
        $postCollection->collection_id = $collection_id;
        $postCollection->created_at = date('Y-m-d H:i:s');
        $postCollection->updated_at = date('Y-m-d H:i:s');
        $postCollection->save();

    }
}
