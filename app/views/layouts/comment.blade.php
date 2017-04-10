@extends('layouts.main')
@section('content')

<div class="col-lg-8">
	<div class="row">
		<h3>Followers Update</h3>
		<hr>
	</div>
	
	<div class="row">
		{{$value}}
		{{$value3}}
		<br>
		<br>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<h4>Latest Updates</h4>
				</div>
				<div class="col-lg-6 text-right">
					<a href="">View more news</a>
				</div>
			</div>
			<br>
		</div>

		{{$value2}}
	</div>
</div>

@stop
@section('script')
{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop