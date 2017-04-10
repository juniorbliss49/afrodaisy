@extends('layouts.main')
@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<h3>Cast Search</h3>
								<h4>All Jobs Here are Verified by Afrodaisy Team</h4>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5 col-sm-5 col-xs-12">
								<br>
		                        <select class="sltp state">
		                        	<option value="all">Sort By Location</option>
		                        	@foreach($getstate as $state)
										<option value="{{$state->location}}">{{$state->location}}</option>
									@endforeach
		                        </select>			
		</div>
		<div class="col-lg-5 col-sm-5 col-xs-12">
		<br>
			<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-9">
						<input type="text" class="form-control" class="search" name="search" style="border-radius: 3px; border: none; border: 1px solid #999; padding: 5px" placeholder="search by cast id">								
							</div>
							<div class="col-lg-2 col-sm-2 col-xs-2 text-left">
						<button class="btn btn-default searchval">Search</button>								
							</div>
			</div>
		</div>
	</div>
	<br>
    <hr>
	<div class="row">
		<div id="data">
			<ul class='paginate' style='list-style-type:none'>
			{{$values}}
			</ul>
		</div>
	</div>
</div>
@stop

@section('script')
{{ HTML::script('js/showcast.js') }}
@stop