<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
    	'name',
    	'details',
    	'regular_price',
    	'sale_price',
    	'description',
    	'stock_status',
    	'category_id',
    	'image'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function previewImage()
    {
        return $this->hasOne(Image::class);
    }
}
