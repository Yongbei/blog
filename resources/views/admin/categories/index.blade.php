@extends('layouts.admin')


@section('content')

	@include('includes.msg')

	<h1>Categories</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Create</th>
				<th>Update</th>
			</tr>
		</thead>
		<tbody>

			@if($categories)
				@foreach($categories as $category)
				<tr>
					<td>{{$category->id}}</td>
					<td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
					<td>{{$category->created_at->diffForHumans()}}</td>
					<td>{{$category->updated_at->diffForHumans()}}</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>

@endsection