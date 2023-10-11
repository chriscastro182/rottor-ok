<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartStatus extends Model
{
    use HasFactory;

	protected $table = 'cart_status';

	protected $fillable = ['name'];

	/**
	 * Function for the relation of the Cart
	 *
	 * @return Relation
	 */
	public function cart()
	{
		return $this->hasMany('App\Models\Cart', 'cart_status_id');
	}
}
