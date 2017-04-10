@extends('layouts/main')

@section('content')
<div class="row">

	<div class="col-lg-12">
		<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cast" aria-controls="cast" role="tab" data-toggle="tab">Cast</a></li>
    <li role="presentation"><a href="#invite" aria-controls="invite" role="tab" data-toggle="tab">Invite Models</a></li>
    <li role="presentation"><a href="#manage" aria-controls="manage" role="tab" data-toggle="tab">Manage Models</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="cast">
        <br><br>
    	<div class='row' style="padding-left: 10px">
                        <div class='col-lg-5'>
                @if(!empty($getcast->castImage))
                             {{HTML::image($getcast->castImage, 'cast image', array('width' => '300px'))}}
                                    
                @else
                            {{HTML::image('img/photo.jpg', 'cast image', array('width' => '300px', 'class' => 'img img-responsive'))}}
                                    
                @endif
                <?php
                if(empty($getdis)){
                $value = '';
                }else{
                $value = $getdis->name;
                }
                ?>
                    </div>       
                                <div class="col-lg-7">
                                <div class="row">
                                <div class='col-lg-12'>
                                    <div class='row'>
                                        <div class='col-lg-6'>
                                        <p><strong>Cast Title: </strong>{{$getcast->castTitle}}</p>
                                        <p><strong>Cast Category: </strong>{{$value}}</p>
                                        <p><strong>Cast gender: </strong>{{$getcast->gender}}</p>
                                        <p><strong>Cast Task: </strong>{{$getcast->castTask}}</p>
                                        <p><strong>Cast Country: </strong>{{$getcast->country}}</p>
                                        <p><strong>Cast State: </strong>{{$getcast->location}}</p>
                                        <p><strong>Cast Area: </strong>{{$getcast->area}}</p>
                                        </div>
                                        <div class='col-lg-6'>
                                        <p><strong>Payment Type: </strong>{{$getcast->payType}}</p>
                                        <p><strong>Amount: </strong>{{$getcast->payDesc}}</p>
                                        <p><strong>Events Start:</strong>{{$getcast->Yearcast}}-{{$getcast->Monthcast}}-{{$getcast->Daycast}}</p>
                                        <p><strong>Events Ends: </strong>{{$getcast->Yearend}}-{{$getcast->Monthend}}-{{$getcast->Dayend}}</p>
                                        <p><strong>Expiration of Cast: </strong>{{$getcast->YearExp}}-{{$getcast->MonthExp}}-{{$getcast->DayExp}}</p>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-lg-12'>
                                        <p><strong>Cast Description: </strong>{{$getcast->castDescription}}</p>
                                        <p><strong>Cast Requirement:</strong>{{$getcast->castRequirement}}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                </div>
                                </div>
    </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="invite">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <br>
                        <div id="castadded">
                            
                        </div>
                <button class ='btn-col btn btn-primary btn-xs' data-toggle='modal' data-target='#exampleModal2'>INVITE CONTACTED/FAVOURITE MODELS</button><br><br>
                <button class ='btn-col btn btn-primary btn-xs' id="invitemodel">INVITE MODELS</button>
                {{ Form::hidden('cast_ids', $value = $cast_id) }}
                <br>
                <br>
                    </div>
                </div>
                {{$result}}
            </div>
        </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="manage">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <br>
                    <br>
                    <div class="col-lg-3">
                        <ul id="folder" class="nav nav-pills nav-stacked" role="tablist">
                            <li role="presentation"><a href="#" aria-controls="applicant" role="tab" data-toggle="tab">FOLDERS</a></li>
                          <li role="presentation" class="active"><a href="#applicant" aria-controls="applicant" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-option-vertical"></span>New Applicants</a></li>
                          <li role="presentation"><a id="confirms" href="#confirmed" aria-controls="confirmed" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-ok"></span>Confirmed</a></li>
                          <li role="presentation"><a id="discards" href="#discarded" aria-controls="discarded" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-trash"></span>Discarded</a></li>
                        </ul>
                        <br>
                        <button class="btn btn-success form-control" id='checkoutpost' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-shopping-cart'></i> Checkout Added Models</button>
                    </div>
                    <div class="col-lg-9">
                        <div class="well" style="padding-top: 5px; padding-bottom: 5px">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" class="btn btn-success" id="confirmex"><i class='fa fa-check'></i> confirm applicants</button>
                              <button type="button" class="btn btn-danger" id="discardex"><i class='fa fa-trash-o'></i> discard applicants</button>
                              <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#exampleModal4'><i class='fa fa-envelope'></i> message models</button>
                            </div>
                            {{ Form::hidden('cast_ids', $value = $cast_id) }}
                        </div>
                        <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div id="show_div">
                                
                            </div>
                            <div id="val">
                                
                            </div>
                            <div class="valindex">
                                @foreach($getAllUser as $userdata)
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-lg-1 col-sm-1 col-xs-1" style="background-color:">
                                                {{ Form::checkbox('users', $userdata->user_id) }}
                                            </div>
                                            <div class="col-lg-7 col-sm-7 col-xs-11">
                                                {{ HTML::image($userdata->imagename, 'profile picture', array('width' => '130px', 'Height' => '160px', 'class' => 'img-left')) }}
                                                <div class="text-left">
                                                <p>{{ link_to('foo/bar', $userdata->displayName, $attributes = array(), $secure = null) }}</p>
                                                <p>Height:  {{ $userdata->Height }} / cm</p>
                                                <p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> {{ $userdata->location}}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4">
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3>Invite Models</h3>
      </div>
         <div class="modal-body">
            <div class="well">
                <div class="row">
                    <div class="col-lg-4">
                        <select class="form-control getinvite">
                            <option>select options</option>
                            <option value="all">All</option>
                            <option value="contacted">Contacted</option>
                            <option value="favorite">favourite</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="well">
                <div class="row getdata">
                    
                </div>
            </div>
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary sendinvite">Invite</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><i class='fa fa-shopping-cart'></i> Checkout Cast</h3>
      </div>
            <div class="modelcheckout">
                
            </div>

    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" >
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
        <button type="button" class="btn btn-primary" id="sendmsg">Send message</button>
      </div>
    </div>
  </div>
</div>

@stop
@section('script')
{{ HTML::script('js/showcast.js') }}
@stop