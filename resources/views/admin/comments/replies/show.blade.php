@extends('layouts.admin')

@section('content')
	<h1>Replies</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Author</th>
				<th>Post</th>
				<th>Status</th>
				<th>Body</th>
				<th>Create</th>
				<th>Update</th>
			</tr>
		</thead>
		<tbody>
			@if($replies)
				@foreach($replies as $reply)
				<tr>
					<td>{{$reply->id}}</td>
					<td>{{$reply->user->name}}</td>
					<td><a href="{{route('home.post', $reply->comment->post_id)}}">{{$reply->comment->post->title}}</a></td>
					<td>{{($reply->is_active) ? "Approved" : "Unapproved"}}</td>
					<td>{{$reply->body}}</td>
					<td>{{$reply->created_at->diffForHumans()}}</td>
					<td>{{$reply->updated_at->diffForHumans()}}</td>
					<td>
						@if($reply->is_active)

					        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

								{!! Form::hidden('is_active', 0) !!}

								{!! Form::submit('Unapprove', ['class'=>'btn btn-info']) !!}

					        {!! Form::close() !!}							
						@else

							{!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

								{!! Form::hidden('is_active', 1) !!}

								{!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}

					        {!! Form::close() !!}

						@endif
					</td>
					<td>
						{!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}

							{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

				        {!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection