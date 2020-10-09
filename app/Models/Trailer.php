<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    protected $table = 'triller';

	protected $fillable = [
	   'movieName', 'image', 'image', 'trailerName', 'is_active'
	];

	public $timestamps = false;
}
