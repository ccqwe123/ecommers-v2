<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Product;
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
            'name'=> 'Shampoo',
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
            'name' => 'Head & Shoulder',
            'details' => 'best Shampoo',
            'regular_price' => '150',
            'sale_price' => '100',
            'stock_status' => 'instock',
            'category_id' => '1'
        ]);

    }
}
