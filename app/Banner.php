<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
     protected $table = "banners";
    protected $fillable = [
    	'text_one',
    	'text_two',
    	'text_third',
    	'text_fourth',
    	'image_banner',
    	'slide_number',
    	'bstyle'
    ];
}
