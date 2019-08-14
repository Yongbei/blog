@extends('layouts.admin')


@section('content')

	@include('includes.msg')

	<h1>Posts</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>photo</th>
				<th>title</th>
				<th>Owner</th>
				<th>category</th>								
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
					<td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
					<td>{{$post->user->name}}</td>
					<td>{{($post->category) ? $post->category->name : 'Uncategorized'}}</td>
					<td>{{$post->created_at->diffForHumans()}}</td>
					<td>{{$post->updated_at->diffForHumans()}}</td>
					<td><a href="{{route('home.post', $post->slug)}}">View</a></td>
					<td><a href="{{route('comments.show', $post->id)}}">comments</a></td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>

	<div class="row">
		<div class="col-sm-6 col-sm-offset-5">
			{{$posts->render()}}
		</div>
	</div>

@endsection