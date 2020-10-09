<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

	protected $fillable = [
	   'name', 'slug', 'status','metakey','metadescription'
	];

	//belongsToMany relation with Show Model
	public function shows()
	{
    	return $this->belongsToMany(Show::class);
	}
}
