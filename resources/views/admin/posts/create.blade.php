@extends('layouts.admin')


@section('content')

	@if (Session::has('deleted_user'))
		<p class='bg-danger'>{{session('deleted_user')}}</p>
	@endif

	<h1>Create Post</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
	
		<div class="form-group">
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('category_id', 'Category:') !!}
			{!! Form::select('category_id', [''=>'Choose Options'], null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('photo', 'Photo:') !!}
			{!! Form::file('photo', ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('body', 'Description:') !!}
			{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

	@include('includes.form-error')

@endsection