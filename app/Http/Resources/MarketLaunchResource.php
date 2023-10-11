<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketLaunchResource extends JsonResource
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
			'brand_id' => $this->brand_id,
			'model_id' => $this->model_id,
			'year' => $this->year,
			'cc' => $this->cc,
			'is_cashiable' => $this->is_cashiable,
			'full_payment' => $this->full_payment,
			'exchange_payment' => $this->exchange_payment,
			'allocation_payment' => $this->allocation_payment,
		];
    }
}
