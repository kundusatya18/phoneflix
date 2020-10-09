<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayPerClicks extends Model
{
    protected $table = 'user_pay_per_clicks';

	protected $fillable = [
	   'user_id', 'show_id', 'end_date'
	];

	//hasOne relation with Show Model
	public function show(){
	    return $this->hasOne(Show::class, 'id', 'show_id');
	}

	//hasOne relation with User Model
	public function user(){
	    return $this->hasOne(User::class, 'id', 'user_id');
	}
}