@extends('layouts.main')
@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12">
                <h3 style="font-family: 'Century Gothic';">Courses</h3>
                <hr>
                <div class="row">
                <div class="col-lg-6 photo-hd">
                    <p>Afrodiasy Courses</p>
                </div>

                <div class="col-lg-6">
                    <img src="img/3s1.jpg" width="468px" class="img-responsive">
                </div>
                </div>
                <br>
                <br>
                {{$view}}
</div>
@stop