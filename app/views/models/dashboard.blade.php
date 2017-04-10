@extends('layouts.main')
@section('content')

			<ol class="bd_fst breadcrumb">
  						<li>Home</li>
  						<li>Welcome {{$user->NewModel->displayName}}</li>
					</ol>
					<hr>
<div class="col-lg-2 col-sm-2">
				<div class="row">
					<a href="">
						@if(isset($user->photoupload->imagename))
						{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '130px', 'class' => 'img-responsive imgbg')) }}
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
						<div class="col-lg-6 col-sm-6 dash-space">
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
									<br>
								<div class="shownews row">
									{{$status}}	
								</div>
								</div>
							</div>

							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="exampleModalLabel">News Update</h4>
							      </div>
							      <div class="modal-body">
							        <form>
							          <div class="form-group">
							            <label for="message-text" class="control-label">News:</label>
							            
							          </div>
							        </form>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        
							      </div>
							    </div>
							  </div>
							</div>

							<br>
						<div class="row">
							<div class="col-lg-12">
								<br>
								<h4>Latest castings <span class="text-right dash-span"><a href="/casting">see all</a></span></h4>
								<hr>
								<table class="table table-striped dash-table">
									{{$values}}
								</table>
							</div>
						</div>
						</div>
						<div class="col-lg-6 col-sm-6">
						<div class="row">
							<div class="col-lg-12 dash-img">
								<h4>New Models <span class="text-right dash-span"><a href="/modelsearch">see all</a></span></h4>
								<hr>
								@foreach($models as $model)
									<div class="col-lg-3 col-xs-6" class="thumbnail">
									<a href="/models/profile/{{$model->user_id}}">
									@if(!empty($model->imagename))
										{{ HTML::image($model->imagename, $model->displayName, array('width' => '100%', 'height' => '60%', 'class' => 'img-responsive')) }}
									@else
										{{ HTML::image('img/photo.jpg', 'profile picture', array('class' => 'img-responsive','width' => '59px', 'height' => '140px')) }}
									@endif
									</a>
									</div>
								@endforeach
							</div>
						</div>
						<div class="row">
							{{$marketplace}}
						</div>
						<div class="row">
							<div class="col-lg-12 dash-img">
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