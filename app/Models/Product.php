<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

	protected $table = 'product';

	protected $fillable = ['brand_id', 'model_id', 'version_id', 'name', 'description', 'price', 'year', 'owners', 'km', 'bill_type', 'sold', 'priority', 'tank_capacity', 'performance', 'gas_cap', 'extras','apartada', 'color'];

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
	 * Function for the relation of the Model
	 *
	 * @return Relation
	 */
	public function model()
	{
		return $this->belongsTo('App\Models\Model', 'model_id');
	}

    /**
     * Function for the relation of the Version
     *
     * @return Relation
     */
    public function version()
    {
        return $this->belongsTo('App\Models\Version', 'version_id');
    }

	/**
	 * Function for the relation of the Attribute
	 *
	 * @return Relation
	 */
	public function attributes()
	{
		return $this->hasMany('App\Models\Attribute', 'product_id');
	}

	/**
	 * Function for the relation of the Details
	 *
	 * @return Relation
	 */
	public function details()
	{
		return $this->hasMany('App\Models\Details', 'product_id');
	}

	/**
	 * Function for the relation of the Cart Details
	 *
	 * @return Relation
	 */
	public function cart_details()
	{
		return $this->hasMany('App\Models\CartDetails', 'product_id');
	}

	/**
	 * Function for the relation of the Valued
	 *
	 * @return Relation
	 */
	public function valued()
	{
		return $this->hasMany('App\Models\Valued', 'product_id');
	}

	/**
	 * Function for the relation of the Favorite
	 *
	 * @return Relation
	 */
	public function favorites()
	{
		return $this->hasMany('App\Models\Favorite', 'product_id');
	}

	/**
	 * Function for the Category relation
	 *
	 * @return Relation
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Models\Category', 'product_has_category', 'product_id', 'category_id');
	}

	/**
	 * Function for the Attachment relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function attachments()
	{
		return $this->belongsToMany('App\Models\Attachment', 'product_has_attachment', 'product_id', 'attachment_id');
	}

    /**
     * Function for the appointment relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function appointments()
    {
        return $this->belongsToMany('App\Models\Appointment', 'appointment_has_product', 'product_id', 'appointment_id');
    }
}
