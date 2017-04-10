@extends('layouts.main')
@section('content')

			<ol class="bd_fst breadcrumb">
  						<li>Home</li>
  						@if(!empty($user->newmodel->displayName))
  						{{ $user->newmodel->displayName }}
  						@else
  						@endif
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
				@foreach($getplan as $plan)
				<?php
						$startdate = $plan->enddate;
				    	$month = $plan->durationToMonth;
					  $day = $plan->durationToDay;
					  $year = $plan->durationToYear;
					  $date = $year."-".$month."-".$day;

						$startdates = $plan->startdate;
				    	$stmonth = $plan->durationFromMonth;
					  $stday = $plan->durationFromDay;
					  $styear = $plan->durationFromYear;
					  $stdate = $styear."-".$stmonth."-".$stday;

					  $date1 = $plan->startdate;
						$date2 = $plan->enddate;

						$diff = abs($date2 - $date1);

						$years = floor($diff / (365*60*60*24));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
						$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

						$datecount = $months;
				?>
					<div class="row">
						<h3>Subscription Status</h3>
						<hr>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<p class="bg-info padding">
							@if($plan->plan_id == '1')
								You currently do not have any subscription plan
							@elseif($plan->plan_id == '2')
								You are currently on <strong>Afro Plus</strong>
								<br>
								<b>Created on: </b><?php echo $stdate; ?> 
								<br>
								 <b>Expiring on </b><?php echo $date ?>
							@elseif($plan->plan_id == '3')
								You are currently on <strong>Afro Unlimited</strong>
								<br>
								<b>Created on: </b><?php echo $stdate; ?> 
								<br>
								 <b>Expiring on </b><?php echo $date ?>
								 <br>
							@else
							You currently do not have any subscription plan
							@endif
							</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<p class="bg-info padding">
								Category/Discipline selections ({{$plan->cat_select}})
							</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<p class="pro-bg-side">
								Cast applications per month({{$plan->cast_apply}})
							</p>
						</div>
						
					</div>
				@endforeach
					<br>
					@if($plan->plan_id == '1' || empty($plan->plan_id))
					<div class="row">
						<div class="col-lg-4">
							<a href="/users/changesubscription" class="btn btn-primary">
								UPGRADE
							</a>
						</div>
					</div>
					@endif
			</div>
@stop