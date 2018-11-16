@extends('layouts.admin')

@section('content')

	@if (Session::has('category_msg'))
		<p class='bg-danger'>{{session('category_msg')}}</p>
	@endif

	<h1>Medias</h1>
	
	{!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@deleteMedia', 'class'=>'form-inline']) !!}
		<div class="form-group">
			{!! Form::select('selectAction', ['delete'=>'Delete'], null ,['placeholder'=>'Select a Action...', 'class'=>'form-control']) !!}
		</div>
		{!! Form::submit('Submit', ['class'=>'btn btn-danger']) !!}

		<table class="table">
			<thead>
				<tr>
					<th>{!! Form::checkbox('selectAllChk', null, null, ['id'=>'selectAllChk']) !!}</th>
					<th>Id</th>
					<th>Name</th>
					<th>Photo</th>
					<th>Create</th>
					<th>Update</th>
				</tr>
			</thead>
			<tbody>

				@if($photos)
					@foreach($photos as $photo)
					<tr>
						<td>{!! Form::checkbox('chkAry[]', $photo->id, null, ['class'=>'selectChks']) !!}</td>
						<td>{{$photo->id}}</td>
						<td><a href="{{--route('photos.edit', $photo->id)--}}">{{$photo->name}}</a></td>
						<td><img height='70' src="{{$photo->name}}" alt=""></td>
						<td>{{$photo->created_at->diffForHumans()}}</td>
						<td>{{$photo->updated_at->diffForHumans()}}</td>
					</tr>
					@endforeach
				@endif

			</tbody>
		</table>

	{!! Form::close() !!}

	<div class="row">
		<div class="col-sm-6 col-sm-offset-5">
			{{$photos->render()}}
		</div>
	</div>

@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
			$('#selectAllChk').click(function(){
				$('.selectChks').prop('checked', this.checked);
			})				
		})
	</script>
@endsection