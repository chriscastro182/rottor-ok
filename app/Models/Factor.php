<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Motor;
use App\Models\Km;

class Factor extends Model
{
	protected $table = 'factor';

	protected $fillable = ['km_id', 'motor_id', 'year', 'percentage'];

	/**
	 * Function for the Motor relation
	 *
	 * @see App\Models\Motor
	 * @return Relation
	 */
	public function motor()
	{
		return $this->belongsTo(Motor::class, 'motor_id');
	}
	
	/**
	 * Function for the Km relation
	 *
	 * @return Relation
	 */
	public function km()
	{
		return $this->belongsTo(Km::class, 'km_id');
	}
	
}
