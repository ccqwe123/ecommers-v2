<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'slug' => $this->slug,
            'description' => $this->description,
            'regular_price' => number_format($this->regular_price, 2),
            'sale_price' => number_format($this->sale_price, 2),
            'new' => $this->new,
            'promo' => $this->promo,
            'sale' => $this->sale,
            'image' => $this->image,
        ];
    }
}
