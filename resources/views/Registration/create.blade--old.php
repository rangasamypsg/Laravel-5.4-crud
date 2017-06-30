@extends('layouts.default')

@section('content')

<?php
 //echo "<pre>";
//print_r($request);
//exit; 
?>

   <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('Register.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
								
								<input type="hidden" id="state_id" name="state_id" value="{{ old('state') }}">
								<input type="hidden" id="city_id" name="city_id" value="{{ old('city') }}">
								
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

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
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

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
									<?php $country = Input::old('country'); ?>
									<select class="form-control" id="country" name="country">
										<option value="">Select Country</option>
										<?php foreach ($countrys as $key=>$country): ?>
										<option value="<?php echo $country->id; ?>" <?php
												if (isset($country) && Input::old('country') == $country->id) {
													echo 'selected="selected"';
												}
												?>><?php echo $country->name; ?></option>
										<?php endforeach; ?>
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
									<?php $sex = Input::old('sex'); ?>
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
                                    <?php $education = Input::old('education'); ?>
									<select class="form-control" id="education" name="education">
										<option value="">Education</option>
										<?php foreach ($educations as $key=>$education): ?>
										<option value="<?php echo $education->id; ?>" <?php
												if (isset($education) && Input::old('education') == $education->id) {
													echo 'selected="selected"';
												}
												?>><?php echo $education->name; ?></option>
										<?php endforeach; ?>
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
									$language_known = Input::old('language_known'); 
									
									//stay the values after form submission
									if($language_known){ $selectLanguages = $language_known; } 
									//echo "<pre>";
									//print_r($language_known); exit;
									
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
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 	@endsection


