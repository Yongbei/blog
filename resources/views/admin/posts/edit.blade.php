@extends('layouts.admin')


@section('content')

	@if (Session::has('deleted_user'))
		<p class='bg-danger'>{{session('deleted_user')}}</p>
	@endif

	<h1>Edit Post</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Photo</th>
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th>Create</th>
				<th>Update</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>

@endsection