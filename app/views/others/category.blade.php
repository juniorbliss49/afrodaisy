@extends('layouts.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2>Select model category</h2>
			<div class="well">
				<div class="row">
				{{ Form::open(array('url' => 'others/insertcategory')) }}
					@foreach($Discipline as $category)
						<div class="col-lg-2">
							{{ Form::checkbox('cat[]', $category->id) }} {{$category->name}} 
						</div>
					@endforeach
				</div>
				{{ Form::close() }}
				<br>
				<div class="row">
					<div class="col-lg-1">
						<div class="form-group">
						  {{ Form::submit('SAVE',  $attributes = array('class' => 'btn-col btn btn-primary btn-sm')) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
