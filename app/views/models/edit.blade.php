@extends('layouts.main')

@section('content')
  {{ HTML::style('vendor/fileapi/jcrop/jquery.Jcrop.min.css') }}
  {{ HTML::style('vendor/fileapi/statics/main.css') }}
  {{ HTML::style('css/lightgallery.css') }}

<style type="text/css">
	.grid-item {
  float: left;
  width: 180px;
  border: 1px solid hsla(0, 0%, 0%, 0.5);
  margin: 2px;
  text-align: center;
  position: relative;
}
</style>
<div class="col-lg-2 col-sm-2">
				<div class="row">
					<a href="">
					<div class="dpchange">
					@if(isset($user->photoupload->imagename))
						{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
					@else
						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
					@endif  
					</div>

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
						<a href="/models/dashboard"><li>My Dashboard <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/models/profile/{{$user->id}}"><li>View Profile<span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/models/edit"><li>Edit Profile <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/models/castapplication"><li> Cast Applications {{$getcastunseen}} <span style="position: relative" class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My messages</strong></p>
					
					<ul class="list-profile">
						<a href="/users/mymessage"><li>messages {{$getmsgunseen}} <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My Networks</strong></p>
					
					<ul class="list-profile">
						<a href="/models/mynetwork"><li>Networks<span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				<div class="row">
					<br>
					<p><strong>My membership</strong></p>
					
					<ul class="list-profile">
						<a href="/users/subscriptionstatus"><li>Subscription Status <span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="/users/changesubscription"><li>Change subscription <span class="text-right glyphicon glyphicon-play"></span></li></a>
					</ul>
				</div>
				</div>
				</nav>
			</div>
			<div class="col-lg-10 col-sm-10 dash-bd">
					<div class="row">
						<h3>Edit profile</h3>
						<hr>
					</div>
					<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>
    <li role="presentation"><a href="#preference" aria-controls="preference" role="tab" data-toggle="tab">My Preference</a></li>
    <li role="presentation"><a href="#public" aria-controls="public" role="tab" data-toggle="tab">Media</a></li>
    <li role="presentation"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Password/Email change</a></li>
    <li role="presentation"><a href="#bankdetails" aria-controls="bankdetails" role="tab" data-toggle="tab">Bank Details</a></li>
    <li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Social Network</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="personal">
    	<br>
    	<br>
    	{{ Form::model($Models, array('url' => array('models/edituser'), 'id'=>'form' )) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
				
			{{ Form::label('First Name') }}
		 	{{ Form::text('firstName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('firstName', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Last Name') }}
		 	{{ Form::text('lastName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('lastName', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
		<div class="col-lg-4">
			{{ Form::label('Display Name') }}
		 	{{ Form::text('displayName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('displayName', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
	</div>
	</div>
	<br>
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Mobile Phone Number') }}
		 	{{ Form::text('phone', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('phone', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
	<div class="col-lg-5 col-sm-4">
		{{ Form::label('Enter your town or city') }}
		<input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text" class ='form-control'></input>
		{{ $errors->first('location', '<p style="color:red;"><i>:message</i></p>') }}
		{{ $errors->first('country', '<p style="color:red;"><i>:message</i></p>') }}
		
	</div>
		<div class="col-lg-2 col-sm-2">
		<label>City</label>
		{{ Form::text('town', $value = null, $attributes = array('id' => 'locality', 'class' => 'field', 'readonly' => 'readonly')) }}
		<input class="field" type="hidden" id="street_number"
              disabled="true"></input>
		</div>
		<div class="col-lg-2 col-sm-2">
		<label>State</label>
		{{ Form::text('location', $value = null, $attributes = array('id' => 'administrative_area_level_1', 'class' => 'field', 'readonly' => 'readonly')) }}
              <input type="hidden" class="field" id="postal_code"
              disabled="true">
		<input class="field" type="hidden" id="route" disabled="true"></input>
		</div>
		<div class="col-lg-2 col-sm-2">
		<label>Country</label>
		{{ Form::text('country', $value = null, $attributes = array('id' => 'country', 'class' => 'field', 'readonly' => 'readonly')) }}
		</div>
	</div>
	</div>
	<br>
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
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Gender') }}
			<br>
		 	{{ Form::select('gender', array('' => 'Gender', 'male' => 'Male', 'female' => 'Female')) }}
		 	{{ $errors->first('gender', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4">
		{{ Form::label('Height') }}
		<br>
		{{ Form::select('Height', array('' => '--Please select--', '210' => '210cm / 6.89ft', '209' => '209cm / 6.86ft', '208' => '208cm / 6.82ft', '207' => '207cm / 6.79ft', '206'=>'206cm / 6.76ft', '205' => '205cm / 6.73ft', '204' => '204cm / 6.69ft', '203'=>'203cm / 6.66ft', '202'=>'202cm / 6.63ft', '201'=>'201cm / 6.59cm',  '200'=>'200cm / 6.56ft', '199'=>'199cm / 6.53ft', '198'=>'198cm / 6.50ft', '197'=>'197cm / 6.46ft', '196'=>'196cm / 6.43ft', '195'=>'195cm / 6.40ft', '194'=>'194cm / 6.36ft', '193'=>'193cm / 6.33ft', '192'=>'192cm / 6.30ft', '191'=>'191cm / 6.27ft', '190'=>'190cm / 6.23ft', '189'=>'189cm / 6.20ft', '188'=>'188cm / 6.17ft', '187'=>'187cm / 6.14ft', '186'=>'186cm / 6.10ft', '185'=>'185cm / 6.07ft', '184'=>'184cm / 6.04ft', '183'=>'183cm / 6.00ft', '182'=>'182cm / 5.97ft', '181'=>'181cm / 5.94ft', '180'=>'180cm / 5.91ft', '179'=>'179cm / 5.87ft', '178'=>'178cm / 5.84ft', '177'=>'177cm / 5.81ft', '176'=>'176cm / 5.77ft','175'=>'175cm / 5.74ft', '174'=>'174cm / 5.71ft', '173'=>'173cm / 5.68ft', '172'=>'172cm / 5.64ft', '171'=>'171cm / 5.61ft', '170'=>'170cm / 5.58ft', '169'=>'169cm / 5.54ft', '168'=>'168cm / 5.51ft','167'=>'167cm / 5.48ft', '166'=>'166cm / 5.45ft', '165'=>'165cm / 5.41ft', '164'=>'164cm / 5.38ft', '163'=>'163cm / 5.35ft', '162'=>'162cm / 5.31ft', '161'=>'161cm / 5.28ft', '160'=>'160cm / 5.25ft','159'=>'159cm / 5.22ft', '158'=>'158cm / 5.18ft', '157'=>'157cm / 5.15ft', '156'=>'156cm / 5.12ft', '155'=>'155cm / 5.09ft', '154'=>'154cm / 5.05ft', '153'=>'153cm / 5.02ft','152'=>'152cm / 4.99ft', '151'=>'151cm / 4.95ft', '150'=>'150cm / 4.92ft', '149'=>'149cm / 4.89ft', '148'=>'148cm / 4.86ft', '147'=>'147cm / 4.82ft', '146'=>'146cm / 4.79ft', '145'=>'145cm / 4.76ft','144'=>'144cm / 4.72ft', '143'=>'143cm / 4.69ft', '142'=>'142cm / 4.66ft', '141'=>'141cm / 4.63ft', '140'=>'140cm / 4.59ft', '139'=>'139cm / 4.56ft', '138'=>'138cm / 4.53ft', '137'=>'137cm / 4.49ft', '136'=>'136cm / 4.46ft', '135'=>'135cm / 4.43ft', '134'=>'134cm / 4.40ft', '133'=>'133cm / 4.36ft', '132'=>'132cm / 4.33ft', '131'=>'131cm / 4.30ft', '130'=>'130cm / 4.27ft', '129'=>'129cm / 4.23ft','128'=>'128cm / 4.20ft', '127'=>'127cm / 4.17ft', '126'=>'126cm / 4.13ft', '125'=>'125cm / 4.10ft', '124'=>'124cm / 4.07ft', '123'=>'123cm / 4.04ft', '122'=>'122cm / 4.00ft', '121'=>'121cm / 3.97ft','120'=>'120cm / 3.94ft')) }}
		{{ $errors->first('Height', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Short Text About yourself') }}
			{{ Form::textarea('about',$value = null, array('class' => 'form-control')) }}
			{{ $errors->first('about', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-1">
			<div class="form-group">
			  {{ Form::submit('UPDATE',  $attributes = array('class' => 'btn-col btn btn-default btn-sm')) }}
			</div>
		</div>
	</div>
	{{ Form::close() }}	
    </div>
    <div role="tabpanel" class="tab-pane" id="preference">
    	<br>
    	<br>
	<div class="well">
		<div class="row">
		<div class="length">
			<h4></h4>
		</div>
		<button class="btn btn-defualt reset" id="dash" style="display: none">RESET</button>
		<button class="btn btn-defualt buyplan" id="dash" style="display: none">CLICK TO BUY NEW PLAN</button>
		<input type="hidden" name="plan" id="plan" value="{{$plan}}">
					<h4 class="rem">Select model category</h4>
					<br>
					{{ Form::model($modelpreference, array('url' => array('', $modelpreference->modelId), 'id'=>'formmodel' )) }}
					<?php
					$checked = '';
					$catId = array();
					?>
					@foreach($getCategory as $cat)
					<?php
						$catId[] = $cat->dis_id;
					?>
					@endforeach
					@foreach($Discipline as $category)
						<div class="col-lg-3">
						@if (in_array($category->id, $catId))
							<?php
								$checked = true;
							?>
						@else
							<?php
								$checked = '';
							?>
							@endif
						
							{{ Form::checkbox('catry', $category->id, $checked)}} {{$category->name}} 
						</div>
					@endforeach
		</div>
	</div>
    	<div class="well">
		<div class="row">
					<h4>Select model type</h4>
			<?php
					$checked = '';
					$catIds = array();
					?>
					@foreach($getDisVal as $cat)
					<?php
						$catIds[] = $cat->cat_id;
					?>
					@endforeach
			@foreach($getDiscipline as $Discipline)
						<div class="col-lg-4">
						@if (in_array($Discipline->id, $catIds))
							<?php
								$checked = true;
							?>
						@else
							<?php
								$checked = '';
							?>
							@endif		
							{{ Form::checkbox('cats', $Discipline->id, $checked)}} {{$Discipline->name}} 
							<br>
						</div>
			@endforeach
		</div>
	</div>
	<div class="well">

					<div class="row">
						<div class="col-lg-4">
						{{ Form::label('Chest/Bust') }}
						         <br>
		{{ Form::select('chestbust', array('' => 'chest / bust', '65' => '65cm / 25.6', '66' => '66cm / 26.0', '67' => '67cm / 26.4', '68' => '68cm / 26.8', '69'=>'69cm / 27.2', '70' => '70cm / 27.6', '71' => '71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1',  '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3', '110'=>'110cm / 43.3', '111'=>'111cm / 43.7', '112'=>'112cm / 44.1', '113'=>'113cm / 44.5', '114'=>'114cm / 44.9', '115'=>'115cm / 45.3', '116'=>'116cm / 45.7', '117'=>'117cm / 46.1', '118' =>'118cm / 46.5', '119'=>'119cm / 46.9', '120'=>'120cm / 47.2', '121'=>'121cm / 47.6', '122'=>'122cm / 48.0', '123'=>'123cm / 48.4', '124'=>'124cm / 48.8', '125'=>'125cm / 49.2', '126'=>'126cm / 49.6', '127'=>'127cm / 50.0', '128'=>'128cm / 50.4', '129'=>'129cm / 50.8', '130'=>'130cm / 51.2', '131'=>'131cm / 51.6', '132'=>'132cm / 52.0', '133'=>'133cm / 52.4', '134'=>'134cm / 52.8', '135'=>'135cm / 53.1', '136'=>'136cm / 53.5', '137'=>'137cm / 53.9', '138' =>'138cm / 54.3', '139'=>'139cm / 54.7', '140'=>'140cm / 55.1', '141'=>'141cm / 55.5', '142'=>'142cm / 55.9', '143'=>'143cm / 56.3', '144'=>'144cm / 56.7', '145'=>'145cm / 57.1', '146'=>'146cm / 57.5', '147'=>'147cm / 57.9', '148'=>'148cm / 58.3', '149'=>'149cm / 58.7', '150'=>'150cm / 59.1')) }}
						    		
						</div>
						<div class="col-lg-4">
						         
						         {{ Form::label('Waist') }}
						         <br>
		{{ Form::select('waist', array('' => '--waist--', '50' => '50cm / 19.7', '51' => '51cm / 20.1', '52' => '52cm / 20.5', '53' => '53cm / 20.9', '54'=>'54cm / 21.3', '55' => '55cm / 21.7', '56' => '56cm / 22.0', '57'=>'57cm / 22.4', '58'=>'58cm / 22.8', '59'=>'59cm / 23.2',  '60'=>'60cm / 23.6', '61'=>'61cm / 24.0', '62'=>'62cm / 24.4', '63'=>'63cm / 24.8', '64'=>'64cm / 25.2', '65'=>'65cm / 25.6', '66'=>'66cm / 26.0', '67'=>'67cm / 26.4', '68'=>'68cm / 26.8', '69'=>'69cm / 27.2', '70'=>'70cm / 27.6', '71'=>'71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1', '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3')) }}
						    		
						</div>
						<div class="col-lg-4">
						{{ Form::label('Hips') }}
						         <br>
		{{ Form::select('hips', array('' => 'Hips', '65' => '65cm / 25.6', '66' => '66cm / 26.0', '67' => '67cm / 26.4', '68' => '68cm / 26.8', '69'=>'69cm / 27.2', '70' => '70cm / 27.6', '71' => '71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1',  '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3', '110'=>'110cm / 43.3', '111'=>'111cm / 43.7', '112'=>'112cm / 44.1', '113'=>'113cm / 44.5', '114'=>'114cm / 44.9', '115'=>'115cm / 45.3', '116'=>'116cm / 45.7', '117'=>'117cm / 46.1', '118' =>'118cm / 46.5', '119'=>'119cm / 46.9', '120'=>'120cm / 47.2', '121'=>'121cm / 47.6', '122'=>'122cm / 48.0', '123'=>'123cm / 48.4', '124'=>'124cm / 48.8', '125'=>'125cm / 49.2', '126'=>'126cm / 49.6', '127'=>'127cm / 50.0', '128'=>'128cm / 50.4', '129'=>'129cm / 50.8', '130'=>'130cm / 51.2', '131'=>'131cm / 51.6', '132'=>'132cm / 52.0', '133'=>'133cm / 52.4', '134'=>'134cm / 52.8', '135'=>'135cm / 53.1', '136'=>'136cm / 53.5', '137'=>'137cm / 53.9', '138' =>'138cm / 54.3', '139'=>'139cm / 54.7', '140'=>'140cm / 55.1', '141'=>'141cm / 55.5', '142'=>'142cm / 55.9', '143'=>'143cm / 56.3', '144'=>'144cm / 56.7', '145'=>'145cm / 57.1', '146'=>'146cm / 57.5', '147'=>'147cm / 57.9', '148'=>'148cm / 58.3', '149'=>'149cm / 58.7', '150'=>'150cm / 59.1')) }}
						         
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4">
						 {{ Form::label('Dress') }}
						         <br>
		{{ Form::select('dress', array('' => 'Dress', '32' => '32 EU, 4 UK,  2  US', '34' => '34 EU, 6 UK,  4  US', '36' => '36 EU, 8 UK,  6  US', '38' => '38 EU, 10 UK, 8, US', '40'=>'40 EU, 12 UK, 10 US', '42' => '42 EU, 14 UK, 12 US', '44' => '44 EU, 16 UK, 14 US', '46'=>'46 EU, 18 UK, 16 US', '48'=>'48 EU, 20 UK, 18 US')) }}
					                
						</div>
						<div class="col-lg-4">
						{{ Form::label('Jacket') }}
						         <br>
		{{ Form::select('jacket', array('' => 'Jacket', '42' => '42 EU, 34 UK, 28 US', '44' => '44 EU, 35 UK, 30 US', '46'=>'46 EU, 36 UK, 32 US', '48'=>'48 EU, 38 UK, 34 US', '50' => '50 EU, 40 UK, 36 US', '52'=>'52 EU, 42 UK, 38 US', '54'=>'54 EU, 44 UK, 40 US')) }}
						</div>
						<div class="col-lg-4">
						{{ Form::label('Trousers') }}
						         <br>
		{{ Form::select('trousers', array('' => 'Trousers', '38' => '38 EU, 38 UK, 28 US', '40' => '40 EU, 40 UK, 30 US', '42' => '42 EU, 42 UK, 32 US', '44' => '44 EU, 44 UK, 34 US', '46'=>'46 EU, 46 UK, 36 US', '48'=>'48 EU, 48 UK, 38 US', '50' => '50 EU, 52 UK, 40 US', '52'=>'52 EU, 54 UK, 42 US', '54'=>'54 EU, 56 UK, 44 US')) }}
				                
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4">
						{{ Form::label('Collar') }}
						         <br>
		{{ Form::select('collar', array('' => 'Collar', '18' => '18cm / 7', '19' => '19cm / 7', '20' => '20cm / 8', '21' => '21cm / 8', '22'=>'22cm / 9', '23' => '23cm / 9', '24' => '24cm / 9', '25'=>'25cm / 10', '26'=>'26cm / 10', '27'=>'27cm / 11',  '28'=>'28cm / 11', '29'=>'29cm / 11', '30'=>'30cm / 12', '31'=>'31cm / 12', '32'=>'32cm / 13', '33'=>'33cm / 13', '34'=>'34cm / 13', '35'=>'35cm / 14', '36'=>'36cm / 14', '37'=>'37cm / 15', '38'=>'38cm / 15', '39'=>'39cm / 15', '40'=>'40cm / 16', '41'=>'41cm / 16', '42'=>'42cm / 17', '43'=>'43cm / 17', '44'=>'44cm / 17', '45'=>'45cm / 18')) }}
                
						</div>
						<div class="col-lg-4">
						{{ Form::label('Shoes') }}
						         <br>
		{{ Form::select('shoes', array('' => 'Shoes', '225' => '36 EU,  3 UK, 3 US', '232' => '37 EU,  4 UK, 4 US', '240' => '38 EU,  5 UK, 5 US', '247' => '39 EU,  6 UK, 6 US', '255'=>'40 EU, 6½ UK, 7 US', '262'=>'41 EU,  7 UK, 7½ US', '270' => '42 EU,  8 UK, 8 US', '277'=>'43 EU,  9 UK, 9 US', '285'=>'44 EU, 9½ UK, 10 US', '292'=>'45 EU, 10 UK, 11 US', '300' => '46 EU, 11 UK, 12 US', '307'=>'47 EU, 12 UK, 13 US', '315'=>'48 EU, 13 UK, 14 US', '322'=>'49 EU, 14 UK, 15 US')) }}
				                
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4">
						{{ Form::label('Eyes') }}
						         <br>
		{{ Form::select('eyes', array('' => 'Eyes', 'black' => 'Black', 'blue' => 'Blue', 'brown' => 'Brown', 'darkbrown' => 'Dark Brown', 'green'=>'Green', 'gray'=>'Gray', 'hazel' => 'Hazel', 'lightblue'=>'Light Blue', 'lightbrown'=>'Light Brown')) }}
                
						</div>
						<div class="col-lg-4">
						{{ Form::label('Hair Color') }}
						         <br>
		{{ Form::select('hair_color', array('' => 'Hair Color', 'aubrum' => 'Aubrum', 'black' => 'Black', 'blonde' => 'Blonde', 'brown' => 'Brown', 'cendre'=>'Cendre', 'chestnut'=>'Chestnut', 'dark' => 'Dark', 'darkblonde'=>'Dark Blonde', 'darkbrown'=>'Dark Brown', 'grey'=>'Grey', 'hazel'=>'Hazel', 'lightblue' => 'Light Blue', 'redblonde'=>'Red Blonde', 'salt-pepper'=>'Salt and Pepper', 'lightblonde' => 'Light Blonde', 'strawberryblonde'=>'Strawberry Blonde')) }}
				               
						</div>
						
						<div class="col-lg-4">
						{{ Form::label('Languages') }}
						         <br>
		{{ Form::select('languages', array('' => 'Languages', 'English' => 'English', 'Igbo' => 'Igbo', 'Hausa' => 'Hausa', 'Yoruba' => 'Yoruba', 'Pidgin'=>'Pidgin', 'Edo'=>'Edo', 'Tiv' => 'Tiv', 'Fulani'=>'Fulani', 'Idoma'=>'Idoma', 'Ijaw'=>'Ijaw', 'Kanuri'=>'Kanuri')) }}
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4">
						{{ Form::label('Complexion') }}
						         <br>
		{{ Form::select('complexion', array('' => 'Complexion', 'lightskin' => 'Light skinned', 'lightbrown' => 'Light brown-skin', 'brown-skin' => 'Brown-skin', 'dark-brown' => 'Dark brown-skin', 'darkskin'=>'Dark skin')) }}
						</div>
							
						
						<div class="col-lg-4">
						{{ Form::label('Butt type') }}
						         <br>
		{{ Form::select('butt', array('' => 'Butt type', 'inverted' => 'Inverted “V” shape', 'squared' => 'Square shape', 'round' => 'Round shape', 'heart' => 'Heart shape')) }}
						</div>
						<div class="col-lg-4">
						{{ Form::label('Hair type') }}
						         <br>
		{{ Form::select('Hair_type', array('' => 'Hair type', 'skincut' => 'skin cut', 'lowcut' => 'low cut', 'afro' => 'Afro (virgin hair)', 'relaxedshort' => 'Relaxed hair (short)', 'relaxedlong' => 'Relaxed hair (long)', 'dreadlocks' => 'Dreadlocks')) }}
							
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-6">
						{{ Form::label('Ethnicity') }}
						         <br>
		{{ Form::select('ethnicity', array('' => 'Ethnicity', 'Abraka' => 'Abraka', 'Afemai' => 'Afemai', 'Afusari' => 'Afusari','Agbassa' => 'Agbassa', 'AgbonKingdom'=>'Agbon Kingdom', 'Akunakuna' => 'Akunakuna', 'Anaang' => 'Anaang', 'Anga'=>'Anga', 'AnloEwe'=>'Anlo Ewe', 'Anwain'=>'Anwain',  'Aro'=>'Aro', 'AsianNigerian'=>'Asian Nigerian', 'Atyap'=>'Atyap', 'Bali'=>'Bali', 'Bariba'=>'Bariba', 'Berom'=>'Berom', 'Bete'=>'Bete', 'Buduma'=>'Buduma', 'Chamba'=>'Chamba', 'Dendi'=>'Dendi', 'Ebira'=>'Ebira', 'Edda'=>'Edda', 'Efik'=>'Efik', 'Eket'=>'Eket', 'Ekoi'=>'Ekoi', 'Emai'=>'Emai', 'Esan'=>'Esan', 'Etsakor'=>'Etsakor', 'Ewe'=>'Ewe', 'Fali'=>'Fali', 'Fon'=>'Fon', 'Fula'=>'Fula', 'Gbagyi'=>'Gbagyi', 'Gokana'=>'Gokana kingdom', 'Hausa'=>'Hausa', 'Hausa–Fulani'=>'Hausa–Fulani', 'Ibibio'=>'Ibibio', 'Idoma'=>'Idoma', 'Igala'=>'Igala', 'Igbo'=>'Igbo', 'Igede'=>'Igede', 'Igue'=>'Igue', 'Ijigban'=>'Ijigban community', 'Ijaw'=>'Ijaw', 'Ikpide'=>'Ikpide', 'Isoko'=>'Isoko', 'Isu'=>'Isu', 'Itsekiri'=>'Itsekiri', 'Iwellemmedan'=>'Iwellemmedan', 'Jobawa'=>'Jobawa', 'Jukun'=>'Jukun', 'Kamuku'=>'Kamuku', 'Kanuri'=>'Kanuri', 'kalabari' =>'kalabari', 'Kele'=>'Kele', 'Kilba'=>'Kilba', 'Kirdi'=>'Kirdi', 'Kofyar'=>'Kofyar', 'Koma'=>'Koma', 'Kotoko'=>'Kotoko', 'Kurtey'=>'Kurtey', 'Kuteb'=>'Kuteb', 'Longuda' =>'Longuda', 'Mafa'=>'Mafa', 'MaguzawaHausa'=>'Maguzawa Hausa', 'Mambila'=>'Mambila', 'Mumuye'=>'Mumuye', 'Ngizim'=>'Ngizim', 'Nupe'=>'Nupe', 'OfoinIgboland'=>'Ofo in Igboland', 'Ogoni'=>'Ogoni', 'Ogugu'=>'Ogugu', 'Oron'=>'Oron', 'Saro'=>'Saro', 'Tarok'=>'Tarok', 'Tiv'=>'Tiv', 'Tuareg'=>'Tuareg', 'Umuoji'=>'Umuoji', 'Urhobo'=>'Urhobo', 'Wodaabe'=>'Wodaabe', 'YerwaKanuri'=>'Yerwa Kanuri', 'Yoruba'=>'Yoruba', 'Zarma'=>'Zarma')) }}
				                
						</div>
						<div class="col-lg-6">
						{{ Form::label('Academic qualification') }}
						         <br>
		{{ Form::select('qualification', array('' => 'qualification', 'olevel' => 'O’level', 'diploma' => 'Diploma', 'bachelordegree' => 'Bachelor’s degree', 'masterdegree' => 'Masters degree', 'phd' => 'Ph.D', 'None' => 'None')) }}
							
						</div>
					</div>
					</div>
					{{ Form::close() }}	
					<div class="row">
						<button class="btn btn-defualt updateProfile" id="dash">UPDATE</button>
					</div>
					<div class="row">
					<br>
    	<div id="proUpdate" class="bg-primary" style="padding: 10px; display: none;"></div>
					</div>
    </div>		
    <div role="tabpanel" class="tab-pane" id="public">
    	<br>
    	<br>

    	<div id="multiupload">
    	{{ Form::open(array('url'=>'/upload', 'class' => 'b-upload b-upload_multi', 'files'=>true)) }}
	      <div class="b-upload__hint">Click the Add button to add image</div>
	      <div class="js-files b-upload__files">
	         <div class="js-file-tpl b-thumb" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
	            <div data-fileapi="file.remove" class="b-thumb__del">✖</div>
	            <div class="b-thumb__preview">
	               <div class="b-thumb__preview__pic"></div>
	            </div>
	            <% if( /^image/.test(type) ){ %>
	               <div data-fileapi="file.rotate.cw" class="b-thumb__rotate"></div>
	            <% } %>
	            <div class="b-thumb__progress progress progress-small"><div class="bar"></div></div>
	            <div class="b-thumb__name"><%-name%></div>
	         </div>
	      </div>
	      <hr>
	      <div class="btn btn-success btn-small js-fileapi-wrapper">
	         <span>Add</span>
	         {{ Form::file('filedata') }}
	         {{ Form::close() }}
	      </div>
	      <div class="js-upload btn btn-success btn-small">
	         <span>Upload</span>
	      </div>
		</div>
	<br>
	<br>
	<div class="row">
	<style type="text/css">
		
            .demo-gallery > ul > li a:hover > img {
              -webkit-transform: scale3d(1.1, 1.1, 1.1);
              transform: scale3d(1.1, 1.1, 1.1);
            }
	</style>
		{{$viewimg}}
	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="account">
    	<div class="row">
    		<div class="col-lg-12">
    		<br>
    		<br>
    			{{ Form::model($user, array('url' => array('others/edits'), 'id'=>'form2' )) }}
				<div class="well">
					<div class="row">
						<div class="col-lg-4">
							<strong>{{ Form::label('Old Password') }}</strong>
						 	{{ Form::password('oldpassword', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
						</div>
						<div class="col-lg-4">
							<strong>{{ Form::label('New Password') }}</strong>
						 	{{ Form::password('password', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
						 	{{ Form::close() }}	
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-lg-1">
							<div class="form-group">
				<input type="button" name="" class="btn-col btn btn-primary btn-sm" id="updatepassword" value="UPDATE" id="updatepassword">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-lg-12" id="passwordchange"></div>
					</div>
    		</div>
    	</div>
    	<br>
    	<hr>
    	<br>
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="well">
    			<div class="row">
    				<div class="col-lg-4">
							<strong>{{ Form::label('New Email') }}</strong>
    					{{ Form::text('newemail', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control', 'placeholder' => 'New Email')) }}
    				</div>
    				<div class="col-lg-4">
							<strong>{{ Form::label('Confirm Password') }}</strong>
    					{{ Form::password('confpassword', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
    				</div>
    			</div>
    			</div>
    			<div class="row">
    				<div class="col-lg-1">
						<div class="form-group">
			<input type="button" name="" class="btn-col btn btn-primary btn-sm" id="updateemail" value="UPDATE">
						</div>
					</div>
    			</div>
    			<div class="row">
						<div class="col-lg-12" id="emailchange"></div>
					</div>
    		</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="bankdetails">
    	<div class="row">
    		{{ Form::model($bankdetails, array('url' => array('models/edituser'))) }}
    		<br>
    		<br>
    		<div class="row">
    			<div class="col-lg-12">
    				<p id='bankmsg'></p>
    			</div>
    		</div>
			<div class="well">
			<div class="row">
				<div class="col-lg-4">
						
					{{ Form::label('Account Name') }}
				 	{{ Form::text('acctname', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
				</div>
				<div class="col-lg-4">
						
					{{ Form::label('Account No') }}
				 	{{ Form::text('acctno', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
				</div>
			</div>
			</div>
			<div class="well">
			<div class="row">
				<div class="col-lg-4">
						
					{{ Form::label('Bank Name') }}
				 	{{ Form::text('bank', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
				 	{{ Form::close() }}
				</div>
			</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
				<button class="btn btn-primary bankdtls">Submit</button>					
				</div>
			</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="social">
    	<div class="row">
    		<br>
    		@if(!empty($getverify->social))
    			<p class="bg-primary" style="padding: 10px">
    				Verified
    			</p>
		    @else
		    <p class="text-left">
		      <a class="btn btn-md btn-primary" href="{{url('login/fb')}}"><i class="icon-facebook"></i>Connect to Facebook</a>
		    </p>
		    @endif
		    <br>
    	</div>
    </div>
  </div>


</div>
			</div>
@stop

@section('script')


        <script type="text/javascript">
        $(document).ready(function(){
            $('#captions').lightGallery();
        });
        </script>



{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/showcast.js') }}
{{ HTML::script('https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js') }}
{{ HTML::script('js/lightgallery.js') }}
{{ HTML::script('js/lg-fullscreen.js') }}
{{ HTML::script('js/lg-thumbnail.js') }}
{{ HTML::script('js/lg-video.js') }}
{{ HTML::script('js/lg-autoplay.js') }}
{{ HTML::script('js/lg-zoom.js') }}
{{ HTML::script('js/lg-hash.js') }}
{{ HTML::script('js/lg-pager.js') }}
{{ HTML::script('js/jquery.mousewheel.min.js') }}
{{ HTML::script('js/masonry.pkgd.min.js') }}
{{ HTML::script('js/imagesload.js') }}
<script type="text/javascript">
			var $grid = $('.grid').imagesLoaded( function() {
			  // init Masonry after all images have loaded
			  $grid.masonry({
			    // options...
			  });
			});
  
        </script>
<script>
  window.FileAPI = {
    debug:true,
    staticPath: '{{url("vendor/fileapi/FileAPI")}}', // path to '*.swf' files necessary for fallbacks
  };
</script>
  {{ HTML::script('vendor/fileapi/FileAPI/FileAPI.min.js') }}
  {{ HTML::script('vendor/fileapi/FileAPI/FileAPI.exif.js') }}
  {{ HTML::script('vendor/fileapi/jquery.fileapi.min.js') }}
  {{ HTML::script('vendor/fileapi/jcrop/jquery.Jcrop.min.js') }}
  <script>
  $('#multiupload').fileapi({
   multiple: true,
   elements: {
      ctrl: { upload: '.js-upload' },
      empty: { show: '.b-upload__hint' },
      emptyQueue: { hide: '.js-upload' },
      list: '.js-files',
      file: {
         tpl: '.js-file-tpl',
         preview: {
            el: '.b-thumb__preview',
            width: 80,
            height: 80
         },
         upload: { show: '.progress', hide: '.b-thumb__rotate' },
         complete: { hide: '.progress' },
         progress: '.progress .bar'
      }
   }
});
  </script>
@stop