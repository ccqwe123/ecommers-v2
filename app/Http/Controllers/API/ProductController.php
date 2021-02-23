<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Image;
use App\User;
use Log;
use Carbon\Carbon;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select(['products.*','categories.name as category_name'])->leftjoin('categories','categories.id','=','products.category_id')->latest()->with('previewImage')->paginate(10);
        log::info($product);
        return $product;
;    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner()
    {
        return view('admin.banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imageUpload(Request $request)
    {
        // $datecarbon = Carbon::now()->timestamp;
        // for ($i=0;$i<sizeof($request->images);$i++){
        //     $originalName = $request->images[$i]->getClientOriginalName();
        //     $setDB = str_random(5)."-".$datecarbon."-".$originalName;
        //     $testa[$i] = \Image::make($request->images[$i])->save(public_path('images/products/').$setDB);
        //     $product = Product::orderBy('id','desc')->first();

        //     DB::table('images')
        //         ->insert([
        //             'product_id' => $product->id[$i] + 1,
        //             'image_name' => $setDB
        //         ]);
        // }
    }
    public function store(Request $request)
    {
        $datecarbon = Carbon::now()->timestamp;
        $this->validate($request,[
            'name'=>'required',
            'regular_price'=>'required',
            'category_id'=>'required'
        ]);
        // DB::beginTransaction();

           $product =  Product::create([
                'name' => $request['name'],
                'regular_price' => $request['regular_price'],
                'sale_price' => $request['sale_price'],
                'category_id' => $request['category_id'],
                'stock_status' => 'instock',
                'description' => $request['content'],
                'details' => $request['details'],
            ]); 
           log::info($request);
           if($request->images){
                for ($i=0;$i<sizeof($request->images);$i++){
                    $originalName = rand('100','999').time().'.' . explode('/', explode(':', substr($request->images[$i], 0, strpos($request->images[$i], ';')))[1])[1];
                    \Image::make($request->images[$i])->save(public_path('images/products/').$originalName);
                    DB::table('images')
                    ->insert([
                        'product_id' => $product->id,
                        'image_name' => $originalName
                    ]);
                }
            }

           
            return ['message' => 'Product Added!'];
       
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
