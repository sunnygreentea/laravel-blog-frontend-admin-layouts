@extends('layouts.admin')

@section('title')
	Add New Post
@endsection

@section('content')
<div class="container">
	<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: "textarea",
			plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});
	</script>

	<div class="row justify-content-center">
		<h1>{{$title}}</h1>
		<div class="col-12"></div>
		<div class="col-md-8">
			@if($post->exists)
            <form method="POST" action="{{ route('admin.posts.update',$post->id) }}">
                 @method('PUT') 
        	@else
            <form method="POST" action="{{ route('admin.posts.store') }}">
        	@endif

    			@csrf
    			

	            <div class="form-group row">
	                <input type="text" name="title" class="form-control" value="{{  old('title', $post->title) }}" required="required" placeholder="Enter title here"  />
	            </div>

	            <div class="form-group row">
	               <textarea name='body' class="form-control">{{ old('body', $post->body) }}</textarea>
	            </div>

	            <div class="form-group row mb-0">
	                <input type="submit" name='publish' class="btn btn-success" value="Publish" />
					<input type="submit" name='save' class="btn btn-default" value="Save Draft" />
	            </div>
	        </form>
		</div>
	</div>
</div>
	
	
@endsection