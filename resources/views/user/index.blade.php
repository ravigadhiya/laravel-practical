@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User List | <a href="{!! url('/user/add') !!}">Add New</a>
				</div>
				
				@if(count($users))
					<div class="panel-body">
				<table width="100%" border="1">
					<thead>
						<tr>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Email</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							
							<tr>
								<td>{!!$user->first_name!!}</td>
								<td>{!!$user->last_name!!}</td>
								<td>{!!$user->email!!}</td>
								<td> 
									@if(isset($user->image) && !empty($user->image))
										<img src="/uploads/user/{{$user->image}}" width="50%">
									@endif
								</td>
								<td><a href="{!! url('/user/edit/') !!}/{!!$user->id!!}">Edit</a> | <a href="{!! url('/user/delete/') !!}/{!!$user->id!!}">Delete</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
                </div>
				@endif
            </div>
        </div>
    </div>
</div>
@endsection