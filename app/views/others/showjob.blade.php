@extends('layouts/main')

@section('content')
<br>
<br>
<div class="row">

	<div class="col-lg-12">
		<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit</a></li>
    <li role="presentation"><a href="#manage" aria-controls="manage" role="tab" data-toggle="tab">Manage Applicants</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="edit">...
    	<div class="row">
						<h3>Contract</h3>
						<hr>
		</div>
					{{ Form::model($job, array('url' => array('others/updatejob', 'files'=>true) )) }}
					{{ Form::hidden('cast_id', $value = $job->id) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">
			{{ Form::hidden('job_id', $value = $job->id) }}
			{{ Form::label('Title of Contract') }}
		 	{{ Form::text('title', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'readonly' => 'readonly', 'class' => 'form-control')) }}
		 	{{ $errors->first('castTitle', '<p class="error">:message</p>') }}
		</div>

		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Choose a Profession') }}
			<?php
			$value = '';
			?>
			<br>
			<select class='sltp form-control' name="user_spec">
				<option value="all" 
				@if($getjob->user_spec == 'all')
					selected = 'selected';
					
				@endif
				>All Professions</option>
				<option value="Photographer"
				@if($getjob->user_spec == 'Photographer')
					selected = 'selected';
				@endif
				>Photographer</option>
				<option value="Agency"
				@if($getjob->user_spec == 'Agency')
					selected = 'selected';
				@endif
				>Agency</option>
				<option value="Hair & Make-up Artist"
				@if($getjob->user_spec == 'Hair & Make-up Artist')
					selected = 'selected';
				@endif
				>Hair & Make-up Artist</option>
				<option value="Fashion stylist"
				@if($getjob->user_spec == 'Fashion stylist')
					selected = 'selected';
				@endif
				>Fashion stylist</option>
				<option value="Tattoo Artist"
				@if($getjob->user_spec == 'Tattoo Artist')
					selected = 'selected';
				@endif
				>Tattoo Artist</option>
				<option value="Ushering"
				@if($getjob->user_spec == 'Ushering')
					selected = 'selected';
				@endif
				>Ushering</option>
				@foreach($getprofession as $value)
				<option value="{{$value->name}}"
				@if($getjob->user_spec == $value->name)
					selected = 'selected';
				@endif	
				>{{$value->name}}</option>
				@endforeach	
			</select>
		</div>
	</div>
	</div>
	
	<div class="well">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			{{ Form::label('Contract Description(Email addresses are not permitted in the description)') }}
		 	{{ Form::textarea('job_description', $value = null, array('class' => 'form-control', 'readonly' => 'readonly',)) }}
		 	{{ $errors->first('job_description', '<p style="color:red;">:message</p>') }}
		</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			{{ Form::label('Contract Task(Email addresses are not permitted in the Requirement)') }}
		 	{{ Form::textarea('job_task', $value = null, array('class' => 'form-control')) }}
		 	{{ $errors->first('job_task', '<p style="color:red;">:message</p>') }}
		</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
			<div class="col-lg-5 col-sm-5">
			{{ Form::label('Payment') }}
			{{ Form::text('amount', $value = null, $attributes = array('placeholder' => 'Payment details', 'id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control'))}}
			{{ $errors->first('amount', '<p style="color:red;">:message</p>') }}
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
		{{ Form::text('area', $value = null, $attributes = array('id' => 'locality', 'class' => 'field')) }}
		<input class="field" type="hidden" id="street_number"
              disabled="true"></input>
		</div>
		<div class="col-lg-2 col-sm-2">
		<label>State</label>
		{{ Form::text('location', $value = null, $attributes = array('id' => 'administrative_area_level_1', 'class' => 'field location')) }}
              <input type="hidden" class="field" id="postal_code"
              disabled="true">
		<input class="field" type="hidden" id="route" disabled="true"></input>
		</div>
		<div class="col-lg-2 col-sm-2">
		<label>Country</label>
		{{ Form::text('country', $value = null, $attributes = array('id' => 'country', 'class' => 'field')) }}
		</div>
	</div>
	</div>
	<br>

	<div class="well">
		<div class="row">
			<div class="col-lg-5 col-sm-5">
			<label>Venue</label>
			{{ Form::text('venue', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control'))}}
			{{ $errors->first('venue', '<p style="color:red;">:message</p>') }}
			</div>
		</div>
	</div>

		<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Job starts') }}
			<br>
		 	{{ Form::selectRange('jobDay', 1, 31); }}
		 	{{ Form::selectMonth('jobMonth'); }}
		 	{{ Form::selectRange('jobYear', 2016, 2020); }}
		 	<br>			
		</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('event ends') }}
			<br>
		 	{{ Form::selectRange('Dayend', 1, 31); }}
		 	{{ Form::selectMonth('Monthend'); }}
		 	{{ Form::selectRange('Yearend', 2016, 2020); }}
		 	<br>		
		</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Expiration of cast') }}
			<br>
		 	{{ Form::selectRange('Dayexp', 1, 31); }}
		 	{{ Form::selectMonth('monthexp'); }}
		 	{{ Form::selectRange('yearexp', 2016, 2020); }}
		 	<br>			
		</div>
	</div>
	</div>
	{{ Form::close() }}
    </div>
   
    <div role="tabpanel" class="tab-pane" id="manage">
    	<div class="row">
    		<div class="col-lg-12 col-sm-12">
    			<div class="row">
    				<br> 
    				<br>
    				<div class="col-lg-3 col-sm-3">
    					<ul id="folder" class="nav nav-pills nav-stacked" role="tablist">
    						<li role="presentation"><a href="#" aria-controls="applicant" role="tab" data-toggle="tab">FOLDERS</a></li>
						  <li role="presentation" class="active"><a href="#applicant" aria-controls="applicant" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-option-vertical"></span>New Applicants</a></li>
						  <li role="presentation"><a id="confirms" href="#confirmed" aria-controls="confirmed" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-ok"></span>Confirmed</a></li>
						  <li role="presentation"><a id="discards" href="#discarded" aria-controls="discarded" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-trash"></span>Discarded</a></li>
						</ul>
						<br>
						<button class="btn btn-success form-control" id='checkoutjob' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-shopping-cart'></i> Check out</button>
    				</div>
    				<br>
    				<div class="col-lg-9 col-sm-9">
    					<div class="well" style="padding-top: 5px; padding-bottom: 5px">
    						<div class="btn-group" role="group" aria-label="...">
							  <button type="button" class="btn btn-success" id="confirm"><i class='fa fa-check'></i> confirm applicants</button>
							  <button type="button" class="btn btn-danger" id="discard"><i class='fa fa-trash-o'></i> discard applicants</button>
							</div>
    					</div>
    					<div class="row">
    					<div class="col-lg-12 col-sm-12">
    						<div id="show_div">
	    						
	    					</div>
	    					<div id="val">
	    						
	    					</div>
    						<div class="valindex">
	    						@foreach($getAllUser as $userdata)
	    							<div class="well">
	    								<div class="row">
	    									<div class="col-lg-1 col-sm-1 col-xs-1" style="background-color:">
	    										{{ Form::radio('users', $userdata->user_id) }}
	    									</div>
	    									<div class="col-lg-7 col-sm-7 col-xs-11">
	    										{{ HTML::image($userdata->imagename, 'profile picture', array('width' => '130px', 'Height' => '160px', 'class' => 'img-left')) }}
	    										<div class="text-left">
	    										<p>{{ link_to('foo/bar', $userdata->agentName, $attributes = array(), $secure = null) }}</p>
	    										<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> {{ $userdata->location}}</p>
	    										</div>
	    									</div>
	    									<div class="col-lg-4 col-sm-4">
	    										
	    									</div>
	    								</div>
	    							</div>
	    						@endforeach
	    					</div>
    					</div>
    					</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
  </div>
	</div>
	
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3>Invite Models</h3>
      </div>
      	 <div class="modal-body">
      		<div class="well">
      			<div class="row">
      				<div class="col-lg-4">
      					<select class="form-control getinvite">
      						<option>select options</option>
      						<option value="all">All</option>
      						<option value="contacted">Contacted</option>
      						<option value="favorite">favourite</option>
      					</select>
      				</div>
      			</div>
      		</div>
      		<div class="well">
      			<div class="row getdata">
      				
      			</div>
      		</div>
     	 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary sendinvite">Invite</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><i class='fa fa-shopping-cart'></i> Checkout Contract</h3>
      </div>
  			<div class="modelcheckout">
  				
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

<script type="text/javascript">
$(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>
@stop
@section('script')
{{ HTML::script('js/paginathing.js') }}

<script type="text/javascript">
	    $('.paginate').paginathing({
	    perPage: 5,
	    limitPagination: 9
		})
</script>

{{ HTML::script('js/contact.js') }}
{{ HTML::script('js/select2.min.js') }}
@stop