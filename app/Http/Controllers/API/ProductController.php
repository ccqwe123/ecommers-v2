<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Category;
use App\Product;
use App\Image;
use App\Setting;
use App\User;
use Log;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Crypt;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchProducts(Request $request)
    {
        log::info($request);
        $item_per_page = 12;
        $sortperitem = 'id';
        $sortDirection = 'asc';
        if($request->sortperpage)
        {
            $item_per_page = $request->sortperpage;
        }
        if($request->sortperitem == 'price-asc')
        {
            $sortperitem = 'regular_price';
            $sortDirection = 'asc';
        }
        if($request->sortperitem == 'price-desc')
        {
            $sortperitem = 'regular_price';
            $sortDirection = 'desc';
        }
        if($request->sortperitem == 'newness')
        {
            $sortperitem = 'created_at';
            $sortDirection = 'desc';
        }
        $products = Product::withFilters(
            request()->input('categories', [])
        )
        ->orderBy($sortperitem, $sortDirection)
        ->paginate($item_per_page);

        return ProductResource::collection($products);
    }
    public function index()
    {
        return Product::select(['products.*','categories.category_name as category_name'])->leftjoin('categories','categories.id','=','products.category_id')->latest()->with('previewImage')->with('images')->paginate(9);
    }

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
    public function productDetail(Request $request, $product_name, $product_id, $random)
    {
        $setting = Setting::where('onsale', '>', Carbon::now('Asia/Manila'))->count();

        $dcrypt =Crypt::decryptString($product_id);
        $products = Product::select(['products.*','categories.category_name as category_name'])->leftjoin('categories','categories.id','=','products.category_id')->with('images')->where('products.id',$dcrypt)->first();

        $prod = Product::select(['products.*','categories.category_name as category_name','images.image_name'])->leftjoin('categories','categories.id','=','products.category_id')->leftjoin('images','images.product_id','=','products.id')->where('products.id',$dcrypt)->get();
        return view('frontpage.product', [
            'product' => $products,
            'onsale' => $setting,
            'images' =>$prod
        ]);
    }
    public function imageUpload(Request $request)
    {

    }
    public function store(Request $request)
    {
        $datecarbon = Carbon::now()->timestamp;
        $this->validate($request,[
            'product_name'=>'required',
            'regular_price'=>'required',
            'category_id'=>'required'
        ]);
        // // DB::beginTransaction();

           $product =  Product::create([
                'product_name' => $request['product_name'],
                'regular_price' => $request['regular_price'],
                'sale_price' => $request['sale_price'],
                'category_id' => $request['category_id'],
                'stock_status' => 'InStock',
                'description' => $request['description'],
                'details' => $request['details'],
                'new' => $request['new']=='true'?1:0,
                'promo' => $request['promo']=='true'?1:0,
                'sale' => $request['sale']=='true'?1:0,
            ]); 
           if($request->images){
                for ($i=0;$i<sizeof($request->images);$i++){
                    $originalName = rand('100','999').time().'.' . explode('/', explode(':', substr($request->images[$i], 0, strpos($request->images[$i], ';')))[1])[1];
                    \Image::make($request->images[$i])->resize(800, 800)->save(public_path('images/products/').$originalName);

                    DB::table('images')
                    ->insert([
                        'product_id' => $product->id,
                        'image_name' => 'images/products/'.$originalName
                    ]);
                    if($i < 1)
                    {

                    $qwe =Product::where('id', $product->id)
                      ->update(['image' => 'images/products/'.$originalName]);
                    }
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
         $this->validate($request,[
            'product_name'=>'required',
            'regular_price'=>'required',
            'category_id'=>'required'
        ]);
         $product = Product::findOrFail($id);
        try {
            // if(count($request->images[0]) > 1000)
            if(isset($request->images[0]['image_name']))
            {
                $product->update($request->all());
                return ['message' => 'Updated the product info'];
            }else{
                $product->update($request->all());
                DB::table('images')
                ->where('product_id',$id)
                ->delete();

                for ($i=0;$i<sizeof($request->images);$i++){
                    $originalName = rand('100','999').time().'.' . explode('/', explode(':', substr($request->images[$i], 0, strpos($request->images[$i], ';')))[1])[1];
                    \Image::make($request->images[$i])->resize(800, 800)->save(public_path('images/products/').$originalName);
                    DB::table('images')
                    ->insert([
                        'product_id' => $id,
                        'image_name' => 'images/products/'.$originalName
                    ]);
                    if($i < 1)
                    {

                    $qwe =Product::where('id',$id)
                      ->update(['image' => 'images/products/'.$originalName]);
                    }
                }
            }
        } catch (Exception $e) {

            
        }
        // if (count($hey)>1000){
        //     log::info('True');
        // }else{
        //     log::info('false');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::findOrFail($id);
        // delete the user

        $product->delete();

        return ['message' => 'Product Deleted'];
    }
}
