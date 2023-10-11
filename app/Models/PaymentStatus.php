<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

	protected $table = 'payment_status';

	protected $fillable = ['name'];

	/**
	 * Function for the relation of the Payment Type
	 *
	 * @return Relation
	 */
	public function payments()
	{
		return $this->hasMany('App\Models\Payment', 'payment_status_id');
	}
}
