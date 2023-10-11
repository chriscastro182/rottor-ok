<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	protected $table = 'appointment';

	protected $fillable = ['customer_id', 'day', 'hour'];

	/**
	 * Function for the relation of the CUstomer
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id');
	}


	/**
	 * Function for the elation of the Quotation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function quotations()
	{
		return $this->belongsToMany('App\Models\Quotation', 'appointment_has_quotation', 'appointment_id', 'quotation_id');
	}

	/**
	 * Function for the Order relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function orders()
	{
		return $this->belongsToMany('App\Models\Order', 'appointment_has_order', 'appointment_id', 'order_id');
	}

    public function customMarkets()
    {
        return $this->belongsToMany(CustomMarket::class, 'appointment_has_custom_market', 'appointment_id', 'custom_market_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'appointment_has_product', 'appointment_id', 'product_id');
    }
}
