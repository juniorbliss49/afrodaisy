@extends('layouts.main')
@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12">
                <h3 style="font-family: 'Century Gothic';">Services</h3>
                <hr>
                <div class="row">
                <div class="col-lg-6 photo-hd">
                    <p>Afrodiasy services</p>
                </div>

                <div class="col-lg-6">
                    <img src="img/service.jpg" class="img-responsive">
                </div>
                </div>
                <br>
                <br>
                {{$view}}
</div>
@stop   
