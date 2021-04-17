<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";
	protected $fillable = [
    	'onsale',
    	'system_name',
    	'system_description',
    	'system_phone',
    	'system_email',
    	'system_address',
    	'system_location'
    ];
}
