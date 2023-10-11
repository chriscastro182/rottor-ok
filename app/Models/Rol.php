<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Rol extends Model
{
	protected $table = 'role';

	protected $fillable = ['name'];

	public function users()
	{
		return $this->belongsToMany('App\User', 'user_has_role', 'role_id', 'user_id');
	}
}
