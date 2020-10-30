<form method="POST" action="{{ route('admin.comments.store') }}">
	@csrf

    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="slug" value="{{ $post->slug }}">
    
    <div class="form-group">
      <textarea required="required" placeholder="Enter comment here" name="body" class="form-control"></textarea>
    </div>
    
    <input type="submit" name='add_comment' class="btn btn-success" value="Add Comment" />
</form>