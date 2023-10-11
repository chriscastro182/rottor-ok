<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Km extends Model
{
	protected $table = 'km';

	protected $fillable = ['min_km', 'max_km'];

	/**
	 * Function for the Factor relation
	 *
	 * @see App\Models\Factor
	 * @return Relation
	 */
	public function factors()
	{
		return $this->hasMany('App\Models\Factor', 'km_id');
	}
	
}
