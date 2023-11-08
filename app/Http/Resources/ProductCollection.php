<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'brand' => $this->brand->name,
            'model' => $this->model->description,
            'price' => $this->price,
            'year' => $this->year,
            'sold' => $this->sold,
            'apartada' => $this->apartada,
            'color' => $this->color,
        ];
    }
}
