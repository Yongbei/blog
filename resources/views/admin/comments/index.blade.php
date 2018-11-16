@extends('layouts.admin')

@section('content')
	<h1>Comments</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Author</th>
				<th>Post</th>
				<th>Status</th>
				<th>Body</th>
				<th>Replies</th>
				<th>Create</th>
				<th>Update</th>
			</tr>
		</thead>
		<tbody>
			@if($comments)
				@foreach($comments as $comment)
				<tr>
					<td>{{$comment->id}}</td>
					<td>{{$comment->user->name}}</td>
					<td><a href="{{route('home.post', $comment->post_id)}}">{{$comment->post->title}}</a></td>
					<td>{{($comment->is_active) ? "Approved" : "Unapproved"}}</td>
					<td>{{$comment->body}}</td>
					<td><a href="{{route('replies.show', $comment->id)}}">View Replies</a></td>
					<td>{{$comment->created_at->diffForHumans()}}</td>
					<td>{{$comment->updated_at->diffForHumans()}}</td>
					<td>
						@if($comment->is_active)

					        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

								{!! Form::hidden('is_active', 0) !!}

								{!! Form::submit('Unapprove', ['class'=>'btn btn-info']) !!}

					        {!! Form::close() !!}							
						@else

							{!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

								{!! Form::hidden('is_active', 1) !!}

								{!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}

					        {!! Form::close() !!}

						@endif
					</td>
					<td>
						{!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

							{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

				        {!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection