<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $table = 'version';

    protected $fillable = ['model_id', 'name', 'year'];

    /**
     * Function for the relationship with the model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo('App\Models\Model', 'model_id');
    }
}
