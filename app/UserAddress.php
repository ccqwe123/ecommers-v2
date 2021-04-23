<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\User;
class UserAddress extends Model
{
    use Sluggable;
	protected $table = "user_address";
	protected $fillable = [
    	'fullname',
    	'telephone',
    	'house_info',
    	'province_id',
    	'address_description',
    	'city_id',
    	'barangay_id',
        'user_id'
    ];
	public function users()
    {
        return $this->hasMany(User::class);
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'house_info'
            ]
        ];
    }
}
