@extends('layouts.main')
@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<style type="text/css">
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#eventForm .dateContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

			<ol class="bd_fst breadcrumb">
  						<li>Home</a></li> 
  						<li>{{ $user->others->agentName }}</li>
					</ol>
					<hr>
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
			@if(!empty($getverify))
					<div class="row">
						<h3>Create New cast</h3>
						<hr>
					</div>
					{{ Form::open(array('url' => 'others/createcast', 'files'=>true, 'id'=>"eventForm")) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-6 col-sm-4">
			{{ Form::label('Title of cast') }}
		 	{{ Form::text('title', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('title', '<p style="color:red;">:message</p>') }}
		</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Cast Category') }}
			<br>
		 	<select name="categories">
		 			<option value="">--Please select--</option>
		 		@foreach($categories as $cat)
		 			<option value="{{ $cat->id }}">{{ $cat->name }}</option>
		 	@endforeach
		 	</select>
		 	{{ $errors->first('categories', '<p style="color:red;">:message</p>') }}
		</div>
	</div>
	</div>
	<div class="well">
			<label>Cast Type</label>
		<div class="row">
			@foreach($dis as $disc)
			<div class="col-lg-4 col-sm-4">
			{{ Form::checkbox('cat[]', $disc->id) }} {{$disc->name}}
			</div>
			@endforeach
			{{ $errors->first('cat', '<p style="color:red;"><i>:message</i></p>') }}
	</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Gender') }}
			<br>
		 	{{ Form::select('gender', array('' => 'Gender', 'male' => 'Male', 'female' => 'Female', 'both' => 'Both'), '', $attributes = array('class' => 'sltp')) }}
		 	{{ $errors->first('gender', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			{{ Form::label('Cast Description(Email addresses are not permitted in the description)') }}
		 	{{ Form::textarea('casting', $value = null, array('class' => 'form-control')) }}
		</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			{{ Form::label('Cast Requirement(Email addresses are not permitted in the Requirement)') }}
		 	{{ Form::textarea('require', $value = null, array('class' => 'form-control')) }}
		</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">
			<p>{{ Form::radio('paymethod', 'paid') }} Paid</p>
			{{ $errors->first('paymethod', '<p style="color:red;">:message</p>') }}
		</div>
		<div class="col-lg-4 col-sm-4">
			<p>{{ Form::radio('paymethod', 'tfp') }} TFP(Trade for Print)</p>
		</div>
		<div class="col-lg-4 col-sm-4">
			<p>{{ Form::radio('paymethod', 'Other') }} Other</p>
		</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-sm-5">
			{{ Form::text('paydetail', $value = null, $attributes = array('placeholder' => 'Write amount without comma or fullstop', 'id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control'))}}
			{{ $errors->first('paydetail', '<p style="color:red;">:message</p>') }}
			</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
	<div class="col-lg-5 col-sm-4">
		{{ Form::label('Enter your town or city') }}
		<input id="autocomplete" placeholder="town or city"
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
	<div class="well">
		<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			{{ Form::label('Venue') }}
		 	{{ Form::text('venue', $value = null, array('class' => 'form-control')) }}
		{{ $errors->first('venue', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">

			{{ Form::label('event starts') }}
			<br>
		 	<div class="col-lg-12 dateContainer">
            <div class="input-group input-append date" id="startDatePicker">
                <input type="text" class="form-control" name="startDate" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
		 	<br>
		 	{{ $errors->first('Daycast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Monthcast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Yearcast', '<p class="error">:message</p>') }}			
		</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('event ends') }}
			<br>
		 	<div class="col-lg-12 dateContainer">
            <div class="input-group input-append date" id="endDatePicker">
                <input type="text" class="form-control" name="endDate" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
		 	<br>
		 	{{ $errors->first('Daycast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Monthcast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Yearcast', '<p class="error">:message</p>') }}			
		</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Expiration of cast') }}
			<br>
		 	<div class="col-lg-12 dateContainer">
            <div class="input-group input-append date" id="ExpDatePicker">
                <input type="text" class="form-control" name="expDate" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
		 	<br>
		 	{{ $errors->first('DayExp', '<p class="error">:message</p>') }}
		 	{{ $errors->first('MonthExp', '<p class="error">:message</p>') }}
		 	{{ $errors->first('YearExp', '<p class="error">:message</p>') }}			
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4 col-sm-4">
			<div class="col-lg-12 col-sm-12" style="font-size: 70%">
			{{ Form::label('image', 'Choose an image for the event') }}
			{{ Form::file('image') }}
			{{ $errors->first('image', '<p class="error">:message</p>') }}
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
	@else
	@if(empty($verification->verify))

		<div class="row">
			<div class="col-lg-12 col-sm-12">
			<p><strong>Consider the following if your Afrodaisy models account is yet to be approved</strong></p>
			<p>You haven’t uploaded any photos</p>
			<p>Your  photo quality might not be up to afrodaisy models standard</p>
			<p>Your E-mail may be incorrect or yet to be confirmed</p>
			<p>Take a look at our photo session if you need to improve your photo qualitye</p>
			<p>For more inquiries please contact us at info@afrodaisy.com</p>
			<p>For more information please contact us at info@afrodaisy.com</p>
	@endif
	@if(empty($verification->mobile))
			<p>Your mobile number has not been verified</p>
	@endif
			<p>Please be verified in other to post a cast</p>
		</div>
		</div>
	@endif

			</div>

<script>
$(document).ready(function() {
    $('#startDatePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the start date field
            $('#eventForm').formValidation('revalidateField', 'startDate');
        });

    $('#endDatePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            $('#eventForm').formValidation('revalidateField', 'endDate');
        });

    $('#ExpDatePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            $('#eventForm').formValidation('revalidateField', 'expDate');
        });

    $('#eventForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required'
                        }
                    }
                },
                startDate: {
                    validators: {
                        notEmpty: {
                            message: 'The start date is required'
                        },
                        date: {
                            format: 'MM/DD/YYYY',
                            max: 'endDate',
                            message: 'The start date is not a valid'
                        }
                    }
                },
                endDate: {
                    validators: {
                        notEmpty: {
                            message: 'The end date is required'
                        },
                        date: {
                            format: 'MM/DD/YYYY',
                            min: 'startDate',
                            message: 'The end date is not a valid'
                        }
                    }
                },
                expDate: {
                    validators: {
                        notEmpty: {
                            message: 'The expiration date is required'
                        },
                        date: {
                            format: 'MM/DD/YYYY',
                            max: 'startDate',
                            message: 'The expiration date is not a valid'
                        }
                    }
                }
            }
        })
        .on('success.field.fv', function(e, data) {
            if (data.field === 'startDate' && !data.fv.isValidField('endDate')) {
                // We need to revalidate the end date
                data.fv.revalidateField('endDate');
            }

            if (data.field === 'endDate' && !data.fv.isValidField('startDate')) {
                // We need to revalidate the start date
                data.fv.revalidateField('startDate');
            }

            if (data.field === 'expDate' && !data.fv.isValidField('startDate')) {
                // We need to revalidate the start date
                data.fv.revalidateField('startDate');
            }
        });
});
</script>

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