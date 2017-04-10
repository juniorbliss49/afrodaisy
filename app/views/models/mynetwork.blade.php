@extends('layouts.main')
@section('content')

			<ol class="bd_fst breadcrumb">
  						<li>Home</li>
  						<li>Welcome uche ebere</li>
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
						<h3> Networks</h3>
						<h4><b>View and manage your contacted professionals here</b></h4>
						<hr>
					</div>
					<div class="row">
						{{$views}}
					</div>
					
			</div>

@stop