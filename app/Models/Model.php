<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasFactory;

	protected $table = 'model';

	protected $fillable = ['brand_id', 'description'];

	/**
	 * Function for the relation of the Brand
	 *
	 * @return Relation
	 */
	public function brand()
	{
		return $this->belongsTo('App\Models\Brand', 'brand_id');
	}

	/**
	 * Function for the relation of the Product
	 *
	 * @return Relation
	 */
	public function products()
	{
		return $this->hasMany('App\Models\Product', 'model_id');
	}

	/**
	 * Function for the relation of the Market Launch
	 *
	 * @return Relation
	 */
	public function market_launches()
	{
		return $this->hasMany('App\Models\MarketLaunch', 'model_id');
	}

    /**
     * Function tfor the relation with the Version
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function version()
    {
        return $this->hasMany('App\Models\Version', 'model_id');
    }
}
