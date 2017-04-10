@extends('layouts.main')

@section('content')
	<div class="container">
		<h2>Messages</h2>
		<hr>
		<br>
		{{$view}}
	</div>
@stop
@section('script')
{{ HTML::script('js/message.js') }}
{{ HTML::script('js/showit.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop