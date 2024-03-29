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
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "image" => $this->image ? asset('storage/' . $this->image) : asset('images/default_user.jpg'),
            "category" => $this->category
        ];
    }
}
