@extends('layouts.main')
@section('content')	
{{$viewimg}}

@stop
@section('script')


        <script type="text/javascript">
        $(document).ready(function(){
            $('#captions').lightGallery();
        });
        </script>



{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/showcast.js') }}
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
{{ HTML::script('js/masonry.pkgd.min.js') }}
{{ HTML::script('js/imagesload.js') }}
<script type="text/javascript">
			var $grid = $('.grid').imagesLoaded( function() {
			  // init Masonry after all images have loaded
			  $grid.masonry({
			    // options...
			  });
			});
  
        </script>

@stop