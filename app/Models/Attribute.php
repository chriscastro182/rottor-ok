<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

	const CREATED_AT = '';

	protected $table = 'attribute';

	protected $fillable = ['product_id', 'key', 'value'];

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
	 * Function for the relation of the Details
	 *
	 * @return Relation
	 */
	public function details()
	{
		return $this->hasMany('App\Models\Details', 'attribute_id');
	}

	/**
	 * Function for the relation of the Cart Details
	 *
	 * @return Relation
	 */
	public function cart_details()
	{
		return $this->hasMany('App\Models\Details', 'attribute_id');
	}
}
