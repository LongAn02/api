<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image,
            'category' => [
                'category_id' => $this->categories->id,
                'category_name' => $this->categories->name
            ],
            'discount' => [
                'discount_id' => $this->discounts->id,
                'discount_name' => $this->discounts->name
            ],
            'status' => $this->status
        ];
    }
}
