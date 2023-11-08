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
            'name' => $this->name,
            'description' => $this->description,
            'brand' => $this->brand->name,
            'model' => $this->model->description,
            'price' => '$'.number_format($this->price, 2),
            'year' => $this->year,
            'image' => $this->attachments()->count() >0 ? asset('storage/'.$this->attachments->first()->url) : "",
            'version' => $this->version_id == NULL ? '' : $this->version()->first()->name,
            'km' => $this->km,
            'sold' => $this->sold,
            'apartada' => $this->apartada,
            'color' => $this->colorClass()->count()>0 ? $this->colorClass->name : "",
        ];
    }
}
