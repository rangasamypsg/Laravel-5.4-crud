@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Register CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('Register.create') }}">Create New Item</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
			<th>Image</th>
            <th width="280px">Action</th>
        </tr>

    @foreach ($registers as $key => $register)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $register->name }}</td>
        <td>{{ $register->email }}</td>
		<td><img src="{{url('/images/'.$register->profile_image)}}" class="img-circle" alt="Image" width="100px" height="100px" /></td>
        <td>
            <a class="btn btn-info" href="{{ route('Register.show',$register->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('Register.edit',$register->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['Register.destroy', $register->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $registers->render() !!}
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<style>
img {
	 box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
.img-circle {
    border-radius: 50%;
}	
</style>	
@endsection