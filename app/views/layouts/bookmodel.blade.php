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
	<div class="row">
			<div class="col-lg-8 col-sm-8">
				<div class="row">
					<div class="col-lg-12">
						<h4>{{ $user->newmodel->firstName}} {{$user->newmodel->lastName }}</h4>
						<h4><span class="glyphicon glyphicon-map-marker"></span> {{ $user->newmodel->country }} , {{$user->newmodel->location}}</h4>
					</div>	
				</div>
				<div class="sendit" style="display: none;">
					
				</div>
				<div class="row">
					<div class="col-lg-12 text-center" style="border: 1px solid #000">
						{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '620px', 'class' => 'img-responsive')) }}
						
					</div>
				</div>
				<div class="row" style="border: 1px solid #000; padding: 10px">
					<h4>ABOUT ME</h4>
					<p>{{ $user->newmodel->about}}</p>
				</div>
			</div>
			<div class="col-lg-1 col-sm-1">
				
			</div>
			<div class="col-lg-3 col-sm-3">
					<br>
					<br>
					<br>
				<div class="row" style="border: 1px solid #000">
					<div class="col-lg-12">
					@if(!empty($getverify))
						<h5>INVITE MODEL</h5>
						<button class="btn btn-sm btn-primary existing" data-toggle="modal" data-target="#exampleModal">
							Invite to apply to an exixting cast
						</button>
						<br>
						<br>
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal2">
							Create new cast for Invitation
						</button>
						<div class="shw" style="display: none;">
							<br>
							<br>
							<p style='padding: 10px' class='bg-success'>Booking Sent Successfully wait for approval by afrodaisymodels.com</p>
						</div>
					@else
						<h4>Complete your verification to book model</h4>
					@endif
					</div>
				</div>
				<br>
				<div class="row" style="border: 1px solid #000">
					<div class="col-lg-12 col-xs-12">
						<h5>More Models in this Location</h5>
						<br>
						@foreach($getmodelscloseby as $closeby)

						<div class="row">
							<div class="col-lg-4 col-xs-4">
								{{ HTML::image($closeby->imagename, 'profile picture', array('width' => '70px', 'height' => '70px', 'class' => 'img-responsive')) }}
							</div>
							<div class="col-lg-8 col-xs-8 text-left">
								<a href="/models/profile/{{$closeby->user_id}}">
									{{ $closeby->firstName}} {{$closeby->lastName }}
								</a>
								<p><span class="glyphicon glyphicon-map-marker"></span> {{ $closeby->country }} , {{$closeby->location}}</p>
							</div>
						</div>
						<br>

						@endforeach
					</div>
				</div>	
			</div>	
			<input type="hidden" name="modelid" id="modelid" value="{{$id}}">
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cast</h4>
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

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3>Create New casting</h3>
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
		 	{{ Form::textarea('casting', $value = '', array('class'=>'form-control')) }}
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
{{ HTML::script('js/message.js') }}
{{ HTML::script('js/contact.js') }}
@stop