@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<h3>Password Changed Signin to continue... <a href='/signin' class="btn btn-sm" id="dash">
                 <strong>SIGN IN</strong>
                </a></h3>

	</div>
</div>
@stop()
@section('script')

{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop