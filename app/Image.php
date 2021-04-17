<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";
    protected $fillable = [
    	'product_id',
    	'image_name'
    ];
    public function image()
    {
    	return $this->hasOne(Product::class);
	}
}
