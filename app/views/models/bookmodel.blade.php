@extends('layouts.main')

@section('content')
<div class="row">
	<div class="row">
		<div class="col-lg-12">
			<p class="text-left"></p>
			<p class="text-left"></p>
		</div>
	</div>
	<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-12">
						<h4>{{ $user->newmodel->firstName}} {{$user->newmodel->lastName }}</h4>
						<h4><span class="glyphicon glyphicon-map-marker"></span> {{ $user->newmodel->country }} , {{$user->newmodel->location}}</h4>
					</div>	
				</div>
				<div class="row">
					<div class="col-lg-12 text-center pro-bg-side">
						{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '620px')) }}
						
					</div>
				</div>
				<div class="row pro-bg-side">
					<h4>ABOUT ME</h4>
					<p>{{ $user->newmodel->about}}</p>
				</div>
			</div>
			<div class="col-lg-1">
				
			</div>
			<div class="col-lg-3">
					<br>
					<br>
					<br>
				<div class="row">
					<div class="col-lg-12 pro-bg-side">
						<h5>INVITE MODEL</h5>
						<button class="btn btn-primary existing" data-toggle="modal" data-target="#exampleModal">
							Invite to apply to an exixting cast
						</button>
						<br>
						<br>
						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
							Create new cast for Invitation
						</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-12 pro-bg-side">
						<h5>More Models in this Location</h5>
						<br>
						@foreach($getmodelscloseby as $closeby)

						<div class="row">
							<div class="col-lg-4">
								{{ HTML::image($closeby->imagename, 'profile picture', array('width' => '70px', 'height' => '70px')) }}
							</div>
							<div class="col-lg-8 text-left">
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
		 	{{ Form::textarea('casting') }}
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
		<div class="col-lg-4">
		{{ Form::label('Event State') }}
		<br>
		{{ Form::select('location', array('' => '--Please select--', 'Abia' => 'Abia', 'Abuja' => 'Abuja', 'Adamawa' => 'Adamawa', 'Anambra' => 'Anambra', 'Akwa Ibom'=>'Akwa Ibom', 'Bauchi' => 'Bauchi', 'Bayelsa' => 'Bayelsa', 'Benue'=>'Benue', 'Borno'=>'Borno', 'Cross River'=>'Cross River',  'Delta'=>'Delta', 'Ebonyi'=>'Ebonyi', 'Enugu'=>'Enugu', 'Edo'=>'Edo', 'Ekiti'=>'Ekiti', 'Gombe'=>'Gombe', 'Imo'=>'Imo', 'Jigawa'=>'Jigawa', 'Kaduna'=>'Kaduna', 'Kano'=>'Kano', 'Katsina'=>'Katsina', 'Kebbi'=>'Kebbi', 'Kogi'=>'Kogi', 'Kwara'=>'Kwara', 'Lagos'=>'Lagos', 'Nasarawa'=>'Nasarawa', 'Niger'=>'Niger', 'Ogun'=>'Ogun', 'Ondo'=>'Ondo', 'Osun'=>'Osun', 'Oyo'=>'Oyo', 'Plateau'=>'Plateau', 'Rivers'=>'Rivers', 'Sokoto'=>'Sokoto', 'Taraba'=>'Taraba', 'Yobe'=>'Yobe', 'Zamfara'=>'Zamfara', 'Others'=> 'Others'),'', $attributes = array('class' => 'sltp')) }}
		{{ $errors->first('location', '<p class="error">:message</p>') }}
	</div>
		<div class="col-lg-6">
			{{ Form::label('Enter Event town or city') }}
		 	{{ Form::text('city', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
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
@stop
@section('script')
{{ HTML::script('js/message.js') }}
{{ HTML::script('js/contact.js') }}
@stop