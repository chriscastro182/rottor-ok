<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

	protected $table = 'category';

	protected $fillable = ['name', 'description'];

	/**
	 * Function for the relation of the Product
	 *
	 * @return Relation
	 */
	public function products()
	{
		return $this->belongsToMany('App\Models\Product', 'product_has_category', 'category_id', 'product_id');
	}
}
