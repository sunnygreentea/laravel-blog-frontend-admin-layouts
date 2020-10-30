@extends('layouts.admin')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Dashboard</h1>
        </div>
        <div class="col-12 col-md-2">
            
        </div>

        <div class="col-12 col-md-8">
            <p>Welcome <b class="text-primary">{{$user->name}}</b></p>
            <p>Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}</p>
            <div class="row">
                <div class="col-6">
                    <a href="{{route('admin.posts.create')}}"><button class="btn btn-success mb-3">New Post</button></a>
                </div>

                <div class="col-6">
                    @if( $posts_count)
                    <a href="{{route('admin.posts.index')}}"><button class="btn btn-success mb-3">My Posts</button></a>
                    @endif
                </div>
            </div>

            <h2> My Posts</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="30%">posts</th>
                        <th scope="col" width="30%">number</th>
                        <th scope="col" width="30%">link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Posts</td>
                        <td>{{$posts_count}}</td>
                        <td>@if( $posts_count)<a href="{{route('admin.posts.index')}}">Show all</a>@endif</td>
                    </tr>
                    <tr>
                        <td>Published Posts</td>
                        <td>{{$posts_active_count}}</td>
                        <td>@if( $posts_active_count)<a href="{{route('admin.activeposts')}}">Show all</a>@endif</td>
                    </tr>
                    <tr>
                        <td>Posts in Draft</td>
                        <td>{{$posts_draft_count}}</td>
                        <td>@if( $posts_draft_count)<a href="{{route('admin.draftposts')}}">Show all</a>@endif</td>
                    </tr>
                </tbody>
            </table>

            <h2>My Comments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="30%">comments</th>
                        <th scope="col" width="30%">number</th>
                        <th scope="col" width="30%">link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Comments</td>
                        <td>{{$comments_count}}</td>
                        <td>@if( $comments_count)<a href="">Show all</a>@endif</td>
                    </tr>
                </tbody>
            </table>

            <h3>My Latest Posts</h3>
            @if(!empty($latest_posts[0]))
            @foreach($latest_posts as $post)
            <p>
                <strong><a href="{{ route('admin.posts.show',$post->id) }}">{{ $post->title }}</a></strong>
                <span class="well-sm">On {{ $post->created_at->format('M d,Y \a\t h:i a') }}</span>
            </p>
            @endforeach
            @else
            <p>You have not written any post till now.</p>
            @endif

            <h3>My Comments </h3>

            @if(!empty($latest_comments[0]))
            @foreach($latest_comments as $comment)
                  <p>{{ $comment->body }}</p>
                  <p>On {{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                  <p>On post <a href="{{ route('front.posts.show',$comment->post->id) }}">{{ $comment->post->title }}</a></p>
            @endforeach
            @else
                <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
            @endif
        </div>

    </div>
</div>
@endsection
