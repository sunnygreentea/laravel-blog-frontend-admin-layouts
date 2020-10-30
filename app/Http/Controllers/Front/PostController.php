<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::where('active',1)->orderBy('created_at','desc')->paginate(5);
    	return view ('front.home', compact('posts'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post) {
            if($post->active == false) {
                return redirect('/')->withErrors('requested page not found');
            }
            //$comments = $post->comments;
            return view('front.posts.show', compact('post'));
        }
        else {
            return redirect('/')->withErrors('requested page not found');
        }
        
    }
}
