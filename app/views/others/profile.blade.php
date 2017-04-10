@extends('layouts.main')
@section('content')
	
	<div class="col-lg-2">
		<div class="row">
			<a href="">
				@if(isset($user->photoupload->imagename))
					{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '130px')) }}
				@else
					{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
				@endif
			</a>
		</div>
		<div class="row">
			<br>
			
			<ul class="list-profile">
				<a href="#follow" class="follow"><li><span style="float: left; font-size: 12px; padding-right: 4px" class="text-left glyphicon glyphicon-plus"></span> Follow </li></a>
				<a href="#sendmessage" class="msg"><li><span style="float: left; font-size: 12px; padding-right: 4px" class="text-left glyphicon glyphicon-envelope"></span> Send message </li></a>
			</ul>
		</div>
	</div>
	<div class="col-lg-10">
		<div class="row">
			<h3>Welcome {{ $user->others->agentName }}</h3>
			<hr>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<div class="row">
					<div class="col-lg-4">
						<p><b>Location</b></p>
						<p><b>Phone</b></p>
						<p><b>Modile</b></p>
					</div>
					<div class="col-lg-4">
						<p>{{ $user->others->location }}</p>
						<p>{{ $user->others->telephone }}</p>
						<p>{{ $user->others->landline }}</p>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<p><b>About</b></p>
				<p>{{ $user->others->aboutus }}</p>
			</div>
		</div>

		<div class="row">
			
		</div>
	</div>

@stop