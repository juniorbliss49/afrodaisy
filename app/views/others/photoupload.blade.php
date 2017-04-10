@extends('layouts.welcome')
@section('content')

					
<div class="container">
	<div class="row">
				<div class="col-lg-6">
			<h2>Upload your photos</h2>
			<p>To present yourself professionally upload a profile picture. </p>
			<div class="well">
				{{ Form::open(array('url'=>'/others/uploadImage', 'files'=>true)) }}
		<p>
			{{ Form::label('image', 'Choose an image') }}
			{{ Form::file('image') }}
			{{ Form::hidden('image_type', 'profileImage') }}
			{{ $errors->first('image', '<p style="color:red"><i>:message</i></p>') }}
		</p>
		<p>
				  {{ Form::submit('UPLOAD PHOTO',  $attributes = array('size' => '10', 'class' => 'btn-col btn btn-primary btn-lg btn-block')) }}
		</p>
		{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop