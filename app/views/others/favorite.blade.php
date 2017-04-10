@extends('layouts.main')

@section('content')
<style type="text/css">
	.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}
</style>

<div class="col-lg-2 col-sm-2">
				<div class="row">
					<a href="">
					@if(isset($user->photoupload->imagename))
						{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
					@else
						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
					@endif

					
					</a>
				</div>
				<nav class="navbar">
				<div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#shownav" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="menushow">MENU</span> 
			      </button>
			          
			    </div>
			    <div class="collapse navbar-collapse" id="shownav">
				<div class="row">
					<br>
					<p><strong>Profile</strong></p>
					
					<ul class="list-profile">
						<a href="/others/dashboard"><li>Dashboard<span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/showprofile/{{$user->id}}"><li>View Profile<span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/edit"><li>Edit Profile <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My castings</strong></p>
					
					<ul class="list-profile">
						<a href="/others/castlisting"><li>Cast listing<span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/newcasting"><li>Create new cast <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My Contracts</strong></p>
					
					<ul class="list-profile">
						<a href="/others/joblisting"><li>Contract listing <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/newjob"><li>Create new Contract <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/jobinvitation"><li>Contract Applied<span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My messages</strong></p>
					
					<ul class="list-profile">
						<a href="/users/mymessage"><li>messages <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My models</strong></p>
					
					<ul class="list-profile">
						<a href="/users/mymodels"><li>Models <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/users/favorite"><li>Favorite Models <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>Market Place</strong></p>
					
					<ul class="list-profile">
						<a href="/others/servicemktplace"><li>Services <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/coursespage"><li>Courses <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/others/getphotosession"><li>Photosession <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
			</div>
				</nav>
				</div>
			<div class="col-lg-10 col-sm-10 dash-bd">
					<div class="row">
						<h3>Favourite Models</h3>
						<hr>
					</div>
					<div class="row">


    		{{$views}}
    </div>
	</div>

<div class="showbook">
	
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Unfollow models</h4>
      </div>
      <div class="modal-body">
      	<div id="castapplyview">
		    				
		 </div>
      		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cast</h4>
      </div>
      <div class="modal-body">
      	<div id="castapplyviews">
		    				
		 </div>
      		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3>Book Model</h3>
      </div>
      	 <div class="modal-body">
      <form class="form">
			<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Title of casting') }}
		 	{{ Form::text('title', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('title', '<p class="error">:message</p>') }}
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-12">
			{{ Form::label('Casting Description(Email addresses are not permitted in the description)') }}
		 	{{ Form::textarea('casting', $value = null, array('class'=>'form-control')) }}
		</div>
		</div>
	</div>

	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			<p>{{ Form::radio('paymethod', 'paid') }} Paid</p>
			{{ $errors->first('paymethod', '<p class="error">:message</p>') }}
		</div>
		<div class="col-lg-4">
			<p>{{ Form::radio('paymethod', 'tfp') }} TFP(Trade for Print)</p>
		</div>
		<div class="col-lg-4">
			<p>{{ Form::radio('paymethod', 'Other') }} Other</p>
		</div>
		</div>
		<div class="row">
			<div class="col-lg-5">
			{{ Form::text('paydetail', $value = null, $attributes = array('placeholder' => 'Payment details', 'id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control'))}}
			{{ $errors->first('paydetail', '<p class="error">:message</p>') }}
			</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
	<div class="col-lg-5">
		{{ Form::label('Enter your town or city') }}
		<input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text" class ='form-control'></input>
		{{ $errors->first('location', '<p style="color:red;"><i>:message</i></p>') }}
		{{ $errors->first('country', '<p style="color:red;"><i>:message</i></p>') }}
		
	</div>
		<div class="col-lg-2">
		<label>City</label>
		{{ Form::text('town', $value = null, $attributes = array('id' => 'locality', 'class' => 'field form-control', 'disabled' => 'true')) }}
		<input class="field" type="hidden" id="street_number"
              disabled="true"></input>
		</div>
		<div class="col-lg-2">
		<label>State</label>
		{{ Form::text('location', $value = null, $attributes = array('id' => 'administrative_area_level_1', 'class' => 'field form-control', 'disabled' => 'true')) }}
              <input type="hidden" class="field" id="postal_code"
              disabled="true">
		<input class="field" type="hidden" id="route" disabled="true"></input>
		</div>
		<div class="col-lg-3">
		<label>Country</label>
		{{ Form::text('country', $value = null, $attributes = array('id' => 'country', 'class' => 'field form-control', 'disabled' => 'true')) }}
		</div>
	</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-6">
			{{ Form::label('event starts') }}
			<br>
		 	{{ Form::selectRange('Daycast', 1, 31,'', $attributes = array('class' => 'sltp')); }}
		 	{{ Form::selectMonth('Monthcast','', $attributes = array('class' => 'sltp')); }}
		 	{{ Form::selectRange('Yearcast', 2016, 2020,'', $attributes = array('class' => 'sltp')); }}
		 	<br>
		 	{{ $errors->first('Daycast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Monthcast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Yearcast', '<p class="error">:message</p>') }}			
		</div>
		<div class="col-lg-6">
			{{ Form::label('event ends') }}
			<br>
		 	{{ Form::selectRange('Dayend', 1, 31,'', $attributes = array('class' => 'sltp')); }}
		 	{{ Form::selectMonth('Monthend','', $attributes = array('class' => 'sltp')); }}
		 	{{ Form::selectRange('Yearend', 2016, 2020,'', $attributes = array('class' => 'sltp')); }}
		 	<br>
		 	{{ $errors->first('Daycast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Monthcast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Yearcast', '<p class="error">:message</p>') }}			
		</div>
	</div>
	</div>
	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary sendcast">Submit</button>
      </div>
    </div>
  </div>
</div>
<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEZWVqipySopkCFUh7K3aBmrHa3l0m_3Q&libraries=places&callback=initAutocomplete" async defer></script>
@stop
@section('script')
{{ HTML::script('js/contact.js') }}
@stop