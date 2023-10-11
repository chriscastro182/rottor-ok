<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

	protected $table = 'cart';

	protected $fillable = ['ip', 'import', 'iva', 'total', 'user_agent', 'cart_status_id'];

	/**
	 * Function for the relation of the Cart Status
	 *
	 * @return Relation
	 */
	public function cart_status()
	{
		return $this->belongsTo('App\Models\CartStatus', 'cart_status_id');
	}

	/**
	 * Function for the Customer relation
	 *
	 * @return Relation
	 */
	public function customers()
	{
		return $this->belongsToMany('App\Models\Customer', 'cart_has_customer', 'cart_id', 'customer_id');
	}

	/**
	 * Function for the relation of the Cart Detail
	 *
	 * @return Relation
	 */
	public function cart_details()
	{
		return $this->hasMany('App\Models\CartDetail', 'cart_id');
	}
}
