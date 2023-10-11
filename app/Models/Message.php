<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Message extends Model
{
	protected $table = 'message';

	protected $fillable = ['customer_id', 'subject', 'message'];

	/**
	 * Function for customer relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function customer()
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}

}
