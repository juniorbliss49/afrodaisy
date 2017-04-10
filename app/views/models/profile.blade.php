@extends('layouts.main')

@section('content')
{{ HTML::style('css/lightgallery.css') }}
		<br>
			<input type="hidden" name="user_id" id="user_id" value="{{$id}}">
			<div class="row text-center pro-bg">
				<div class="col-lg-2 col-sm-2  text-center"> 
					@if(isset($user->photoupload->imagename))
						{{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '160px', 'height' => '180px', 'class' => 'img-responsive text-center')) }}
					@else
						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '160px', 'height' => '180px', 'class' => 'img-responsive text-center')) }}
					@endif
				</div>
				<div class="col-lg-8 col-sm-8">
				<div class="pro-dtl">
					<h3>{{ $user->newmodel->displayName }}</h3>
					<p> <span class="glyphicon glyphicon-user"></span>
					@if($user->user_type == 'proModel')
						Professional Model
					@elseif($user->user_type == 'newFace')
						New Face (aspiring model)
					@endif
					  <span class="glyphicon glyphicon-map-marker" style="color: #fff ; padding-left: 10px"></span> {{$user->newmodel->location}}, {{ $user->newmodel->town }}</p>
					  @if(isset(Auth::user()->id))
					  @if(Auth::user()->id != $id)
				<div class="row">
				<div class="col-lg-12 col-xs-12 bnt-str">
					@if(Auth::user()->user_type != 'proModel' && Auth::user()->user_type != 'newFace')
					<a href="/users/bookmodel/{{$id}}" class="btn btn-default btn-primary">BOOK MODEL</a>
					@endif
					@if($btnfols == '2')
					<button id="btn-fol" class="btn btn-default btn-success"><span class="glyphicon glyphicon-ok" style="color: #fff"></span> FOLLOW</button>
					@else
					<button id="btn-unfol" class="btn btn-default btn-success"><span class="glyphicon glyphicon-minus" style="color: #fff"></span> UNFOLLOW</button>
					@endif
					<button id="btn-fol" class="btn btn-default btn-success" style="display:none"><span class="glyphicon glyphicon-ok" style="color: #fff"></span> FOLLOW</button>
					<button id="btn-unfol" class="btn btn-default btn-success" style="display:none"><span class="glyphicon glyphicon-minus" style="color: #fff"></span> UNFOLLOW</button>					

					<botton data-toggle="modal" data-target="#exampleModal" class="pro-lnk btn btn-sm" style="padding:7px; background-color:#fff; color:#000"><span class="glyphicon glyphicon-envelope"></span></botton>
					@if($btns == '2')
					<botton id="like" class="pro-lnk btn btn-sm" style="padding:7px;background-color:#fff; color:#000"><span class="glyphicon glyphicon-thumbs-up"></span></botton>
					@else
					<botton id="dislike" class="pro-lnk btn btn-sm" style="padding:7px;background-color:#f47735;"><span class="glyphicon glyphicon-thumbs-up"></span></botton>
					@endif
					<botton id="like" class="pro-lnk btn btn-sm" style="padding:7px;background-color:#fff; color:#000;display:none"><span class="glyphicon glyphicon-thumbs-up"></span></botton>
					<botton id="dislike" class="pro-lnk btn btn-sm" style="padding:7px;background-color:#f47735; display:none"><span class="glyphicon glyphicon-thumbs-up"></span></botton>
				</div>
				<div class="sent">
					
				</div>
				</div>
				@endif
				@else
				<div class="row">
				<div class="col-lg-12 col-xs-12 bnt-str">
					<a href="/signup" class="btn btn-default btn-primary">BOOK MODEL</a>
				</div>
				</div>
				@endif
				<br>
				</div>
				</div>
				<div class="col-lg-2 col-sm-2">
				@if(isset(Auth::user()->id))
				
				<div class="row" style="color: #fff; border-left: 1px solid #fff;">
				<br>
				<br>
					<div class="col-lg-12" style="margin-left: 8px">
						<div class="row" style="padding-bottom: 6px">
						<a href="#" data-toggle="tooltip" data-placement="bottom" html=true title="{{$usershow}}" style="color: #fff"><span class="glyphicon glyphicon-thumbs-up"></span>  Likes (<span class="btnlk">{{$like}}</span>)</a >
						</div>
						<div class="row" style="padding-bottom: 6px">
						<a href="#" class="fol" style="color: #fff" data-toggle="modal" data-target=".bs-example-modal-sm"> <span class="glyphicon glyphicon-ok" style="color: #fff">  </span> followers (<span class="btnfl">{{$fol}}</span>)</a>
						</div>
						<div class="row">
						<a href="#" class="flwer" style="color: #fff" data-toggle="modal" data-target=".bs-example-modal"> <span class="glyphicon glyphicon-ok" style="color: #fff">  </span> following (<span>{{$follower}}</span>)</a>
						</div>
					</div>
				</div>
				@endif
				</div>
				</div>
	<br>
	<br>
		<div class="row">
			<div class="col-lg-4 col-sm-4 hidden-xs">

				<div class="row" style="border: 1px solid #000">
				
					<h5 style="color: #222; font-weight: bold;">TRUST</h5>
					<br>
					<div class="col-lg-12 col-sm-12">
						<div class="row">
							<div class="col-lg-4 col-sm-4">
								<p class="text-center">
								<span style="background: #a1d569; border-radius: 25px; padding-top: 22px; padding-bottom: 15px; padding-left: 15px; padding-right: 10px; color: #fff">
									<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
								</span>
									<br>
									<br>
									Email<br>Verification<br>
									@if(!empty($verify->email))
									<span class="glyphicon glyphicon-ok" style="color: #111; font-weight: bold;"></span>
									@else
									<span class="glyphicon glyphicon-remove" style="color: #111; font-weight: bold;"></span>
									@endif
								</p>
							</div>
							<div class="col-lg-4 col-sm-4">
								<p class="text-center">
								<span style="background: orange; border-radius: 30px; padding-top: 23px; padding-bottom: 15px; padding-left: 23px; padding-right: 20px; color: #fff">
								<i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
								</span>
								<br>
								<br>
								Mobile<br>Verification<br>
								@if(!empty($verify->mobile))
								<span class="glyphicon glyphicon-ok" style="color: #111; font-weight: bold;"></span>
								@else
									<span class="glyphicon glyphicon-remove" style="color: #111; font-weight: bold;"></span>
								@endif
								</p>		
							</div>
							<div class="col-lg-4 col-sm-4">
								<p class="text-center">
								<span style="background: #50c1e9;; border-radius: 45px; padding-top: 23px; padding-bottom: 12px; padding-left: 14px; padding-right: 10px; color: #fff">
								<i class="fa fa-desktop fa-2x" aria-hidden="true"></i>
								</span>
								<br>
								<br>
								Social<br>Verification<br>
								@if(!empty($verify->social))
								<span class="glyphicon glyphicon-ok" style="color: #111; font-weight: bold;"></span>
								@else
									<span class="glyphicon glyphicon-remove" style="color: #111; font-weight: bold;"></span>
								@endif
								</p>
							</div>
						</div>
				</div>
				</div>
				<br>
				<div style="border: 1px solid #000; padding: 30px">
				<div class="row ">
					<h5 style="color: #222; font-weight: bold;">BIO</h5>
					<div class="col-lg-12 col-sm-12">
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<h5>Gender</h5>
							</div>
							<div class="col-lg-6 col-sm-6">
								<h5>{{$user->newmodel->gender}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<h5>HEIGHT</h5>
							</div>
							<div class="col-lg-6 col-sm-6">
								<h5>{{$user->newmodel->Height}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<h5>Age</h5>
							</div>
							<div class="col-lg-6 col-sm-6">
								<h5>{{$user->newmodel->Age}}</h5>
							</div>
						</div>
					</div>
				<hr>
				</div>
				<div class="row">
					<h5 style="color: #222; font-weight: bold;">CATEGORIES</h5>
					<div class="col-lg-12 col-sm-12">
						<div class="row">
					@foreach($dis as $disk)
					<div class="col-lg-6 col-sm-6">
						<h5>{{$disk->name}}</h5>
					</div>
					@endforeach	
						</div>
					</div>
				<hr>
				</div>
				<div class="row">
					<h5 style="color: #222; font-weight: bold;">TYPE</h5>
				<div class="col-lg-12 col-sm-12">
						<div class="row">
					@foreach($cat as $cats)
					<div class="col-lg-6 col-sm-6">
						<h5>{{$cats->name}}</h5>
					</div>
					@endforeach	
						</div>
					</div>
				</div>	
				</div>
			</div>
			
			<div class="col-lg-8 col-sm-8">
				<div>
	{{$viewimg}}

</div>
			</div>
			<div class="col-lg-4 col-sm-4 hidden-lg visible-xs">
				<div class="row" style="border: 1px solid #000">
				
					<h5 style="color: #222; font-weight: bold;">TRUST</h5>
					<br>
					<div class="col-lg-12 col-sm-12">
						<div class="row">
							<div class="col-lg-4 col-sm-4 col-xs-4">
								<p class="text-center">
								<span style="background: #a1d569; border-radius: 25px; padding-top: 22px; padding-bottom: 15px; padding-left: 15px; padding-right: 10px; color: #fff">
									<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
								</span>
									<br>
									<br>
									Email<br>Verification<br>
									@if(!empty($verify->email))
									<span class="glyphicon glyphicon-ok" style="color: #111; font-weight: bold;"></span>
									@else
									<span class="glyphicon glyphicon-remove" style="color: #111; font-weight: bold;"></span>
									@endif
								</p>
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-4">
								<p class="text-center">
								<span style="background: orange; border-radius: 30px; padding-top: 23px; padding-bottom: 15px; padding-left: 23px; padding-right: 20px; color: #fff">
								<i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
								</span>
								<br>
								<br>
								Mobile<br>Verification<br>
								@if(!empty($verify->mobile))
								<span class="glyphicon glyphicon-ok" style="color: #111; font-weight: bold;"></span>
								@else
									<span class="glyphicon glyphicon-remove" style="color: #111; font-weight: bold;"></span>
								@endif
								</p>		
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-4">
								<p class="text-center">
								<span style="background: #50c1e9;; border-radius: 45px; padding-top: 23px; padding-bottom: 12px; padding-left: 14px; padding-right: 10px; color: #fff">
								<i class="fa fa-desktop fa-2x" aria-hidden="true"></i>
								</span>
								<br>
								<br>
								Social<br>Verification<br>
								@if(!empty($verify->social))
								<span class="glyphicon glyphicon-ok" style="color: #111; font-weight: bold;"></span>
								@else
									<span class="glyphicon glyphicon-remove" style="color: #111; font-weight: bold;"></span>
								@endif
								</p>
							</div>
						</div>
				</div>
				</div>
				<br>
				<div style="border: 1px solid #000; padding: 30px">
				<div class="row">
					<h5 style="color: #222; font-weight: bold;">BIO</h5>
					<div class="col-lg-12 col-sm-12">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<h5>Gender</h5>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<h5>{{$user->newmodel->gender}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<h5>HEIGHT</h5>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<h5>{{$user->newmodel->Height}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<h5>Age</h5>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<h5>{{$user->newmodel->Age}}</h5>
							</div>
						</div>
					</div>
				<hr>
				</div>
				<div class="row">
					<h5 style="color: #222; font-weight: bold;">CATEGORIES</h5>
					<div class="col-lg-12 col-sm-12">
						<div class="row">
					@foreach($dis as $disk)
					<div class="col-lg-6 col-sm-6 col-xs-6">
						<h5>{{$disk->name}}</h5>
					</div>
					@endforeach	
						</div>
					</div>
				<hr>
				</div>
				<div class="row">
					<h5 style="color: #222; font-weight: bold;">TYPE</h5>
				<div class="col-lg-12 col-sm-12">
						<div class="row">
					@foreach($cat as $cats)
					<div class="col-lg-6 col-sm-6 col-xs-6">
						<h5>{{$cats->name}}</h5>
					</div>
					@endforeach	
						</div>
					</div>
				</div>
				</div>	
			</div>
		</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
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

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class='modal-header'>
			        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			        <h4 class='modal-title' id='myModalLabel'>Followers</h4>
			      </div>
			      <div class='modal-body'>
    <div class="showit">
    	
    </div>
      </div>
					<div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class='modal-header'>
			        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			        <h4 class='modal-title' id='myModalLabel'>Following</h4>
			      </div>
			      <div class='modal-body'>
    <div class="showit2">
    	
    </div>
      </div>
					<div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			      </div>
    </div> 
  </div>
</div>

<div id='caption$image->id' style='display:none'>
				<div id=pix$image->id><button id=$image->id class='btn btn-xs btn-primary likepix'><i class='fa fa-check'></i> Like image</bottun></div>
			  </div>

@stop
@section('script')
<script type="text/javascript">
        $(document).ready(function(){
            $('#captions').lightGallery();
        });

        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
        </script>
{{ HTML::script('js/showcast.js') }}
{{ HTML::script('js/showit.js') }}
{{ HTML::script('js/modelNotify.js') }}
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