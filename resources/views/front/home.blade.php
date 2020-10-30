@extends('layouts.front')
@section('content')
<div class="my-3">
    <h1 class="display-1 text-center text-primary">Blog Project</h1>
</div>

<div class="my-2">
    <h2 class="display-4 text-center text-secondary ">Recent Blogs</h2>
</div>

@include('front.posts.index', ['posts'=>$posts])

@endsection