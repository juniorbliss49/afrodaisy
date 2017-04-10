@extends('layouts.main')

@section('content')
 
<div class="col-lg-2 col-sm-2">
                <div class="row">
                    <a href="">
                    <div class="dpchange">
                    @if(isset($user->photoupload->imagename))
                        {{ HTML::image($user->photoupload->imagename, 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
                    @else
                        {{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'class' => 'img-responsive')) }}
                    @endif
                    </div>

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
						<h3>Cast application</h3>
						<hr>
					</div>
					<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#castnew" aria-controls="castnew" role="tab" data-toggle="tab">My New Cast Invitation</a></li>
    <li role="presentation"><a href="#castapply" aria-controls="castapply" role="tab" data-toggle="tab">My Cast Application</a></li>
    <li role="presentation"><a href="#castprev" aria-controls="castprev" role="tab" data-toggle="tab">My Previous Cast</a></li>
    <li role="presentation"><a href="#castdeclined" aria-controls="castdeclined" role="tab" data-toggle="tab">My Declined Cast</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="castnew">
    			<br>
    			<br>
    			<div id="castview">
			    </div>
    			@foreach($castnew as $newcast)
	    			<div class="row casting-bg" id="hide{{$newcast->cast_id}}">
	    				<div class="col-lg-2 col-sm-2">
	    					@if(!empty($newcast->castImage))
                        	{{ HTML::image($newcast->castImage ,'cast picture', array('width' => '130px')) }}
                        	@else
    						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
    					   @endif
                        </div>
                        <div class="col-lg-7 col-sm-7" style="padding-top: 20px; padding-left: 50px;">
                            <a href="/others/showcastdetail/{{ $newcast->cast_id }}">{{ $newcast->castTitle }}</a>
                            <h5>Location: {{ $newcast->location }}</h5>
                            <h5>Amounts: <i class='fa fa-money'></i> {{ number_format($newcast->payDesc) }}</h5>
                            @if(empty($newcast->castStatus))
                            <button id="{{$newcast->cast_id}}" class="btn btn-sm btn-default castapply"  style="background-color: #54d7e3; color: #fff;">Accept</button>
                            <button id="{{$newcast->cast_id}}" class="btn btn-sm btn-danger castdecline">Decline</button>
                            @else
                            <h5>Status: Confirmed</h5>
                            @endif
                            <br>
                            <br>
                        </div>
                         <div class="col-lg-3 col-sm-3">
                        <br>
                        <br>
                        <br>
                        @if(empty($newcast->castStatus))
                        	<button id="{{$newcast->cast_id}}" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default viewcast" style="background-color: #54d7e3; color: #fff;">VIEW CAST</button>
                        @else
                            <button id="{{$newcast->cast_id}}" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default viewcast2" style="background-color: #54d7e3; color: #fff;">VIEW CAST</button>
                        @endif
                        </div>
	    			</div>
	    			<br>
	    			<br>
    			@endforeach
    		
    </div>
    <div role="tabpanel" class="tab-pane" id="castapply">
    			<br>
    			<br>
    			{{$view}}
    		</div>
    <div role="tabpanel" class="tab-pane" id="castprev">
    	        <br>
                <br>
    <?php
        $month = date('m');
        $year = date('Y');
        $day = date('d');
    ?>
                @foreach($castprevious as $prev)
                @if($prev->Yearend <= $year)
                    @if($prev->Yearend == $year)
                        @if($prev->Monthend <= $month)
                            @if($prev->Monthend == $month)
                                @if($prev->Dayend < $day)
                                        
                                        <div class="row casting-bg">
                                            <div class="col-lg-2 col-sm-2">
                                                @if(!empty($prev->castImage))
                                                {{ HTML::image($prev->castImage ,'cast picture', array('width' => '130px')) }}
                                                @else
                                            {{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
                                        @endif
                                            </div>
                                            <div class="col-lg-7 col-sm-7" style="padding-top: 20px; padding-left: 50px;">
                                                <a href="/others/showcastdetail/{{ $prev->cast_id }}">{{ $prev->castTitle }}</a>
                                                <h5>Location: {{ $prev->location }}</h5>
                                                <h5>Amount: {{ $prev->payDesc }}</h5>
                                                <br>
                                                <br>
                                            </div>
                                             <div class="col-lg-3 col-sm-3">
                                            
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                @endif
                            @if($prev->Monthend < $month)
                                        <div class="row casting-bg">
                                            <div class="col-lg-2 col-sm-2">
                                                @if(!empty($prev->castImage))
                                                {{ HTML::image($prev->castImage ,'cast picture', array('width' => '130px')) }}
                                                @else
                                            {{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
                                        @endif
                                            </div>
                                            <div class="col-lg-7 col-sm-7" style="padding-top: 20px; padding-left: 50px;">
                                                <a href="/others/showcastdetail/{{ $prev->cast_id }}">{{ $prev->castTitle }}</a>
                                                <h5>Location: {{ $prev->location }}</h5>
                                                <h5>Amount: {{ $prev->payDesc }}</h5>
                                                <br>
                                                <br>
                                            </div>
                                             <div class="col-lg-3 col-sm-3">
                                            
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                            @endif
                        @endif
                        @endif
                    @else
                                        <div class="row casting-bg">
                                            <div class="col-lg-2 col-sm-2">
                                                @if(!empty($prev->castImage))
                                                {{ HTML::image($prev->castImage ,'cast picture', array('width' => '130px')) }}
                                                @else
                                            {{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
                                        @endif
                                            </div>
                                            <div class="col-lg-7 col-sm-7" style="padding-top: 20px; padding-left: 50px;">
                                                <a href="/others/showcastdetail/{{ $prev->cast_id }}">{{ $prev->castTitle }}</a>
                                                <h5>Location: {{ $prev->location }}</h5>
                                                <h5>Amount: {{ $prev->payDesc }}</h5>
                                                <br>
                                                <br>
                                            </div>
                                             <div class="col-lg-3 col-sm-3">
                                            
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    
                @endif
                @endif
                @endforeach    
            </div>
    <div role="tabpanel" class="tab-pane" id="castdeclined">
    			<br>
    			<br>
    			@foreach($castdeclined as $declined)
    				<div class="row casting-bg">
	    				<div class="col-lg-2 col-sm-2">
	    					@if(!empty($declined->castImage))
                        	{{ HTML::image($declined->castImage ,'cast picture', array('width' => '130px')) }}
                        	@else
						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px')) }}
					@endif
                        </div>
                        <div class="col-lg-7 col-sm-7" style="padding-top: 20px; padding-left: 50px;">
                            <a href="/others/showcastdetail/{{ $declined->cast_id }}">{{ $declined->castTitle }}</a>
                            <h5>Location: {{ $declined->location }}</h5>
                            <h5>Amount: {{ $declined->payDesc }}</h5>
                            <h5>Cast Status: DECLINED
                            </h5>
                            <br>
                            <br>
                        </div>
                         <div class="col-lg-3 col-sm-3">
                        
                        </div>
	    			</div>
	    			<br>
	    			<br>
    			@endforeach
    </div>
  </div>




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

                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" >
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Decline Cast</h4>
                      </div>
                      <div class="modal-body">
                        <div id="view">
                                            
                         </div>
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

</div>
			</div>



<!-- Modal -->

@stop
@section('script')
{{ HTML::script('js/showcast.js') }}
@stop