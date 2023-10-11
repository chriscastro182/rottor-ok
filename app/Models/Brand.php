<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

	protected $table = 'brand';

	protected $fillable = ['name', 'description'];

	/**
	 * Function for the relation of the Product
	 *
	 * @return Relation
	 */
	public function products()
	{
		return $this->hasMany('App\Models\Product', 'brand_id');
	}

	/**
	 * Function for the relation of the Model
	 *
	 * @return Relation
	 */
	public function models()
	{
		return $this->hasMany('App\Models\Model', 'brand_id');
	}

	/**
	 * Function for the relation of the Market Launch
	 *
	 * @return Relation
	 */
	public function market_launches()
	{
		return $this->hasMany('App\Models\MarketLaunch', 'brand_id');
	}

    /**
     * Function for the relation of the attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attachments()
    {
        return $this->belongsToMany('App\Models\Attachment', 'brand_has_attachment', 'brand_id', 'attachment_id');
    }
}
