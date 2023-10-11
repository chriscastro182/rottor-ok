<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

	protected $table = 'attachment';

	protected $fillable = ['name', 'folder', 'mime', 'url'];

	/**
	 * Function for the Product relation
	 *
	 * @return Relation
	 */
	public function products()
	{
		return $this->belongsToMany('App\Models\Product', 'product_has_attachment', 'attachment_id', 'product_id');
	}

    /**
     * Function for the Brand relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand', 'brand_has_attachment', 'attachment_id', 'brand_id');
    }
}
