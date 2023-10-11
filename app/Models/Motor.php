<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
	protected $table = 'motor';

	protected $fillable = ['min_cc', 'max_cc'];

	/**
	 * Function for the Factor relation
	 *
	 * @see App\Models\Factor
	 * @return Relation
	 */
	public function factors()
	{
		return $this->hasMany('App\Models\Factor', 'motor_id');
	}
}
