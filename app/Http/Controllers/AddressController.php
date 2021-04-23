<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use DB;
use App\UserAddress;
use Log;
use Validator;
use Auth;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBarangay($barangay_id)
    {
        $data = DB::table('user_barangays')
        ->where('city_id', $barangay_id)->get();
         $decode = json_decode($data);
         $barangay = response()->json($decode);
        return $barangay;
    }
    public function getCity($province_id)
    {
        $data = DB::table('user_cities')
        ->where('province_id', $province_id)->get();
         $decode = json_decode($data);
         $cities = response()->json($decode);
        return $cities;
    }
    public function getProvince()
    {
        $province = DB::table('user_provinces')->get();
        return $province;
    }
    public function index()
    {
        $address = UserAddress::select(['user_address.slug','user_address.fullname','user_address.telephone','user_address.house_info','user_cities.name as city_name','user_barangays.name as barangay_name','user_provinces.name as province_name'])
        ->leftjoin('user_provinces','user_address.province_id','=','user_provinces.province_id')
        ->leftjoin('user_cities','user_address.city_id','=','user_cities.city_id')
        ->leftjoin('user_barangays','user_address.barangay_id','=','user_barangays.code')
        ->where('user_address.user_id', Auth::user()->id)
        ->get();
        return view('user.address.address',compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prov = DB::table('user_provinces')->get();
         $province = json_decode($prov);
         $hhh = response()->json($province);

        return view('user.address.create',[
            'province'=>$prov
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'fullname'=>'required|min:6',
                'telephone'=>'required|min:10',
                'house_info'=>'required|min:6',
                'province_id'=>'required',
                'city_id'=>'required',
                'barangay_id'=>'required',
            ]);
        if(!$validator->passes()){
              return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
          }else{
            $useradd = UserAddress::create([
                'slug' => SlugService::createSlug(UserAddress::class, 'slug', $request['house_info']),
                'fullname' => $request['fullname'],
                'telephone' => $request['telephone'],
                'house_info' => $request['house_info'],
                'province_id' => $request['province_id'],
                'city_id' => $request['city_id'],
                'barangay_id' => $request['barangay_id'],
                'address_description' => $request['address_description'],
                'user_id' => Auth::user()->id,
            ]); 
            return redirect()->route('address.index')->with('success','New Address Added!');
          }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = UserAddress::where('slug',$id)->first();
        $prov = DB::table('user_provinces')->get();

        return view('user.address.edit',[
            'province'=>$prov,
            'address'=>$data
        ]);
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
        log::info($request);
        $this->validate($request,[
            'fullname'=>'required|min:6',
                'telephone'=>'required|min:10',
                'house_info'=>'required|min:6',
                'province_id'=>'required',
                'city_id'=>'required',
                'barangay_id'=>'required',
        ]);
        $data = UserAddress::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('address.index')->with('success','New Address Added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = UserAddress::where('slug', $id)->first();
        if(!$address)
        {
            return redirect()->route('address.index')->with('fail','Someting went wrong!');
        }
        $data = UserAddress::find($address->id);

        $data->delete();
            return redirect()->route('address.index')->with('success','Address deleted!');
    }
}
