@extends('layouts.welcome')
@section('content')
<br>
<br>


	{{ Form::open(array('url' => 'others/create')) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4 col-xs-12">
			{{ Form::label('Name') }}
		 	{{ Form::text('Name', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('Name', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		@if($user_type == 'others')
		<div class="col-lg-4 col-xs-12 col-sm-4">
					{{ Form::label('Select other Industry Professionals') }}
					<select name="industry" class="form-control">
						<option value="">--Please select--</option>
						@foreach($getindustry as $industry)
						<option value="{{$industry->id}}">{{$industry->name}}</option>
						@endforeach
					</select>
			</div>
		@endif
	</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-xs-12 col-sm-4">
			{{ Form::label('CAC number (optional)') }}
		 	{{ Form::text('CAC', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
		<div class="col-lg-4 col-xs-12 col-sm-4">
			{{ Form::label('Website (optional)') }}
		 	{{ Form::text('Website', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
	</div>
	</div>
	<br> 
	<div class="well">
	<div class="row">
	<div class="col-lg-5 col-xs-12 col-sm-4">
		<label>Enter Town <i style="color: red">(Select your location from auto fill)</i></label>
		<input id="autocomplete" placeholder="Enter Town Here"
             onFocus="geolocate()" type="text" class ='form-control'></input>
		{{ $errors->first('location', '<p style="color:red;"><i>:message</i></p>') }}
		{{ $errors->first('country', '<p style="color:red;"><i>:message</i></p>') }}
		
	</div>
		<div class="col-lg-2 col-xs-12 col-sm-2">
		<label>City</label>
		{{ Form::text('town', $value = null, $attributes = array('id' => 'locality', 'class' => 'field','readonly' => 'readonly')) }}
		<input class="field" type="hidden" id="street_number"
              disabled="true"></input>
		</div>
		<div class="col-lg-2 col-sm-2 col-xs-12">
		<label>State</label>
		{{ Form::text('location', $value = null, $attributes = array('id' => 'administrative_area_level_1', 'class' => 'field', 'readonly' => 'readonly')) }}
              <input type="hidden" class="field" id="postal_code"
              disabled="true">
		<input class="field" type="hidden" id="route" disabled="true"></input>
		</div>
		<div class="col-lg-2 col-xs-12 col-sm-2">
		<label>Country</label>
		{{ Form::text('country', $value = null, $attributes = array('id' => 'country', 'class' => 'field', 'readonly' => 'readonly')) }}
		</div>
	</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-xs-12 col-sm-4">
			{{ Form::label('Address') }}
		 	{{ Form::text('address', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('address', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-12">
			{{ Form::label('Telephone') }}
			<br>
		 	{{ Form::text('telephone', $value = '+234', $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control', 'placeholder' => '+2348131234567')) }}
		 	{{ $errors->first('telephone', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
		<div class="col-lg-4 col-xs-12 col-sm-4">
		{{ Form::label('landline') }}
		 	{{ Form::text('landline', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
	</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4 col-xs-12">
			{{ Form::label('Chairman Name (optional)') }}
		 	{{ Form::text('chairmanname', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
		<div class="col-lg-4 col-xs-12 col-sm-4">
			{{ Form::label('Chairman Telephone (optional)') }}
		 	{{ Form::text('chairmantel', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
		<div class="col-lg-4 col-xs-12 col-sm-4">
			{{ Form::label('Chairman Email (optional)') }}
		 	{{ Form::text('chairmanemail', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4 col-xs-12 col-sm-4">
			{{ Form::label('About us') }}
		 	{{ Form::textarea('aboutus', $value = '', array('class' => 'form-control')) }}
		</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12">
				{{ Form::label('terms') }}
				<br>
				<p>{{ Form::checkbox('terms', '1') }} I agree to the <a target="_" href="/terms-and-conditions">terms & conditions.</a></p>
				{{ $errors->first('terms', '<p style="color:red"><i>:message</i></p>') }}
			<br>
			</div>
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-1">
			<div class="form-group">
			  {{ Form::submit('SAVE',  $attributes = array('class' => 'btn-col btn btn-primary btn-sm')) }}
			</div>
		</div>
	</div>
	{{ Form::close() }}	
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