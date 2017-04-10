@extends('layouts.main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
			<h2>About us</h2>
			<hr>
			<p>Afrodaisy Models has established itself firmly as one of the new contemporary modeling network in Africa, connecting new faces (aspiring models) and professional models with reputable agencies, photographers, stylists and other industry clients.</p>
			<p>Afrodaisy models prides itself on providing the highest calibre of Models, photographers, dancers, fashion stylist and many more. A community for professionals who wants to see and be seen, we make it our responsibility to make an online user friendly platform and easy to access, to help make everyone’s task a lot easier.</p>
			<p>Instinctively, Afrodaisy models knew that models needed to possess more than just beauty to have worldwide appeal. We saw the natural, healthy, and casually elegant style of African community as the perfect backdrop to complement their beauty.</p>
			<p>Afrodaisy made an extensive research in the model world and also consulted with top models and other industry professionals to create a fast and effective tool that is vital for the model world.</p>
			<p>Afrodaisy models provides a conducive platform for models, photographers, agency, stylist and other industry clients to coexist and maximize the use of each other. As a result our portfolio, consists of the most proficient people in the business</p>
			<br>
			<p><strong>Models</strong> can create their profile on afrodaisy models and increase their chance of being seen the whole of Africa</p>
			<p><strong>Photographers</strong>  can explore our database of professional and new face models all over Africa and be able to contact them for jobs and also advertise photo sessions that has been previously seen by few</p>
			<p><strong>Agency</strong> The platform is designed to easily and quickly search through the available models on afrodaisymodels.com to give you exactly what you looking given the information the user provide on the search options. Then you can make your pick on who best fits to join your Agency. it’s as simple as that!</p>
			<p><strong>Industry professionals</strong> other professional who are associated with the model industry can get a chance to achieve their goal through the services afrodaisy models provide.</p>
			
			<br>
			<h4>Other professionals include:</h4>
			<ul>
				@foreach($industryprofessional as $industryprofessionals)
					<li>{{$industryprofessionals->name}}</li>
				@endforeach
				
			</ul>
		</div>
	</div>
</div>
@stop()
@section('script')

{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop