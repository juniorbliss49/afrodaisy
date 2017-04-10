@extends('layouts.welcome')
@section('content')
<br>
<br>


	{{ Form::open(array('url' => 'model/create')) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
				
			{{ Form::label('First Name') }}
		 	{{ Form::text('firstName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control firstName')) }}
		 	{{ $errors->first('firstName', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Last Name') }}
		 	{{ Form::text('lastName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control lastName')) }}
		 	{{ $errors->first('lastName', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
		<div class="col-lg-4">
			{{ Form::label('Display Name') }}
		 	{{ Form::text('displayName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control displayName')) }}
		 	{{ $errors->first('displayName', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
	</div>
	</div>
	<br>
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Mobile Phone Number') }}
		 	{{ Form::text('phone', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control', 'placeholder' => '+2348131234567')) }}
		 	<i>in this format +2348131234567</i>
		 	{{ $errors->first('phone', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Alternative Mobile Phone Number') }}
		 	{{ Form::text('altPhone', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control', 'placeholder' => '+234')) }}
		 	{{ $errors->first('altPhone', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
	</div>
	</div>
	<div class = 'well'>
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Date of birth') }}
			<br>
		 	{{ Form::selectRange('DayofBirth', 1, 31); }}
		 	{{ Form::selectMonth('MonthofBirth'); }}
		 	{{ Form::selectRange('YearofBirth', 1954, 2004); }}
		 	<br>
		 	{{ $errors->first('DayofBirth', '<p style="color:red;"><i>:message</i></p>') }}
		 	{{ $errors->first('MonthofBirth', '<p style="color:red;"><i>:message</i></p>') }}
		 	{{ $errors->first('YearofBirth', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
		</div>
	</div> 
	<div class="well">
	<div class="row">
	<div class="col-lg-5">
		<label>Enter Town <i style="color: red">(Select your location from auto fill)</i></label>
		<input id="autocomplete" placeholder="Enter Town Here"
             onFocus="geolocate()" type="text" class ='form-control'></input>
		{{ $errors->first('location', '<p style="color:red;"><i>:message</i></p>') }}
		{{ $errors->first('country', '<p style="color:red;"><i>:message</i></p>') }}
		
	</div>
		<div class="col-lg-2">
		<label>City</label>
		{{ Form::text('town', $value = null, $attributes = array('id' => 'locality', 'class' => 'field','readonly' => 'readonly')) }}
		<input class="field" type="hidden" id="street_number"
              disabled="true"></input>
		</div>
		<div class="col-lg-2">
		<label>State</label>
		{{ Form::text('location', $value = null, $attributes = array('id' => 'administrative_area_level_1', 'class' => 'field' ,'readonly' => 'readonly')) }}
              <input type="hidden" class="field" id="postal_code"
              disabled="true">
		<input class="field" type="hidden" id="route" disabled="true"></input>
		</div>
		<div class="col-lg-2">
		<label>Country</label>
		{{ Form::text('country', $value = null, $attributes = array('id' => 'country', 'class' => 'field', 'readonly' => 'readonly')) }}
		</div>
	</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Gender') }}
			<br>
		 	{{ Form::select('gender', array('' => 'Gender', 'male' => 'Male', 'female' => 'Female'), '', $attributes = array('class' => 'sltp')) }}
		 	{{ $errors->first('gender', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4">
		{{ Form::label('Height') }}
		<br>
		{{ Form::select('Height', array('' => '--Please select--', '210' => '210cm / 6.89ft', '209' => '209cm / 6.86ft', '208' => '208cm / 6.82ft', '207' => '207cm / 6.79ft', '206'=>'206cm / 6.76ft', '205' => '205cm / 6.73ft', '204' => '204cm / 6.69ft', '203'=>'203cm / 6.66ft', '202'=>'202cm / 6.63ft', '201'=>'201cm / 6.59cm',  '200'=>'200cm / 6.56ft', '199'=>'199cm / 6.53ft', '198'=>'198cm / 6.50ft', '197'=>'197cm / 6.46ft', '196'=>'196cm / 6.43ft', '195'=>'195cm / 6.40ft', '194'=>'194cm / 6.36ft', '193'=>'193cm / 6.33ft', '192'=>'192cm / 6.30ft', '191'=>'191cm / 6.27ft', '190'=>'190cm / 6.23ft', '189'=>'189cm / 6.20ft', '188'=>'188cm / 6.17ft', '187'=>'187cm / 6.14ft', '186'=>'186cm / 6.10ft', '185'=>'185cm / 6.07ft', '184'=>'184cm / 6.04ft', '183'=>'183cm / 6.00ft', '182'=>'182cm / 5.97ft', '181'=>'181cm / 5.94ft', '180'=>'180cm / 5.91ft', '179'=>'179cm / 5.87ft', '178'=>'178cm / 5.84ft', '177'=>'177cm / 5.81ft', '176'=>'176cm / 5.77ft','175'=>'175cm / 5.74ft', '174'=>'174cm / 5.71ft', '173'=>'173cm / 5.68ft', '172'=>'172cm / 5.64ft', '171'=>'171cm / 5.61ft', '170'=>'170cm / 5.58ft', '169'=>'169cm / 5.54ft', '168'=>'168cm / 5.51ft','167'=>'167cm / 5.48ft', '166'=>'166cm / 5.45ft', '165'=>'165cm / 5.41ft', '164'=>'164cm / 5.38ft', '163'=>'163cm / 5.35ft', '162'=>'162cm / 5.31ft', '161'=>'161cm / 5.28ft', '160'=>'160cm / 5.25ft','159'=>'159cm / 5.22ft', '158'=>'158cm / 5.18ft', '157'=>'157cm / 5.15ft', '156'=>'156cm / 5.12ft', '155'=>'155cm / 5.09ft', '154'=>'154cm / 5.05ft', '153'=>'153cm / 5.02ft','152'=>'152cm / 4.99ft', '151'=>'151cm / 4.95ft', '150'=>'150cm / 4.92ft', '149'=>'149cm / 4.89ft', '148'=>'148cm / 4.86ft', '147'=>'147cm / 4.82ft', '146'=>'146cm / 4.79ft', '145'=>'145cm / 4.76ft','144'=>'144cm / 4.72ft', '143'=>'143cm / 4.69ft', '142'=>'142cm / 4.66ft', '141'=>'141cm / 4.63ft', '140'=>'140cm / 4.59ft', '139'=>'139cm / 4.56ft', '138'=>'138cm / 4.53ft', '137'=>'137cm / 4.49ft', '136'=>'136cm / 4.46ft', '135'=>'135cm / 4.43ft', '134'=>'134cm / 4.40ft', '133'=>'133cm / 4.36ft', '132'=>'132cm / 4.33ft', '131'=>'131cm / 4.30ft', '130'=>'130cm / 4.27ft', '129'=>'129cm / 4.23ft','128'=>'128cm / 4.20ft', '127'=>'127cm / 4.17ft', '126'=>'126cm / 4.13ft', '125'=>'125cm / 4.10ft', '124'=>'124cm / 4.07ft', '123'=>'123cm / 4.04ft', '122'=>'122cm / 4.00ft', '121'=>'121cm / 3.97ft','120'=>'120cm / 3.94ft'),'', $attributes = array('class' => 'sltp')) }}
		{{ $errors->first('Height', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Short Text About yourself') }}
			{{ Form::textarea('about', $value = null, array('class' => 'form-control')) }}
			{{ $errors->first('about', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		</div>
	</div>
	<div class="well">
		<label>Model Type</label>
		<div class="row">
			@foreach($dis as $disc)
			<div class="col-lg-4">
			{{ Form::checkbox('cat[]', $disc->id) }} {{$disc->name}}
			</div>
			@endforeach
			{{ $errors->first('cat', '<p style="color:red;"><i>:message</i></p>') }}
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12">
				{{ Form::label('terms') }}
				<br>
				<p>{{ Form::checkbox('terms', '1') }} I agree to the <a target="_" href="/terms-and-conditions">>terms & conditions.</a></p>
				{{ $errors->first('terms', '<p style="color:red;"><i>:message</i></p>') }}
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
@section('script')
{{ HTML::script('js/welcome.js') }}
@stop