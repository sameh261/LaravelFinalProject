<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cart_id' => $this->cart_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'product_price' => $this->product->price,
            'product_description' => $this->product->description,
            'product_image_url' => $this->product->image,
            'quantity' => $this->quantity,
            'total_price' => $this->quantity * $this->product->price,
        ];
    }
}
