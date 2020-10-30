<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class PostController extends Controller
{
    // All functions apply middleware auth
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::where('author_id', $request->user()->id)->orderBy('created_at','desc')->paginate(5);
        //page heading
        $title = 'All My Posts';
       
        return view('admin.posts.index', compact('posts', 'title'));

    }

    public function activePosts(Request $request) {
        $posts = Post::where('author_id', $request->user()->id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
        //page heading
        $title = 'My Active Posts';
       
        return view('admin.posts.index', compact('posts', 'title'));
    }

    public function draftPosts(Request $request) {
        $posts = Post::where('author_id', $request->user()->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
        //page heading
        $title = 'My Draft Posts';
       
        return view('admin.posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->edit(new Post());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->update($request, new Post());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //print_r($post->toArray());
        if($post) {
            $comments = $post->comments;
            return view('admin.posts.show', compact('post'));
        }
        else {
            $request->session()->flash('error', 'requested page not found');
            return redirect()->route('admin.posts.index');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::allows('canPost')) {
            $title = $post->id ? "Edit post" : "Create post";
            return view('admin.posts.edit', compact('post', 'title'));
        }
        else {
            $request->session()->flash('error', 'You have not sufficient permissions for writing post');
            return redirect()->route('admin.posts.index');
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->author_id = $request->user()->id;

        $post->title =  $request->get('title');
        $post->body = $request->get('body');
        $post->slug = Str::slug($post->title);
        // save draft
        if ($request->has('save')) { 
            $post->active = 0;
            $message = 'Post saved successfully';
        } 
        // publish
        else { 
            $post->active = 1;
            $message = 'Post published successfully';
            
        }

        if( $post->save()) {
            $request->session()->flash('success', $message);
        }       
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
         if ($post && ($post->author_id == $request->user()->id || $request->user()->isAdmin())) {
            $post->delete();
            $message = 'Post deleted Successfully';
            $request->session()->flash('success', $message);
        }
        else {
            $message = 'Invalid Operation. You have not sufficient permissions';
            $request->session()->flash('error', $message);
        }
        return redirect()->route('admin.posts.index');
        
    }
}
