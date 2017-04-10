@extends('layouts.index')

@section('content')

			<ol class="bd_fst breadcrumb">
  						<li><a href="/">HOME</a></li>
  						<li><a href="#">ACCOUNT</a></li>
					</ol>

			<ol class="bd_scd breadcrumb">
  						<li>LOGIN</li>
  						<li><a href="/signup">DO NOT HAVE AN ACCOUNT</a></li>
					</ol>
					<br>
		<hr>
		<br>
				{{ Form::open(array('url' => 'user/LoginUser')) }}
				<div id="row text-center">
				<div class="col-lg-3 col-sm-3">
					
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">
				<br>
				@if(!empty($errors->first('email', ':message')))
				<div class="alert alert-danger" style="padding: 10px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	{{ $errors->first('email', '<p><i>:message</i></p>') }}
				 </div>
				 @endif
				 @if(!empty($message))
				<div class="alert alert-danger" style="padding: 10px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	<p><i>{{$message}}</i></p>
				 </div>
				 @endif
				 @if(!empty($errors->first('password', ':message')))
				 <div class="alert alert-danger" style="padding: 10px;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  {{ $errors->first('password', '<p><i>:message</i></p>') }}
				  </div>
				 @endif
				  <div class="form-group">
				  	{{ Form::label('email') }}
				 	{{ Form::email('email', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'placeholder' => 'Email address', 'size' => '30', 'class' => 'form-control')) }}
				  </div>
				  <div class="form-group">
				  {{ Form::label('password') }}
				  {{ Form::password('password', $attributes = array('id' => 'exampleInputPassword1', 'placeholder' => 'Password', 'size' => '30', 'class' => 'form-control')) }}
				  </div>

				  <div class="form-group">
				  {{ Form::submit('SIGN IN',  $attributes = array('size' => '10', 'class' => 'btn-col btn btn-primary btn-lg btn-block')) }}
				
				  </div>
				  <div class="col-lg-12 col-xs-12 text-right">
				  <a href="/forgottenpassword"><i><strong>forgotten password...</strong></i></a>
				  <br>
				  </div>
				  {{ Form::close() }}
			<br>
			</div>
			<div class="col-lg-3 col-sm-3 col-xs-2">
					
				</div>
			</div>
@stop