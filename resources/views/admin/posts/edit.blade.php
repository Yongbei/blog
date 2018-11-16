@extends('layouts.admin')


@section('content')
	@include('includes.ckeditor')

	<h1>Edit Post</h1>

	<div class="col-sm-3">
		<img src="{{($post->photo) ? $post->photo->name : 'https://via.placeholder.com/400x400'}}" alt="" class="img-responsive img-rounded">
	</div>

	<div class="col-sm-9">
		{!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
		
			<div class="form-group">
				{!! Form::label('title', 'Title:') !!}
				{!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('category_id', 'Category:') !!}
				{!! Form::select('category_id', [''=>'Choose Categories'] + $categories, null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('photo', 'Photo:') !!}
				{!! Form::file('photo', ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('body', 'Description:') !!}
				{!! Form::textarea('body', null, ['id'=>'editor', 'class'=>'form-control', 'rows'=>3]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
			</div>

		{!! Form::close() !!}

		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
			<div class="form-group">
				{!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
			</div>
		{!! Form::close() !!}

		@include('includes.form-error')
	</div>
	

@endsection


@section('scripts')
	<script>
		CKEDITOR.replace('editor', options);
	</script>
@endsection
