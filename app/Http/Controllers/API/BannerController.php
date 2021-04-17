<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Log;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Banner::where('slide_number',$request->slide)->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //slide_number
        $banner = Banner::where('slide_number',$request->slide_number)->first();
        $this->validate($request,[
            'text_one'=>'required',
            'text_two'=>'required',
            'text_third'=>'required',
            'slide_number'=>'required'
        ]);
        $currPhoto = $banner->image_banner;

          if($request->image_banner != $currPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->image_banner, 0, strpos($request->image_banner, ';')))[1])[1];

            \Image::make($request->image_banner)->save(public_path('images/banner/').$name);
            $request->merge(['image_banner' => $name]);

            $bannerPhoto = public_path('images/banner/').$currPhoto;
            if(file_exists($bannerPhoto)){
                @unlink($bannerPhoto);
            }

        }
         $banner->update($request->all());
         return ['message' => "Success"];
        // log::info($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
