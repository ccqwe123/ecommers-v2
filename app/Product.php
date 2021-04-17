<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
use App\Category;
class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
    	'product_name',
    	'details',
    	'regular_price',
    	'sale_price',
    	'description',
    	'stock_status',
    	'category_id',
        'new',
        'promo',
        'sale',
    	'image'
    ];
    public function categories()
    {
        return $this->belongsTo(Category::class,'id');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function previewImage()
    {
        return $this->hasOne(Image::class, 'product_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    
}
