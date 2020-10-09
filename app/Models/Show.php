<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'shows';

	protected $fillable = [
	   'category_id', 'language_id', 'title','slug','description','year_of_release','show_time', 
       'age_group', 'director', 'starrring', 'image1', 'image2', 'video_file', 'status', 'type',
	   'is_top_10', 'is_must_watch', 'is_family','ppc_price','ppc_offeredprice','metakey','metadescription'
	];

	//hasOne relation with Category Model
	public function category(){
	    return $this->hasOne(Category::class, 'id', 'category_id');
	}

	//hasOne relation with Language Model
	public function language(){
	    return $this->hasOne(Language::class, 'id', 'language_id');
	}

	//belongsToMany relation with Genre Model
	public function genres()
	{
    	return $this->belongsToMany(Genre::class);
	}

	protected static function boot(){
        parent::boot();

        static::created(function ($show) {
            $show->update(['slug' => $show->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug)
    {
        // get the slug of the latest created post
        $max = static::whereTitle($this->title)->latest('id')->skip(1)->value('slug');

        if (is_numeric($max[-1])) {
            return preg_replace_callback('/(\d+)$/', function ($mathces) {
                return $mathces[1] + 1;
            }, $max);
        }

        return "{$slug}-2";
    }
}
