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
            "id"=> $this->id,
            "name"=> $this->name,
            "image"=> $this->image,
            "price"=> $this->price,
            "discount_price"=> $this->discount_price,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "category" => new CategoryResource($this->whenLoaded("category")),
        ];
    }
}
