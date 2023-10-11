<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

	protected $table = 'order_status';

	protected $fillable = ['name'];

	/**
	 * Function for the relation of the Order
	 *
	 * @return Relation
	 */
	public function order()
	{
		return $this->hasMany('App\Models\Order', 'order_status_id');
	}
}
