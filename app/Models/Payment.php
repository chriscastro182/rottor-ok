<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

	protected $table = 'payment';

	protected $fillable = ['order_id', 'payment_type_id', 'payment_status_id', 'months', 'amount', 'authorization', 'card_name', 'card_numbers', 'data', 'quantity'];

	/**
	 * Function for the relation of the Order
	 *
	 * @return Relation
	 */
	public function order()
	{
		return $this->belongsTo('App\Models\Order', 'order_id');
	}

	/**
	 * Function for the relation of the Payment Type
	 *
	 * @return Relation
	 */
	public function type()
	{
		return $this->belongsTo('App\Models\PaymentType', 'payment_type_id');
	}

	/**
	 * Function for the relation of the Payment Status
	 *
	 * @return Relation
	 */
	public function status()
	{
		return $this->belongsTo('App\Models\PaymentStatus', 'payment_status_id');
	}
}
