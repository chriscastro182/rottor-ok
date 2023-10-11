<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
	protected $table = 'quotation';

	protected $fillable = ['market_launch_id', 'km', 'import', 'discount_factor', 'total', 'is_cash'];

	/**
	 * Function for the market launch relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function marketLaunch()
	{
		return $this->belongsTo('App\Models\MarketLaunch', 'market_launch_id');
	}

	/**
	 * Function for the appointment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function appointments()
	{
		return $this->belongsToMany('App\Models\Appointment', 'appointment_has_quotation', 'quotation_id', 'appointment_id');
	}

}
