<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketLaunch extends Model
{
	protected $table = 'market_launch';

	protected $fillable = ['brand_id', 'model_id', 'version_id', 'year', 'cc', 'is_cashiable', 'full_payment', 'exchange_payment', 'allocation_payment'];

	/**
	 * Function for the Brand relation
	 *
	 * @return Relation
	 */
	public function brand()
	{
		return $this->belongsTo('App\Models\Brand', 'brand_id');
	}

	/**
	 * Function for the Model relation
	 *
	 * @return Relation
	 */
	public function model()
	{
		return $this->belongsTo('App\Models\Model', 'model_id');
	}
	
	/**
	 * Function for the Model relation
	 *
	 * @return Relation
	 */
	public function version()
	{
		return $this->belongsTo('App\Models\Version', 'version_id');
	}

	/**
	 * Function for the Quotation relation
	 *
	 * @return Relation
	 */
	public function quotations()
	{
		return $this->hasMany('App\Models\Quotation', 'market_launch_id');
	}
}
