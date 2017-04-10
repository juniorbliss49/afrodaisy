@extends('layouts.index')

@section('content')
	<div class="row">
			<div class="col-lg-12 col-xs-12 text-center">
				<h2 style="font-family: 'Century Gothic';">REGISTER</h2>
				<hr>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-xs-1"></div>
			<div class="col-lg-6 col-xs-10 text-center signup">
				<br>
				<h2>Sign up with your email</h2>
				<br>
				@if(!empty($errors->first('user_type', ':message')))
				<div class="alert alert-danger" style="padding: 10px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ $errors->first('user_type', '<p><i>:message</i></p>') }}
				</div>
				@endif
				@if(!empty($errors->first('email', ':message')))
				<div class="alert alert-danger" style="padding: 10px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	{{ $errors->first('email', '<p><i>:message</i></p>') }}
				 </div>
				 @endif
				 @if(!empty($errors->first('password', ':message')))
				 <div class="alert alert-danger" style="padding: 10px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  {{ $errors->first('password', '<p><i>:message</i></p>') }}
				  </div>
				 @endif
				<div id="form-main">
				<div class="col-lg-2 col-xs-1">
					
				</div>
				<div class="col-lg-8 col-xs-10 text-center">
				<p>Tell us who you are:</p>
				{{ Form::open(array('url' => 'user/addUser')) }}
				{{ Form::select('user_type', array('' => '--Please select--', 'newFace' => 'New Face (aspiring model)', 'proModel' => 'Professional model', 'photo' => 'Photographer', 'agent'=>'Agency', 'artist' => 'Hair & Make-up Artist', 'fashion' => 'Fashion stylist', 'tattoo'=>'Tattoo Artist', 'others'=>'Others') ,'', $attributes = array('class' => 'sltp form-control')) }}
				<br>
				  <div class="form-group">
				 	{{ Form::email('email', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'placeholder' => 'Email address', 'size' => '30', 'class' => 'seml form-control')) }}
				  </div>
				  <div class="form-group">
				  {{ Form::password('password', $attributes = array('id' => 'exampleInputPassword1', 'placeholder' => 'Password', 'size' => '30', 'class' => 'seml form-control')) }}
				  </div>
				  <div class="form-group">
				  {{ Form::submit('SIGN UP',  $attributes = array('size' => '10', 'class' => 'btn-col btn btn-primary')) }}
				
				  </div>
				  </div>
				<div class="col-lg-2 col-xs-1">
					
				</div>
				  {{ Form::close() }}
			<br>
			</div>			
		</div>
			<div class="col-lg-3 col-xs-1"></div>
	</div>
@stop