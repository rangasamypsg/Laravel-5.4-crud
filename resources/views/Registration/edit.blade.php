@extends('layouts.app')

@section('content')

<?php
/* echo "<pre>";
print_r($register);
exit; */ 
?>
   <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        
						<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('Registration.update', $register->id) }}">
						
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label" >Name</label>
                                <div class="col-md-6">
								   <input type="hidden" id="id" name="id" value="<?php echo $register->id ?>">
								   <input type="hidden" id="state_id" name="state_id" value="{{ old('state_id',  isset($register->state) ? $register->state : null) }}">
								   <input type="hidden" id="city_id" name="city_id" value="{{ old('city_id',  isset($register->city) ? $register->city : null) }}">
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name',  isset($register->name) ? $register->name : null) }}">
									
									@if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif									
									
                                </div>
                            </div>
							
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                   <input id="email" type="text" class="form-control" name="email" value="{{ old('email',  isset($register->email) ? $register->email : null) }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							
							<div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                                <label for="profile_image" class="col-md-4 control-label">Profile Image</label>

                                <div class="col-md-6">
                                    <input id="profile_image" type="file" class="form-control" name="profile_image">
                                    @if ($errors->has('profile_image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country" class="col-md-4 control-label">Country</label>
                                <div class="col-md-6">                                
									<select class="form-control" id="country" name="country">
										@foreach($countrys as $type =>$country)
											@if(old('country',$register->country) == $country->id )
												 <option value="{{ $country->id }}" selected >{{ $country->name }}</option>
											@else
												 <option value="{{ $country->id }}">{{ $country->name }}</option>
											@endif
										@endforeach 
									</select>

                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							
							<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-4 control-label">State</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="state" name="state">									
									</select>
                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							
							<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">City</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="city" name="city">									
									</select>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							
							<div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                <label for="sex" class="col-md-4 control-label">Sex</label>

                                <div class="col-md-6">
									<?php $sex = (!empty( Input::get('sex') ) ? Input::get('sex') : $register->sex ); ?>
                                    <input type="radio" name="sex" value="male" <?php echo (isset($sex) && ($sex == "male") ? 'checked' : ''); ?> /> Male <br/>
									<input type="radio" name="sex" value="female" <?php echo (isset($sex) && ($sex == "female") ? 'checked' : ''); ?> /> Female <br/>
                                    @if ($errors->has('sex'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sex') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							
							<div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">
                                <label for="education" class="col-md-4 control-label">Education</label>

                                <div class="col-md-6">
                                  <select class="form-control" id="education" name="education">
										@foreach($educations as $type =>$education)
											@if(old('education',$register->education) == $education->id )
												 <option value="{{ $education->id }}" selected >{{ $education->name }}</option>
											@else
												 <option value="{{ $education->id }}">{{ $education->name }}</option>
											@endif
										@endforeach 
									</select>								

                                    @if ($errors->has('education'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('education') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

							<div class="form-group{{ $errors->has('language_known') ? ' has-error' : '' }}">
                                <label for="language_known" class="col-md-4 control-label">Language Known</label>
								
								<div class="col-md-6">
                                    <?php 
									$selectLanguages = array();
									$selectLanguages = (!empty( Input::get('language_known') ) ? Input::get('language_known') : explode(",",$register->languages_known) ); 
									?>
									<select class="form-control" id="language_known" name="language_known[]" multiple="multiple">
										<?php foreach ($language_knowns as $key=>$language_known): ?>
										<option value="<?php echo $language_known->id; ?>" <?php echo in_array($language_known->id,$selectLanguages) ?"selected" :"" ;?> ><?php echo $language_known->name; ?></option>
										<?php endforeach; ?>
									</select>
									 
                                    @if ($errors->has('language_known'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('language_known') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>		
							
                            <div class="form-group">
							
                                <div class="col-md-6 col-md-offset-4">
                                    {{ Form::submit('Edit the Register!', array('class' => 'btn btn-primary')) }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
@endsection
