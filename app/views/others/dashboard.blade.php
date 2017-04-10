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
						<a href="/users/mymessage"><li>messages {{$getmsgunseen}}<span class="text-right glyphicon glyphicon-play"></span></li></a>
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
					<div class="row">
						<h3>My Dashboard</h3>
						<hr>
					</div>
					@if(empty($verification->verify) || empty($verification->mobile) || empty($verification->email))
					<div class="row">
					<div class="col-lg-12 col-sm-12 dash-note smsverify">
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
						</div>
						</div>
					@endif
					<div class="row">
					@if(empty($verification->mobile))
							<div class="col-lg-6 col-sm-6">
							<h4 style="color: #fff">Mobile Verification</h4>
							<div class="sms"></div>
								<button class="btn btn-primary btn-sm" id='sendsms'>
									Click to send sms verification
								</button>
								<button class="btn btn-success btn-sm" id="sendsms2" style="display: none">
									 Message Sent! Please Wait or Click here if no message arrives
								</button>
								<button class="btn btn-success btn-sm" id="sendsms3" style="display: none">
									Message sent.. 
								</button>
								<br>
								<div id="smsmsg"></div>
								<br>
							
							<div class="row">
							<div class="col-lg-12 col-sm-11">
							<input type="text" name="sms" class="random">
								<button class="btn btn-success btn-sm" id="sendverify">
									Verify
								</button>
							</div>
							</div>
							<div class="row">
							<div class="col-lg-12 col-sm-11">
							<div id="smsverifymsg">
							</div>
							</div>
							</div>
							</div>
					@endif
					@if(empty($verification->email))
								<div class="col-lg-6 col-sm-6">
									<h4 style="color: #fff">Email Verification</h4>
									<button class="btn btn-primary btn-sm sendemail">
										Click to send email verification
									</button>
									<br>
									<div class="col-lg-5 text-center emailmsg"></div>
								</div>
					@endif
							</div>
							<br>	
					</div> 
					</div>
					@endif
					<div class="row">
						<div class="col-lg-12 col-sm-12">
						<br>
						<br>
								<h4>Latest models <span class="text-right dash-span"><a href="/modelsearch">see all</a></span></h4>
								<hr>
								<div class="col-lg-12 col-sm-12">
									@foreach($models as $model)
									<a href="/models/profile/{{ $model->user_id }}">
										{{ HTML::image($model->imagename, 'profile picture', array('width' => '70px', 'height' => '104px')) }}
									</a>
									@endforeach
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-sm-12">
								<br>
								<br>
								<div class="row">
									
									<div class="col-lg-6 col-sm-6">	
										<div class="row dash-news">
											<div class="col-lg-12 col-xs-12">
												<div class="row">
													<div class="col-lg-12 col-xs-12">
													<h4>Your followers updates <span class="text-right dash-span"><a href="/users/newspage">see all</a></span></h4>
													<hr>
													</div>
												</div>
												<div class="row" style="margin-bottom: 3px">
												<div class="col-lg-12 col-xs-12">
												<textarea class="form-control" id="newsmsg" rows="3" placeholder="Post News"></textarea>
												</div>
												</div>
												<div class="row text-right">
												<div class="col-lg-9 col-xs-8">
													
												</div>
												<div class="col-lg-3 col-xs-4">
												<button type="button" class="btn btn-sm btn-primary text-right form-control" id="sendnews">Send</button>
												</div>
												</div>
											<div class="shownews row">
												{{$status}}	
											</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6">
										<h4>{{ $user_type_spec }} near you</h4>
										<hr>
										<div class="row">
										@foreach($otherpartner as $partner)
										<div class="col-lg-2 col-sm-2" style="margin-right: 5px;">
											<a href="/others/showprofile/{{ $partner->user_id }}">
											{{ HTML::image($partner->imagename, 'profile picture', array('width' => '70px', 'height' => '104px')) }}
											<br>
											{{ $partner->agentName }}
										</a>
										</div>
										@endforeach
										</div>
									</div>
								
								</div>
								<div class="row">
										<div class="col-lg-6 col-sm-6">
						<br>
						<br>
								<h4>Your upcoming castings <span class="text-right dash-span"><a href="">see all</a></span></h4>
								<hr>
								@if(!empty($values))
								<div class="row">
								<div class="col-lg-12 col-sm-12">

										<table class="table table-striped dash-table">
								{{$values}}
								</table>
								</div>
								</div>
								@else
								<div class="alert alert-danger" style="padding: 10px;">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p>You haven't created any castings yet</p>
								</div>
								@endif
								<br>
								<a href="/others/newcasting" class="btn-col btn btn-primary btn-sm">POST A CAST</a>
						</div>
							<div class="col-lg-6 dash-img">
								<h4>News Feed</h4>
								<hr>
								<div id="rssOutput"></div>
							</div>
								</div>
						</div>
						
					</div>
			</div>

@stop
@section('script')
{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop