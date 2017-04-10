<!DOCTYPE html>
<html>
<head>
	<title>Afrodaisy Models</title>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/custom.css') }}
  {{ HTML::style('assets/libs/font-awesome/css/font-awesome.min.css') }}
  {{ HTML::style('css/select2.min.css') }}

	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/dropdown.js') }}
	{{ HTML::script('js/bootstrap-hover-dropdown.min.js') }}
</head>
<body>
<div class="wrapper">
		<div class="container">
			<div class="row">
			{{$view}}
			</div>
			
		</div>
</div>
</body>
</html>