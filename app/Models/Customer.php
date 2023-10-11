<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
	use HasApiTokens;

	protected $table = 'customer';

	protected $fillable = ['name', 'lastname', 'email', 'password', 'cellphone', 'phone', 'gender', 'birth_date', 'ip', 'last_access'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	/**
	 * Function for messages relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function messages()
	{
		return $this->hasMany('App\Models\Message', 'customer_id');
	}

	/**
	 * Function for the relation of the Favorite
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function favorites()
	{
		return $this->hasMany('App\Models\Favorite', 'customer_id');
	}

	/**
	 * Function for the relation of the Valued
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function valued()
	{
		return $this->hasMany('App\Models\Valued', 'customer_id');
	}

	/**
	 * Function for the relation of the Appointment
	 *
	 * @return Relation
	 */
	public function appointments()
	{
		return $this->hasMany('App\Models\Appointment', 'customer_id');
	}

	/**
	 * Function for the Cart relation
	 *
	 * @return Relation
	 */
	public function carts()
	{
		return $this->belongsToMany('App\Models\Cart', 'cart_has_customer', 'customer_id', 'cart_id');
	}

	/**
	 * Function for the Order relation
	 *
	 * @return Relation
	 */
	public function orders()
	{
		return $this->hasMany('App\Models\Order', 'customer_id');
	}

    public function customMarkets()
    {
        return $this->belongsToMany(CustomMarket::class, 'customer_has_custom_market', 'customer_id', 'custom_market_id');
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->lastname;
    }
}
