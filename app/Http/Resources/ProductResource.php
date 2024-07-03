<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_category' => $this->category->name,
            'name' => $this->name,
            'price' => $this->price,
            'qty' => $this->qty,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }
}
