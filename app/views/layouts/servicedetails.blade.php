@extends('layouts.main')
@section('content')
    <div class="col-lg-9 col-sm-9">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h2>{{$getphotocourse->name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(!empty($getphotocourse->image))
                    {{HTML::image($getphotocourse->image ,'profile', array('width' => '600px', 'Height' => '350px', 'class' => 'img-responsive'));}}
                            @else
                    {{HTML::image('img/photo.jpg', 'profile picture', array('width' => '400px', 'Height' => '200px', 'class' => 'img-responsive'));}}
                    @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h4>Description</h4>
                <p>{{$getphotocourse->description}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3"> 
    <br>
    <br>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="col-lg-12">
                    <h4><img src="/img/nigeria-naira-currency-symbol.png" class="img-responsive" style="width: 11%; float: left;"><strong>{{number_format($getphotocourse->price)}}</strong></h4>
                </div>
            <input type="hidden" name="amount" value="{{$getphotocourse->price}}"> 
                        <input type="hidden" name="quantity" value="3">
                        <input type="hidden" name="reference" value=""> 
                        <input type="hidden" name="key" value="">

                    @if(!empty(Auth::user()->id))
    {{ Form::open(array('url' => 'pay/Services')) }}
                        <a class="btn btn-primary Offlinebtn" target="_" href="/others/offlinepayoutservices/{{$getphotocourse->id}}" style="display: none;">Book offline</a>
                        <input type="hidden" name="amount" value="{{$getphotocourse->price}}">
                        <input type="hidden" name="course_id" value="{{$getphotocourse->id}}">
                        <button class="btn btn-success Offlinebtn" style="display: none;">Book online</button>
    {{ Form::close() }}
                          <button class="btn btn-primary proceedpay">
                          <i class="fa fa-plus-circle fa-lg"></i> BOOK SESSION
                          </button>
                    @else
                        <a class="btn btn-primary" href="/signup">
                          <i class="fa fa-plus-circle fa-lg"></i> Sign up to book this session
                          </a>
                    @endif
            </div>
        </div>
        <br>
        <div class="well row">
            <div class="col-lg-12 col-sm-12">
                <h4>Session Information</h4>
                <p><strong>Type:</strong> Photosession</p>
                <p><strong>Duration:</strong> {{$getphotocourse->duration}}</p>
                <p><strong>Location:</strong> {{$getphotocourse->location}}</p>
                <p><strong>Venue:</strong> {{$getphotocourse->venue}}</p>
                <p><strong>Posted by:</strong> <a href="/others/showprofile/{{$getuserName->user_id}}">{{$getuserName->agentName}}</a></p>
            </div>
        </div>
    </div>
@stop
@section('script')
{{ HTML::script('js/showcast.js') }}
@stop