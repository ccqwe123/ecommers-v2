<?php

namespace App\Services;
use App\Product;

class PriceService
{
	private $prices;
    private $categories;

    public function getPrices($prices, $categories)
    {
        $this->prices = $prices;
        $this->categories = $categories;
        $formattedPrices = [];

        foreach(Product::PRICES as $index => $name) {
            $formattedPrices[] = [
                'product_name' => $name,
                'products_count' => $this->getProductCount($index)
            ];
        }

        return $formattedPrices;
    }

    private function getProductCount($index)
    {
        return Product::withFilters($this->prices, $this->categories)
             ->when($index == 0, function ($query) {
                $query->where('regular_price', '<', '1000.00');
            })
            // ->when($index == 1, function ($query) {
            //     $query->whereBetween('regular_price', ['10100', '30000']);
            // })
            // ->when($index == 2, function ($query) {
            //     $query->whereBetween('regular_price', ['30100', '50000']);
            // })
            // ->when($index == 3, function ($query) {
            //     $query->where('regular_price', '>', '50100');
            // })
            ->count();
    }
}
