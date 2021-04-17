<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Image;
class Category extends Model
{
	protected $table = "categories";
	protected $fillable = [
    	'category_name',
    	'slug'
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }
    public function productByCategory()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function previewImage()
    {
        return $this->hasOne(Image::class, 'product_id');
    }
}

