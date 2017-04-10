@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-4 col-sm-2"></div>
		<div class="col-lg-5 col-sm-6 col-xs-12 text-left">
		<br>
		<br>
		<br>
			<p><strong>Reset your password.</strong></p>
			{{ Form::open(array('url' => 'user/resetpassword')) }}
			{{ Form::label('Password') }}
			{{ Form::password('password', $value = null, $attributes = array('class' => 'form-control text-input', 'placeholder' => 'Email')) }}
			<br>
			<input type="hidden" name="id" value={{$id}}>
			<input type="hidden" name="code" value="{{$code}}">
			<br>
			{{ Form::label('Retype Password') }}
			{{ Form::password('retype', $value = null, $attributes = array('class' => 'form-control text-input', 'placeholder' => 'Email')) }}	
				<br>
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