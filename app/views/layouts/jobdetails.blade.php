
@extends('layouts.main')
@section('content')
<br>
<div class="row bdcast">
	<div class="col-lg-6 col-sm-6">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="font-family: verdana">
				<h1>
					@foreach($castdtl as $cast)
					{{ $cast->title }}
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
			</div>
		</div>
	</div>
		<div class="col-lg-6 col-sm-6 text-right">
		
				{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '260px', 'class' => 'img-responsive text-right')) }}
		</div>
</div>
<div class="row" style="font-family: verdana">
	<div class="col-lg-7 col-sm-7">
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<input type="hidden" name="cast_id" value="{{$id}}">
				<h4><strong>Contract Description</strong></h4>
				<p>
			@foreach($castdtl as $cast)
			{{ $cast->job_description }}
			@endforeach
			</p>
				<br>
				<br>
				<h4><strong>Contract Task</strong></h4>
				<p>
			@foreach($castdtl as $cast)
			{{ $cast->job_task }}
			@endforeach					
				</p>
				<br>
				<div class="col-lg-1 col-sm-1">
				<br>
				<div id="spin"></div>
					
				</div>
				<div class="col-lg-5 col-sm-5 addcast">
				{{$btn}}
				</div>
				<br>		
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<h4><strong>Payment</strong></h4>
			
			<p><img src='/img/nigeria-naira-currency-symbol.png' class='img-responsive' style='width: 20px; float: left;'> {{ number_format($cast->amount)}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 bdcast">
				<div class="col-lg-6">
				<h4><strong>Contract date</strong></h4>
				<p>{{$datecast}}</p>
				</div>
				<div class="col-lg-6">
				<h4><strong>Contract closes</strong></h4>
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
				
				<h5><strong>Professional</strong></h5>
				
				<p>{{$cast->user_spec}}</p>
				<br>
			</div>
		</div>	
	</div>
</div>
@stop
@section('script')
{{ HTML::script('js/message.js') }}
@stop