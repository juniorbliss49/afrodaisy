@extends('layouts.main')
@section('content')
{{ HTML::script('js/paginathing.js') }}

<br>
<br>
<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h2>The Model Profiles with the highest Monthly and Yearly likes.</h2>
				<h2>For the month of <?php echo date('F'); ?></h2>
			<br>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-7">
			<?php
			echo $myval;
			?>
		</div>
		<div class="col-lg-5">
			
		</div>
	</div>
</div>

@stop