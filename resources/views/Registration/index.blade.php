@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
		@endif
		<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Register List
					<div class="pull-right">
						<a href="{{ route('Registration.create') }}">Create New Item</a>
					</div>
				</div>
                <div class="panel-body">
					
					{!! Form::open(['method' => 'GET', 'url' => 'registrations', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo(isset($_GET['search']) ? $_GET['search'] : '');?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" style="padding: 6px 6px;">
                                    Search
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
					
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Image</th>
							<th width="280px">Action</th>
						</tr>
					
					@if (count($registrations) > 0)		
						@foreach ($registrations as $key => $registration)
						<tr>
							<td>{{ ++$key }}</td>
							<td>{{ $registration->name }}</td>
							<td>{{ $registration->email }}</td>
							<td><img src="{{url('/images/'.$registration->profile_image)}}" class="img-circle" alt="Image" width="100px" height="100px" /></td>
							<td>
								<a class="btn btn-info" href="{{ route('Registration.show',$registration->id) }}">Show</a>
								<a class="btn btn-primary" href="{{ route('Registration.edit',$registration->id) }}">Edit</a>
								{!! Form::open(['method' => 'DELETE','route' => ['Registration.destroy', $registration->id],'style'=>'display:inline']) !!}
								{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
										'type' => 'submit',
										'class' => 'btn btn-danger',
										'title' => 'Delete Post',
										'onclick'=>'return confirm("Confirm delete?")'
								)) !!}
							   {!! Form::close() !!}					
							</td>
						</tr>
						@endforeach
					@else 
						<tr>
							  <td colspan="5"><center><strong>No Record Found</strong></center></td>
						</tr>
					@endif	
					</table>
					{!! $registrations->render() !!}		
                </div>
            </div>
        </div>
    </div>
</div>

<style>
img {
	 box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
.img-circle {
    border-radius: 50%;
}
</style>

@endsection
