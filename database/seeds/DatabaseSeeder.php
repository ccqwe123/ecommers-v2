<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Product;
use App\Banner;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $cate = Category::create([
            'category_name'=> 'Shampoo',
            'slug'=> 'shampoo'
        ]);
        $user = User::create([
				'name'	=>	'Mang Kepweng',
				'email'	=>	'jaysoncabbab06@gmail.com',
				'usertype'	=>	'admin',
				'password'	=>	Hash::make('ccqwe123'),
                'provider' =>   'facebook',
                'checker' =>   '1',
                'provider_id' =>    NULL,
				]);
        $product = Product::create([
            'product_name' => 'Head & Shoulder',
            'details' => 'best Shampoo',
            'regular_price' => '150',
            'sale_price' => '100',
            'stock_status' => 'instock',
            'category_id' => '1'
        ]);
        $this->call(SettingsTableSeeder::class);

        $banner = Banner::create([
            'text_one' => 'Kid Smart ',
            'text_two' => 'Watches',
            'text_third' => 'Compra todos tus productos Smart por internet.',
            'text_fourth' => '59.99',
            'image_banner' => '/images/banner/main-slider-1-1.jpg',
            'slide_number' => '1',
            'bstyle' => '1'
        ]);

        Banner::create([
            'text_one' => 'Extra 25% Off',
            'text_two' => 'On online payments',
            'text_third' => 'Get Free',
            'text_fourth' => 'TRansparent Bra Straps',
            'image_banner' => '/images/banner/main-slider-1-2.jpg',
            'slide_number' => '2',
            'bstyle' => '2'
        ]);
        Banner::create([
            'text_one' => 'Great Range of ',
            'text_two' => 'Exclusive Furniture Packages',
            'text_third' => 'Exclusive Furniture Packages to Suit every need.',
            'text_fourth' => '225.00',
            'image_banner' => '/images/banner/main-slider-1-3.jpg',
            'slide_number' => '3',
            'bstyle' => '3'
        ]);
        $this->call(CouponTableSeeder::class);

    }
}
