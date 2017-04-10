@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-4 col-sm-4"></div>
		<div class="col-lg-4 col-sm-4 col-xs-12 text-center">
		<br>
		<br>
		<br>
			<p><strong>Enter your email and we’ll send you instructions to reset your password.</strong></p>
			{{ Form::open(array('url' => 'user/resetemail')) }}
			{{ Form::email('email', $value = null, $attributes = array('class' => 'form-control text-input', 'placeholder' => 'Email')) }}	
				<br>
				  {{ Form::submit('SIGN IN',  $attributes = array('size' => '10', 'class' => 'btn btn-sm btn-primary btn-lg btn-block')) }}
			
			{{ Form::close() }}
		</div>
		<div class="col-lg-4 col-sm-4"></div>
	</div>
</div>
@stop()
@section('script')

{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop