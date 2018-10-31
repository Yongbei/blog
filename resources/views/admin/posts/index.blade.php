@extends('layouts.admin')


@section('content')

	@if (Session::has('deleted_post'))
		<p class='bg-danger'>{{session('deleted_user')}}</p>
	@endif

	<h1>Posts</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>photo</th>
				<th>Owner</th>
				<th>category</th>				
				<th>title</th>
				<th>body</th>
				<th>Create</th>
				<th>Update</th>
			</tr>
		</thead>
		<tbody>

			@if($posts)
				@foreach($posts as $post)
				<tr>
					<td>{{$post->id}}</td>
					<td><img height="50" src="{{($post->photo) ? $post->photo->name : 'https://via.placeholder.com/50'}}"></td>
					<td>{{$post->user->name}}</td>
					<td>{{$post->category_id}}</td>
					<td>{{$post->title}}</td>
					<td>{{$post->body}}</td>
					<td>{{$post->created_at->diffForHumans()}}</td>
					<td>{{$post->updated_at->diffForHumans()}}</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>

@endsection