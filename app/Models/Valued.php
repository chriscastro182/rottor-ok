<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valued extends Model
{
    use HasFactory;

	protected $table = 'valued';

	protected $fillable = ['customer_id', 'product_id', 'import', 'iva', 'total', 'code', 'valued_data'];

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
	 * Function for the relation of the Product
	 *
	 * @return Relation
	 */
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}
}
