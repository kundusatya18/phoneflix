<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episode';

	protected $fillable = [
	   'name', 'image', 'video','showId','description','showtime','type', 'is_active'
	];

	public $timestamps = false;

	//hasOne relation with Show Model
	public function category(){
	    return $this->hasOne(Show::class, 'id', 'showId');
	}
}
