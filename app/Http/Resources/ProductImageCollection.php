<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductImageCollection extends ResourceCollection
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
            'name' => $this->attachment->name,
            'folder' => $this->attachment->folder,
            'mime' => $this->attachment->mime,
            'url' => asset('storage/'.$this->attachment->url)
        ];
    }
}
