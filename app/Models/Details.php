<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

	protected $table = 'details';

	protected $fillable = ['order_id', 'product_id', 'attribute_id', 'quantity', 'price', 'tax'];

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
	 * Function for the relation of the Product
	 *
	 * @return Relation
	 */
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}

	/**
	 * Function for the relation of the Attribute
	 *
	 * @return Relation
	 */
	public function attribute()
	{
		return $this->belongsTo('App\Models\Attribute', 'attribute_id');
	}
}
