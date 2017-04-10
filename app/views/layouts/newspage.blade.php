@extends('layouts.main')
@section('content')

  {{ HTML::style('css/lightgallery.css') }}
<div class="col-lg-8">
	<div class="row">
		<h3>Followers Update</h3>
		<hr>
	</div>
	{{$value}}
	
</div>
<div class="col-lg-4">
	
</div>
@stop
@section('script')
{{ HTML::script('js/paginathing.js') }}

<script type="text/javascript">
        $(document).ready(function(){
            
            $('#hash26').lightGallery({
    	galleryId: 26
			})
			$('#hash25').lightGallery({
    	galleryId: 25
			})
        });

        $('.paginate').paginathing({
	    perPage: 5,
	    limitPagination: 9
		})
        </script>

{{ HTML::script('js/message.js') }}
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