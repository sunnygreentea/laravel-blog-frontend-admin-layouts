<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// Get all comments for one post
	public function comments()
	{
		return $this->hasMany('App\Comment', 'post_id');
	}

	// Get author id
	public function author()
	{
		return $this->belongsTo('App\User', 'author_id');
	}

}
