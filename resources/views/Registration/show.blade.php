@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Show Registeration
					<div class="pull-right">
						<a href="{{ route('Registration.index') }}">Back</a>
					</div>
				</div>
                <div class="panel-body">
					 <div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Name : </strong>
								{{ $register->name }}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Email : </strong>
								{{ $register->email }}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Country : </strong>
								{{ $register->country }}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>State : </strong>
								{{ $register->state }}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Sex : </strong>
								{{ $register->sex }}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Education : </strong>
								{{ $register->education }}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Language Known : </strong>
								{{ $register->languages_known }}
							</div>
						</div>	
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Profile Image : </strong>
								<img src="{{url('/images/'.$register->profile_image)}}" class="img-circle" alt="Image" width="100px" height="100px" />
							</div>
						</div>
						
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
