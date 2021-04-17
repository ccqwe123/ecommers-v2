<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Log;
use Carbon\Carbon;
use DB;
use App\Setting;
class SettingController extends Controller
{
	public function index()
	{
		return Setting::first();
	}

	public function store(Request $request)
	{
		$this->validate($request,[
            'onsale'=>'required'
        ]);
		$settings_check = Setting::count();
		if($settings_check > 0)
		{
			 return Setting::where('id', $settings_check)->update(['onsale' => $request->onsale]);
		}

	}
}
