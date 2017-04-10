@extends('layouts.main')

@section('content')
<ol class="bd_fst breadcrumb">
  						<li>Home</li>
  						<li>Welcome {{ $user->others->agentName }}</li>
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

	<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#jobnew" aria-controls="jobnew" role="tab" data-toggle="tab">My New Contract Invitation</a></li>
    <li role="presentation"><a href="#jobapply" aria-controls="jobapply" role="tab" data-toggle="tab">My Contract Application</a></li>
    <li role="presentation"><a href="#jobprev" aria-controls="jobprev" role="tab" data-toggle="tab">My Previous Contract</a></li>
    <li role="presentation"><a href="#jobdeclined" aria-controls="castdeclined" role="tab" data-toggle="tab">My Declined Contract</a></li>
  </ul>

  <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
				  <div class='modal-dialog' role='document'>
				    <div class='modal-content'>
				        <div id="castapplyview">
		    				
		    			</div>
				      <div class='modal-footer'>
				        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				      </div>
				    </div>
				  </div>
				</div>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="jobnew">
    	<div class="row">
    		<div class="col-lg-12">
    			<br>
    			<br>
    			<div id="castviews">
			    </div>
    			@foreach($jobnew as $newjob)
	    			<div class="row casting-bg" id="hide{{$newjob->job_id}}">
	    				<div class="col-lg-2">
    						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
                        </div>
                        <div class="col-lg-7" style="padding-top: 20px; padding-left: 50px;">
                            <a href="showcast/{{ $newjob->job_id }}">{{ $newjob->title }}</a>
                            <h5>Location: {{ $newjob->location }}</h5>
                            <h5>Amount: {{ $newjob->amount }}</h5>
                            @if(empty($newjob->jobStatus))
                            <button id="{{$newjob->job_id}}" class="btn btn-default castapply"  style="background-color: #54d7e3; color: #fff;">Apply</button>
                            @else
                            <h5>Status: Confirmed</h5>
                            @endif
                            
                            <div class="jobview{{$newjob->job_id}}">
			    			</div>
                            <br>
                            <br>
                        </div>
                         <div class="col-lg-3">
                        <br>
                        <br>
                        <br>
                        	<button id="{{$newjob->job_id}}" data-toggle="modal" data-target="#myModal" class="btn btn-default viewjob" style="background-color: #54d7e3; color: #fff;">View Contract</button>
                        </div>
	    			</div>
	    			<br>
	    			<br>
    			@endforeach
    		</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="jobapply">
    	<div class="row">
    		<div class="col-lg-12">
    			<br>
    			<br>
    			{{$view}}
    		</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="jobprev">
    	<div class="row">
            <div class="col-lg-12">
                <br>
                <br>
                @foreach($jobprevious as $prev)
                    <div class="row casting-bg">
                        <div class="col-lg-2">
                        {{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
                        </div>
                        <div class="col-lg-7" style="padding-top: 20px; padding-left: 50px;">
                            <a href="showcast/{{ $prev->job_id }}">{{ $prev->title }}</a>
                            <h5>Location: {{ $prev->location }}</h5>
                            <h5>Amount: {{ $prev->amount }}</h5>
                            <br>
                            <br>
                        </div>
                         <div class="col-lg-3">
                        <br>
                        <br>
                        <br>
                            <button id="{{$prev->job_id}}" data-toggle="modal" data-target="#myModal" class="btn btn-default viewcasts" style="background-color: #54d7e3; color: #fff;">VIEW CAST</button>
                        </div>
                    </div>
                    <br>
                    <br>
                @endforeach    
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="jobdeclined">
    	<div class="row">
            <div class="col-lg-12">
                <br>
                <br>
                @foreach($jobdeclined as $prev)
                    <div class="row casting-bg">
                        <div class="col-lg-2">
                        {{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
                        </div>
                        <div class="col-lg-7" style="padding-top: 20px; padding-left: 50px;">
                            <a href="showcast/{{ $prev->job_id }}">{{ $prev->title }}</a>
                            <h5>Location: {{ $prev->location }}</h5>
                            <h5>Amount: {{ $prev->amount }}</h5>
                            <br>
                            <br>
                        </div>
                         <div class="col-lg-3">
                        <br>
                        <br>
                        <br>
                            <button id="{{$prev->job_id}}" data-toggle="modal" data-target="#myModal" class="btn btn-default viewcasts" style="background-color: #54d7e3; color: #fff;">VIEW CAST</button>
                        </div>
                    </div>
                    <br>
                    <br>
                @endforeach    
            </div>
        </div>
    </div>
  </div>

</div>
@stop
@section('script')
{{ HTML::script('js/contact.js') }}
@stop