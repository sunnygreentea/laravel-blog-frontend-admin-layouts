<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$posts = Post::where('active',1)->orderBy('created_at','desc')->paginate(5);
        //page heading
        //$title = 'Latest Posts';
       
        //return view('admin.posts.index', compact('posts', 'title'));
        return view('home');
    }
}
