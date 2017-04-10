@extends('layouts.main')
@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12">
                <h3 style="font-family: 'Century Gothic';">Contracts</h3>
                <hr>
                <div class="row">
                <div class="col-lg-6 photo-hd">
                    <p>Best Place to get Contracts for Professionals</p>
                </div>

                <div class="col-lg-6">
                    <img src="img/photo_sessions_thumbs.gif" width="468px" class="img-responsive">
                </div>
                </div>
                <br>
                <br>
                {{$view}}
</div>
@stop