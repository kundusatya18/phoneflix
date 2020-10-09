<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

	protected $fillable = [
	   'title', 'description', 'image', 'redirect_link', 'status'
	];
	
	public function category(){
	    return $this->hasOne(Category::class,'id','category_id');
	}
	public function genre(){
	    return $this->hasOne(Genre::class,'id','genre_id');
	}
}
