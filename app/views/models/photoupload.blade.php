@extends('layouts.welcome')
@section('content')

<style type="text/css">
	
label {
   pointer: cursor;
   /* Style as you please, it will become the visible UI component. */
}

#upload-photo {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
</style>

<ol class="bd_fst breadcrumb">
  						<li>{{ $user}}</li>
					</ol>
					<hr>
<div class="container">
	<div class="row">
	{{ Form::open(array('url'=>'models/uploadImage', 'files'=>true)) }}
		<div class="col-lg-12">
			<h2>Select model category</h2>
			<div class="well">
		<div class="row">
		<div class="length">
			<h4></h4>
			<a class="btn btn-defualt reset" id="dash" style="display: none">RESET</a>
		</div>

		<input type="hidden" name="plan" id="plan" value="{{$plan}}">
					@foreach($Discipline as $catry)
						<div class="col-lg-3 col-sm-4">
							{{ Form::checkbox('category[]', $catry->id) }} {{$catry->name}}
						</div>
					@endforeach
					<br>
					{{ $errors->first('category', '<p style="color:red"><i>:message</i></p>') }}
				</div>
				</div>
				</div>
		<div class="col-lg-12">
			<h2>Upload your photos</h2>
			<p>To present yourself professionally upload a profile picture. </p>
			<div class="well">
		<p>
			{{ Form::label('upload-photo', 'Browse...') }}
			{{ Form::file('image', '', array('id' => 'upload-photo')) }}
			{{ Form::hidden('image_type', 'profileImage') }}
			{{ $errors->first('image', '<p style="color:red"><i>:message</i></p>') }}
			<br>
		</p>
			</div>
		</div>
		<div class="col-lg-12">
			<p>
				  {{ Form::submit('UPLOAD',  $attributes = array('size' => '10', 'class' => 'btn-col btn btn-primary btn-lg btn-block uploadsend')) }}
		</p>
		{{ Form::close() }}
		</div>
	</div>
</div>

@stop
@section('script')
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::script('js/showcast.js') }}
@stop