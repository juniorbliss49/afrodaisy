@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
			<h2>Payment successful</h2>
		{{$btnpay}}
			
		</div>
	</div>
</div>
@stop()
@section('script')

{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop