<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

	protected $fillable = [
	   'name', 'desciption','valid_upto','price','offered_price', 'status'
	];

	public $timestamps = false;
}
