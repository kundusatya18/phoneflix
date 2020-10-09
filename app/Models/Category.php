<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

	protected $fillable = [
	   'name', 'slug', 'status','metakey','metadescription'
	];

	//hasMany relation with Show Model
	public function shows()
	{
    	return $this->hasMany(Show::class);
	}
}
