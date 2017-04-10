@extends('layouts.main')
@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12">
                <h3 style="font-family: 'Century Gothic';">Photosession</h3>
                <hr>
                <div class="row">
                <div class="col-lg-6 photo-hd">
                    <p>The best selected model Photo Sessions at discounted prices, exclusively for you!</p>
                </div>

                <div class="col-lg-6">
                    <img src="img/3s.jpg" class="img-responsive">
                </div>
                </div>
                <br>
                <br>
                {{$view}}
</div>
@stop