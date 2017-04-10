@extends('layouts.main')
@section('content')
  {{ HTML::style('css/lightgallery.css') }}
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
	

					<input type="hidden" name="user_id" class="user_id" value="{{$id}}">
					</a>
				</div>
				<div class="row">
					<br>
					
					<ul class="list-profile">
					@if(!empty(Auth::user()->id))
						@if(Auth::user()->id != $id)
						@if($btnfols == '2')
						<a href="#" id="btn-fol"><li>Follow<span class="text-right glyphicon glyphicon-play"></span></li></a>
						@else
						<a href="#" id="btn-unfol"><li>unfollow<span class="text-right glyphicon glyphicon-play"></span></li></a>
						@endif
						<a href="#" id="btn-fol" style="display:none"><li>Follow<span class="text-right glyphicon glyphicon-play"></span></li></a>
						<a href="#" id="btn-unfol" style="display:none"><li>unfollow<span class="text-right glyphicon glyphicon-play"></span></li></a>
						@if(Auth::user()->user_type != 'proModel' && Auth::user()->user_type != 'newFace')
						<a href="#" data-toggle="modal" data-target="#exampleModal4"><li>Send message <span class="text-right glyphicon glyphicon-play"></span></li></a>
						@elseif(!empty($checkplan))
						<a href="#" data-toggle="modal" data-target="#exampleModal4"><li>Send message <span class="text-right glyphicon glyphicon-play"></span></li></a>
						@else
						<a href="#contact" id="{{$id}}" data-toggle="modal" data-target=".bs-example-modal" class="contacterror2"><li>Send message<span class="text-right glyphicon glyphicon-play"></span></li></a>
						@endif
						@if(Auth::user()->user_type == 'proModel' || Auth::user()->user_type == 'newFace')
						@if(!empty($checkplan))
						@if(empty($getmymodels))
						<a href="#contact" id="{{$id}}" class="contact"><li>Contact <span class="text-right glyphicon glyphicon-play"></span></li></a>
						@else
						<a href="#contact" id="{{$id}}" class="contact"><li>Contacted <span class='text-right glyphicon glyphicon-play'></span></li></a>
						@endif
						@else
						<a href="#contact" id="{{$id}}" data-toggle="modal" data-target=".bs-example-modal" class="contacterror"><li>Contact<span class="text-right glyphicon glyphicon-play"></span></li></a>

						@endif
						@endif
						@if(Auth::user()->user_type != 'proModel' && Auth::user()->user_type != 'newFace')
						<a href="#contact" id="{{$id}}" data-toggle="modal" data-target="#exampleModal2"><li>Book {{ $user_type_spec }}<span class="text-right glyphicon glyphicon-play"></span></li></a>
						@endif
						@endif
					@endif

					</ul>
				</div>
			</div>
			<div class="col-lg-10 col-sm-10 dash-bd">

<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="msg" rows="5"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send">Send message</button>
      </div>
    </div>
  </div>
</div>

			<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3>Book {{ $user_type_spec }}</h3>
      </div>
      	 <div class="modal-body">
      	 <div class="well">
      	 <div class="row">
      	 <div class="col-lg-12">
      	 	<button class="btn btn-success linkto">Link to your Existing Jobs</button>
      	 </div>
      	 </div>
      	 </div>
      	 <div class="form">
      <form class="form1">
			<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Title of Event') }}
		 	{{ Form::text('title', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('title', '<p class="error">:message</p>') }}
		</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Choose a Profession') }}
			<br>
			<select class='sltp form-control' name="user_spec">
				<option value="all">All Professions</option>
				<option value="Photographer">Photographer</option>
				<option value="Agency">Agency</option>
				<option value="Hair & Make-up Artist">Hair & Make-up Artist</option>
				<option value="Fashion stylist">Fashion stylist</option>
				<option value="Tattoo Artist">Tattoo Artist</option>
				<option value="Ushering">Ushering</option>
				@foreach($getprofession as $value)
				<option value="{{$value->name}}">{{$value->name}}</option>
				@endforeach	
			</select>
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-12">
			{{ Form::label('Job Description(Email addresses are not permitted in the description)') }}
		 	{{ Form::textarea('job_description', $value = null, array('class' => 'form-control')) }}
		</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-12">
			{{ Form::label('Job Task(Email addresses are not permitted in the Requirement)') }}
		 	{{ Form::textarea('job_task', $value = null, array('class' => 'form-control')) }}
		</div>
		</div>
	</div>

	<div class="well">
		<div class="row">
			<div class="col-lg-5">
			{{ Form::label('Payment') }}
			{{ Form::text('amount', $value = null, $attributes = array('placeholder' => 'Amount', 'id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control'))}}
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
			<div class="col-lg-12 col-sm-12">
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
	</div>
	</div>
	</form>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary sendjob">Submit</button>
      </div>
    </div>
  </div>
</div>

					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">Subscription status</h4>
					      </div>
					      <div class="modal-body">
					       <p>Subscribe for a plan to contact this {{ $user_type_spec }}</p>
					       <hr>
					       <a href="/users/changesubscription" class="btn btn-default btn-success">click to subscribe</a>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>

					<div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" >
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">Subscription status</h4>
					      </div>
					      <div class="modal-body">
					       <p>Subscribe for a plan to send message to this {{ $user_type_spec }}</p>
					       <hr>
					       <a href="/users/changesubscription" class="btn btn-default btn-success">click to subscribe</a>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>

					<div class="row">
						<div class="sent">
					
						</div>

						@foreach($userDtl as $userd)
						<h3>{{ $userd->agentName }} -  {{ $user_type_spec }}</h3>
						@endforeach
						<hr>
					</div>
					<div class="row">
						<div class="col-lg-12 dash-space">
						<div class="row">
							<div class="col-lg-5">
								<p><b style="padding-right: 80px;">Location</b> 
								@foreach($userDtl as $userd)
									{{ $userd->location }}
								@endforeach
								</p>
								<p><b style="padding-right: 80px;">Website</b> @foreach($userDtl as $userd)
									{{ $userd->Website }}
									@endforeach
								</p>
								@if(empty(Auth::user()->id))
								<a href="/signup" class="btn btn-sm" id="dash">Contact {{ $user_type_spec }}</a>
								@endif
							</div>
							<div class="col-lg-7">
								@foreach($userDtl as $userd)
								<p>{{ $userd->aboutus }}</p>
								@endforeach
							</div>
						</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
						<div class="row">
							<br>
							<br>
							@foreach($userDtl as $userd)
							<h3>{{ $userd->agentName }} -  {{ $user_type_spec }} Photos</h3>
							@endforeach
							<hr>
							<br>
							<br>
							{{$viewimg}}
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

{{ HTML::script('js/contact.js') }}
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
@stop