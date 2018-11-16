@extends('layouts.admin')


@section('content')	
	@include('includes.ckeditor')

	<h1>Create Post</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
	
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
			{!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

	@include('includes.form-error')
	

@endsection

@section('scripts')
	<script>
		CKEDITOR.replace('editor', options);
	</script>
@endsection

