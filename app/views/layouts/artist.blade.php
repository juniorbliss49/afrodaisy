@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<h3 style="font-family: 'Century Gothic';">Find the best hair and make-up artist</h3>
                <hr>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-sm-3 col-xs-12">
		<input type="hidden" name="" class="type" value="artist">
								<br>
		                        <select class="sltp selcountry">
		                        	<option>Select a country</option>
		                        	@foreach($getcountry as $country)
										<option value="{{$country->country}}">{{$country->country}}</option>
									@endforeach
		                        </select>	
		                        
		                        <br>		
		</div>
		<div class="col-lg-2 col-sm-2 col-xs-12">
								<br>
		                        <select class="sltp selcity">
		                        	<option>Select a city</option>
		                        </select>	
		                        
		                        <br>		
		</div>
		<div class="col-lg-3 col-sm-3 col-xs-12">
			<br>
			<button class="btn btn-md btn-primary searchresult">Search</button>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="container">
			<div class="col-lg-12 showresult">
			{{$view}}
				
			</div>
			
		</div>
	</div>
</div>
@stop()
@section('script')

{{ HTML::script('js/message.js') }}
@stop