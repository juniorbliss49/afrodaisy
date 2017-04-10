@extends('layouts/main')

@section('content')
<div class="row">

	<div class="col-lg-12">
		<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cast" aria-controls="cast" role="tab" data-toggle="tab">Cast</a></li>
    <li role="presentation"><a href="#acknoledge" aria-controls="acknoledge" role="tab" data-toggle="tab">Acknowledge</a></li>
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
    <div role="tabpanel" class="tab-pane" id="acknoledge">
    <br>
    <br>
    <input type="hidden" id="ack" name="" value="{{$getcast->id}}">
    <input type="hidden" id="hdid" name="hdid">
    {{$view}}
    </div>
  </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Acknowledge</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-lg-12">
          <h5>Reasons</h5>
            <textarea rows="4" cols="75" id='ackmsg'>
            </textarea>
      </div>
      </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success sendack">Send</button>
      </div>
    </div>
  </div>
</div>


@stop
@section('script')
{{ HTML::script('js/contact.js') }}
@stop