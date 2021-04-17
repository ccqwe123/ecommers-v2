<?php

use Illuminate\Database\Seeder;
use App\Coupon;
class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'PROMO1000',
            'type' => 'fixed',
            'value' => 1000,
        ]);

        Coupon::create([
            'code' => '50PERCENT',
            'type' => 'percent',
            'percent_off' => 50,
        ]);
    }
}
