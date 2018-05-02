<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'stock' => $this->stock == 0 ? 'Out of stock' : $this->stock,
            'totalprice' => round((1 - ($this->discount/100)) * $this->price, 2),
            'star' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count('star'),2) : 'No rating yet',
            'discount' => $this->discount,
            'href' => [
                'link' => route('products.show', $this->id),
            ],
        ];
    }
}
