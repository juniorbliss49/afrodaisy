@extends('layouts.main')
@section('content')

{{ HTML::style('css/lightgallery.css') }}
<div class="col-lg-8 col-xs-10">
	<div class="row">
		<h3>Followers Update</h3>
		<hr>
	</div>
	
	<div class="row">
	@if(!empty($values))
	<br>
	<br>
	<div class="col-lg-12">
		<h4>{{$values}}</h4>
	</div>
	</div>
	</div>
	@else
	{{$value}}
		{{$value3}}
		<br>
		<br>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<h4>Latest Updates</h4>
				</div>
				<div class="col-lg-6 text-right">
					<a href="/users/newspage">View more news</a>
				</div>
			</div>
			<br>
		</div>

		{{$value2}}
	</div>
</div>
<br><br><br><br><br><br>
{{$value4}}
@endif

@stop
@section('script')

<script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
        </script>

{{ HTML::script('js/commimg.js') }}
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
@stop