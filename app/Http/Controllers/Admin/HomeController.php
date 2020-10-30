<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class HomeController extends Controller
{
	public function index(Request $request)
    {
    	$data = array();
    	$data['user'] = $request->user();
    	
	    $data['posts_count'] = $data['user']->posts->count();
	    $data['posts_active_count'] = $data['user']->posts->where('active', 1)->count();
	    $data['posts_draft_count'] = $data['user']->posts->where('active', 0)->count();
	    $data['latest_posts'] = $data['user']->posts->where('active', 1)->take(5);

	    $data['comments_count'] = $data['user']->comments->count();
	    $data['latest_comments'] = $data['user']->comments->take(5);

    	
	    
	    return view('admin.home', $data);
	   
	}
}
