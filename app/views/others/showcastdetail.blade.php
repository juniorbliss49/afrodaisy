@extends('layouts.main')
@section('content')
<br>
<div class="row bdcast">
	<div class="col-lg-6 col-sm-6">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="font-family: verdana">
				<h1>
					@foreach($castdtl as $cast)
					{{ $cast->castTitle }}
					@endforeach
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12">
				<h4><strong><span class="glyphicon glyphicon-map-marker"></strong>
					@foreach($castdtl as $cast)
					{{ $cast->location }} , {{ $cast->country }}
					@endforeach
				</h4>
				<h4>Posted by: <a href="/others/showprofile/{{$user->user_id}}">{{$user->agentName}}</a></h4>
			</div>
		</div>
	</div>
		<div class="col-lg-6 col-sm-6 text-right">
			@foreach($castdtl as $cast)
			@if(!empty($cast->castImage))
				{{ HTML::image($cast->castImage, 'profile picture', array('width' => '260px', 'class' => 'img-responsive text-right')) }}
			@else
				{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '260px', 'class' => 'img-responsive text-right')) }}
			@endif
			@endforeach
		</div>
</div>
<div class="row" style="font-family: verdana">
	<div class="col-lg-7 col-sm-7">
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<input type="hidden" name="cast_id" value="{{$id}}">
				<h4><strong>Description</strong></h4>
				<p>
			@foreach($castdtl as $cast)
			{{ $cast->castDescription }}
			@endforeach
			</p>
				<br>
				<br>
				<h4><strong>Requirements</strong></h4>
				<p>
			@foreach($castdtl as $cast)
			{{ $cast->castRequirement }}
			@endforeach					
				</p>
				<br>
				<div class="col-lg-1 col-sm-1">
				<br>
				<div id="spin"></div>
					
				</div>
				<div class="col-lg-7 col-sm-7 addcast">
				{{$btn}}
				</div>
				<br>		
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<h4><strong>Payment</strong></h4>
			@foreach($castdtl as $cast)
			@if($cast->payType == 'paid')
			<p>{{ $cast->payDesc }}</p>
			@else
			<p>{{ $cast->payType}}</p>
			@endif
			@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<div class="col-lg-6">
				<h4><strong>Cast date</strong></h4>
				<p>{{$datecast}}</p>
				</div>
				<div class="col-lg-6">
				<h4><strong>Casting closes</strong></h4>
				<p>{{$closedate}}</p>
				</div>
			</div>
		</div>		
	</div>
	<div class="col-lg-1 col-sm-1"></div>
	<div class="col-lg-4 col-sm-4">
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<h4><strong>Preferences</strong></h4>
				<h5><strong>Types</strong></h5>
				<p>Professional Models<br>
				New faces models</p>
				<br>
				<h5><strong>Gender</strong></h5>
				@foreach($castdtl as $cast)
				@if($cast->gender == 'both')
				<p>male<br>
				female</p>
				@else
				<p>{{$cast->gender}}</p>
				@endif
				@endforeach
				<br>
				<h5><strong>Cast Category</strong></h5>
				@if(isset($getcat->name))
				<p>{{$getcat->name}}</p>
				@endif
				<br>
			</div>
		</div>	
	</div>
</div>
@stop
@section('script')
{{ HTML::script('js/message.js') }}
@stop