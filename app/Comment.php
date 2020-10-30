<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	// Get author of a comment
    public function author () 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    // Get post for a comment
    public function post() {
    	return $this->belongsTo('App\Post', 'post_id');
    }
}
