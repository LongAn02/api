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
            'discount' => $this->discounts->percent_discount,
            'status' => $this->status
        ];
    }
}
