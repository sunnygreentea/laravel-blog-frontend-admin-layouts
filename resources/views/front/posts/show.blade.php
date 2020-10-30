@extends('layouts.front')

@section('title')
Post
@endsection

@section('content')
<div class="container mx-5">
	<h1 class="display-4 text-center mb-4">{{$post->title}}</h1>
	
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
			<article>{{$post->body}}</article>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			<h2>Leave Comment</h2>
		</div>
		<div class="col-12">
			@if(Auth::guest())
			<p><a  href="{{ route('register') }}">Login to Comment</a></p>
			@else
			@include('front.posts._inc.editComment')
			@endif
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			<h2>Comments</h2>
		</div>

		@if ($post->comments->count()>0)
		<div class="col-12">
			<ul style="list-style: none; padding: 0">
			@foreach($post->comments as $comment)
				<li class="panel-body">
			        <div class="list-group">
				        <div class="list-group-item">
				          	<h3>{{ $comment->author->name }}</h3>
				          	<p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
				          	<p>{{ $comment->body }}</p>
				        </div>
				        
			        </div>
			    </li>
			@endforeach
			</ul>
		</div>
		@else

		<div class="col-12">
			<p>No comments.</p>
		</div>
		@endif

	</div>

</div>
@endsection