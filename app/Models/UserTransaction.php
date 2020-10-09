<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected $table = 'user_transactions';

	protected $fillable = [
	   'user_id', 'amount', 'transaction_id', 'reason'
	];

	//hasOne relation with User Model
	public function user(){
	    return $this->hasOne(User::class, 'id', 'user_id');
	}
}