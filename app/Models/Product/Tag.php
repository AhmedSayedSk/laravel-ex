<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $table = "products_tags";

    public static function rules(){
    	$regex = "~^[\p{L}_]{1,50}$~iu";

    	return [
    		'tag_name' => "required|unique:products_tags|min:2|max:50|regex:$regex",
    	];
    }

    public function products(){
    	return $this->belongsToMany('App\Models\Product\Product', 'products_tags_relationship', 'tag_id', 'product_id');
    }
}
