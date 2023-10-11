<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

	protected $table = 'order';

	protected $fillable = ['order_status_id', 'customer_id', 'cart_id', 'import', 'iva', 'total', 'code'];

	/**
	 * Function for the relation of the OrderStatus
	 *
	 * @return Relation
	 */
	public function status()
	{
		return $this->belongsTo('App\Models\OrderStatus', 'order_status_id');
	}

	/**
	 * Function for the relation of the Cart
	 *
	 * @return Relation
	 */
	public function cart()
	{
		return $this->belongsTo('App\Models\Cart', 'cart_id');
	}

	/**
	 * Function for the relation of the Customer
	 *
	 * @return Relation
	 */
	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id');
	}

	/**
	 * Function for the relation of the Details
	 *
	 * @return Relation
	 */
	public function details()
	{
		return $this->hasMany('App\Models\Details', 'order_id');
	}

	/**
	 * Function for the relation of the Payment
	 *
	 * @return Relation
	 */
	public function payments()
	{
		return $this->hasMany('App\Models\Payment', 'order_id');
	}

	/**
	 * Function for the Appointment relation
	 *
	 * @return Relation
	 */
	public function appointments()
	{
		return $this->belongsToMany('App\Models\Appointment', 'appointment_has_order', 'order_id', 'appointment_id');
	}
}
