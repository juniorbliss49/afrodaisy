@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
			<h2>Contact Us</h2>
			<hr>
		<div class="row">
			<div class="col-lg-6">
				@if(isset($sentmsg))
				<div class="alert alert-success">
  				{{$sentmsg}}
			</div>
				@endif
			</div>
		</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6">
			{{ Form::open(array('url' => 'user/contactus')) }}
		{{ Form::label('Your Name') }}
		{{ Form::text('Name', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		{{ $errors->first('Name', '<p style="color:red;"><i>:message</i></p>') }}
		<br>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
		{{ Form::label('Email Address *') }}
		{{ Form::text('email', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		{{ $errors->first('email', '<p style="color:red;"><i>:message</i></p>') }}
		<br>
						</div>
					</div>
		
		<div class="row">
		<div class="col-lg-7 col-xs-12 col-sm-7">
			{{ Form::label('How can we help you *') }}
		 	{{ Form::textarea('contactus', $value = '', array('class' => 'form-control')) }}
		 	{{ $errors->first('contactus', '<p style="color:red;"><i>:message</i></p>') }}
		 	<br>
		</div>
		</div>
		<br>
		<div class="row">
		<div class="col-lg-1">
			<div class="form-group">
			  {{ Form::submit('SAVE',  $attributes = array('class' => 'btn-col btn btn-primary btn-sm')) }}
			</div>
		</div>
		</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4">
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<h4><span class="glyphicon glyphicon-phone"></span> +234 815 397 2949</h4>
			<h4><span class="glyphicon glyphicon-envelope"></span> info@afrodaisy.com</h4>
		</div>
	</div>
</div>
@stop()
@section('script')

{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop