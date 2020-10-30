@extends('layouts.admin')

@section('title')
Post
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-6">
			<h1>{{$post->title}}</h1>
			<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
		</div>
		<div class="col-12 col-sm-6">
			@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->isAdmin()))
			<a style="float:right;" href="{{route('admin.posts.edit', $post->id)}}"><button class="btn btn-info" >Edit Post</button></a>
			@endif
		</div>
		<div class="col-12">
			<article>{{$post->body}}
			</article>
		</div>
	</div>


</div>
@endsection