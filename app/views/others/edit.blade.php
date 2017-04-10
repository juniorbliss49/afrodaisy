@extends('layouts.main')

@section('content')
  {{ HTML::style('vendor/fileapi/jcrop/jquery.Jcrop.min.css') }}
  {{ HTML::style('vendor/fileapi/statics/main.css') }}
  {{ HTML::style('css/lightgallery.css') }}

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
			<div class="col-lg-10 dash-bd">
					<div class="row">
						<h3>Edit profile</h3>
						<hr>
					</div>
					<div class="row">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">{{$user_type_spec}} details</a></li>
    <li role="presentation"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Change Password/Email</a></li>
    <li role="presentation"><a href="#logo" aria-controls="logo" role="tab" data-toggle="tab">{{$user_type_spec}} Images</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
    	<div class="row">
    		<div class="col-lg-12">
    		<br>
    		<br>
    			{{ Form::model($Others, array('url' => array('others/edits'), 'id'=>'form' )) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label($user_type_spec." Name") }}
		 	{{ Form::text('agentName', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('agentName', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
	</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('CAC number') }}
		 	{{ Form::text('CAC', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Website') }}
		 	{{ Form::text('Website', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
	</div>
	</div>
	<br>
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Address') }}
		 	{{ Form::text('address', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('address', '<p style="color:red;"><i>:message</i></p>') }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Telephone') }}
			<br>
		 	{{ Form::text('telephone', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('telephone', '<p style="color:red;"><i>:message</i></p>') }}			
		</div>
		<div class="col-lg-4">
		{{ Form::label('landline') }}
		 	{{ Form::text('landline', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
	</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4">
			{{ Form::label('Chairman Name') }}
		 	{{ Form::text('chairmanname', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Chairman Telephone') }}
		 	{{ Form::text('chairmantel', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
		<div class="col-lg-4">
			{{ Form::label('Chairman Email') }}
		 	{{ Form::text('chairmanemail', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4">
			{{ Form::label('About us') }}
		 	{{ Form::textarea('aboutus', $value = null, array('class' => 'form-control')) }}
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-1">
			<div class="form-group">
				<input type="button" name="" class="btn-col btn btn-primary btn-sm" id="update" value="UPDATE" id="update">
			</div>
		</div>
	</div>
	<div class="row">
					<br>
    	<div id="proUpdate" class="bg-primary" style="padding: 10px; display: none;"></div>
					</div>
	{{ Form::close() }}	
    		</div>
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
							{{ Form::label('Old Password') }}
						 	{{ Form::password('oldpassword', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
						</div>
						<div class="col-lg-4">
							{{ Form::label('New Password') }}
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
    <div role="tabpanel" class="tab-pane" id="logo">
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
		@if(isset($getgallery))
			<div class="demo-gallery">
            <ul id="lightgallery" class="list-unstyled row">
			@foreach($getgallery as $image)
 					<li class="col-xs-12 col-sm-4 col-md-3 col-lg-3" data-responsive="/{{$image->imagename}}" data-src="/{{$image->imagename}}" data-sub-html="<button class='btn btn-xs btn-warning delpix' id={{$image->id}}><i class='fa fa-trash-o'></i> Delete</bottun><button class='btn btn-xs btn-primary setprofile' id={{$image->id}}><i class='fa fa-user'></i> Set as Profile Picture</bottun>" style='margin-bottom: 5px' id="pix{{$image->id}}">
                    <a href>
                        <img class="text-left" src="/{{$image->imagename}}" height="150px">
                    </a>
                	</li>
			@endforeach
            </ul>
            </div>
		@endif
	</div>
    </div>
  </div>

</div>
			</div>


@stop
@section('script')


        <script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
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