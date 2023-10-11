<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

	protected $table = 'cart_detail';

	protected $fillable = ['attribute_id', 'product_id', 'cart_id'];

	/**
	 * Function for the relation of the Attribute
	 *
	 * @return Relation
	 */
	public function attribute()
	{
		return $this->belongsTo('App\Models\Attribute', 'attribute_id');
	}

	/**
	 * Function for the relation of the Product
	 *
	 * @return Relation
	 */
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
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
}
