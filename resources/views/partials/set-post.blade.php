<form @if(isset($post) action="{{ url('posts')}}/{{$post->id}}" method="put" @else action="{{ route('posts.store')}}" method="post" @endif enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="form-group col-md-12">
			<label>Title</label>
			<input class="form-control" type="text" name="title" @if(isset($post)) value="{{$post->title}}" @endif required>
		</div>
		
		<div class="form-group col-md-12">
			<label>Description</label>
			<textarea class="form-control" name="description" required> @if(isset($post)) {{$post->description}} @endif</textarea>
		</div>
		<div class="form-group col-md-12">
			<label>Featured Image</label>
			<input class="form-control" type="file" name="feature_image" @if(isset($post)) value="{{$post->featured_image}}" @endif>
		</div>
		<div class="form-group col-md-12">
			<button type="submit" class="btn btn-sm btn-success">Create Post</button>
		</div>
	</div>
</form>

