@extends('layouts/main')

@section('content')
<div class="row">

	<div class="col-lg-12">
		<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cast" aria-controls="cast" role="tab" data-toggle="tab">Cast</a></li>
    <li role="presentation"><a href="#models" aria-controls="models" role="tab" data-toggle="tab">Models</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="cast">
    	<div class='row' style="padding-left: 10px">
                        <div class='col-lg-3'>
                @if(!empty($getcast->castImage))
                             {{HTML::image($getcast->castImage)}}
                                    
                @else
                            {{HTML::image('img/photo.jpg')}}
                                    
                @endif
                <?php
                if(empty($getdis)){
                $value = '';
                }else{
                $value = $getdis->name;
                }
                ?>
                    </div>
                    </div>
                    <br>
                            <div class='row' style="padding-left: 10px">
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
                                        <p><strong>Cast Requirement:</strong>{{$getcast->castRequirement}}</p>
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
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
    </div>
    <div role="tabpanel" class="tab-pane active" id="models">
    </div>
  </div>
@stop