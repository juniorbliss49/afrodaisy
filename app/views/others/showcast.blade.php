@extends('layouts/main')

@section('content')
{{ HTML::script('js/paginathing.js') }}
<br>
<br>
<div class="row">

	<div class="col-lg-12">
		<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit</a></li>
    <li role="presentation"><a href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">Model Preferences</a></li>
    <li role="presentation"><a href="#invitemodels" aria-controls="invitemodels" role="tab" data-toggle="tab">Invite Models</a></li>
    <li role="presentation"><a href="#invitedmodels" aria-controls="invitedmodels" role="tab" data-toggle="tab">Invited Models</a></li>
    <li role="presentation"><a href="#manage" aria-controls="manage" role="tab" data-toggle="tab">Manage Applicants</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="edit">...
    	<div class="row">
						<h3>Edit Casting</h3>
						<hr>
					</div>
					{{ Form::model($cast, array('url' => array('others/updatecast', 'files'=>true) )) }}
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">
			{{ Form::hidden('cast_id', $value = $cast->id) }}
			{{ Form::label('Title of casting') }}
		 	{{ Form::text('castTitle', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		 	{{ $errors->first('castTitle', '<p class="error">:message</p>') }}
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4 col-sm-7">
			{{ Form::label('Casting Description(Email addresses are not permitted in the description)') }}
		 	{{ Form::textarea('castDescription', $value = null, array('class' => 'form-control')) }}
		</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4"> 
			<p>{{ Form::radio('payType', 'paid') }} Paid</p>
			{{ $errors->first('payType', '<p class="error">:message</p>') }}
		</div>
		<div class="col-lg-4 col-sm-4">
			<p>{{ Form::radio('payType', 'tfp') }} TFP(Trade for Print)</p>
		</div>
		<div class="col-lg-4 col-sm-4">
			<p>{{ Form::radio('payType', 'Other') }} Other</p>
		</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-sm-5">
			{{ Form::text('payDesc', $value = null, $attributes = array('placeholder' => 'Payment details', 'id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control'))}}
			{{ $errors->first('payDesc', '<p class="error">:message</p>') }}
			</div>
		</div>
	</div>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-4">
		{{ Form::label('Event State') }}
		<br>
		{{ Form::select('location', array('' => '--Please select--', 'Abia' => 'Abia', 'Abuja' => 'Abuja', 'Adamawa' => 'Adamawa', 'Anambra' => 'Anambra', 'Akwa Ibom'=>'Akwa Ibom', 'Bauchi' => 'Bauchi', 'Bayelsa' => 'Bayelsa', 'Benue'=>'Benue', 'Borno'=>'Borno', 'Cross River'=>'Cross River',  'Delta'=>'Delta', 'Ebonyi'=>'Ebonyi', 'Enugu'=>'Enugu', 'Edo'=>'Edo', 'Ekiti'=>'Ekiti', 'Gombe'=>'Gombe', 'Imo'=>'Imo', 'Jigawa'=>'Jigawa', 'Kaduna'=>'Kaduna', 'Kano'=>'Kano', 'Katsina'=>'Katsina', 'Kebbi'=>'Kebbi', 'Kogi'=>'Kogi', 'Kwara'=>'Kwara', 'Lagos'=>'Lagos', 'Nasarawa'=>'Nasarawa', 'Niger'=>'Niger', 'Ogun'=>'Ogun', 'Ondo'=>'Ondo', 'Osun'=>'Osun', 'Oyo'=>'Oyo', 'Plateau'=>'Plateau', 'Rivers'=>'Rivers', 'Sokoto'=>'Sokoto', 'Taraba'=>'Taraba', 'Yobe'=>'Yobe', 'Zamfara'=>'Zamfara', 'Others'=> 'Others')) }}
		{{ $errors->first('location', '<p class="error">:message</p>') }}
	</div>
		<div class="col-lg-4 col-sm-4">
			{{ Form::label('Enter Event town or city') }}
		 	{{ Form::text('area', $value = null, $attributes = array('id' => 'exampleInputEmail1', 'size' => '30', 'class' => 'form-control')) }}
		</div>
	</div>
	</div>
	<br>
	<div class="well">
	<div class="row">
		<div class="col-lg-4 col-sm-6">
			{{ Form::label('Date of event') }}
			<br>
		 	{{ Form::selectRange('Daycast', 1, 31); }}
		 	{{ Form::selectMonth('Monthcast'); }}
		 	{{ Form::selectRange('Yearcast', 2016, 2020); }}
		 	<br>
		 	{{ $errors->first('Daycast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Monthcast', '<p class="error">:message</p>') }}
		 	{{ $errors->first('Yearcast', '<p class="error">:message</p>') }}			
		</div>
		<div class="col-lg-4 col-sm-6">
			{{ Form::label('Expiration of cast') }}
			<br>
		 	{{ Form::selectRange('DayExp', 1, 31); }}
		 	{{ Form::selectMonth('MonthExp'); }}
		 	{{ Form::selectRange('YearExp', 2016, 2020); }}
		 	<br>
		 	{{ $errors->first('DayExp', '<p class="error">:message</p>') }}
		 	{{ $errors->first('MonthExp', '<p class="error">:message</p>') }}
		 	{{ $errors->first('YearExp', '<p class="error">:message</p>') }}			
		</div>
	</div>
	</div>
	<div class="well">
		<div class="row">
		<div class="col-lg-4 col-sm-4">
			<div class="col-lg-12 col-sm-12">
			@if(!empty($cast->castImage))
			{{ HTML::image($cast->castImage, 'cast Image', array('width' => '220px')) }}
			@endif
			{{ Form::hidden('imageName', $value = $cast->castImage) }}
			{{ $errors->first('image', '<p class="error">:message</p>') }}
			<br>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4">
			
		</div>
		<div class="col-lg-4 col-sm-4">
			
		</div>
		</div>
	</div>

	{{ Form::close() }}
    </div>
    <div role="tabpanel" class="tab-pane" id="preferences">
    	<div class="row">
    		<div class="col-lg-12 col-sm-12">
    		<br>
    			<br>
    			<div id="casteditshow">
    				
    			</div>

				{{ Form::model($getcastpreference, array('url' => array('other/editcast'), 'id'=>'cast' )) }}
    			<div class="well">
				<div class="row">
				<div class="col-lg-2 col-sm-3">
					<label>Gender</label>
			<br>
			<select name="gender" class="sltp">
				<option value="">Gender</option>
				<option value="both" 
					<?php
					if ($cast->gender == 'both') {
						# code...
						echo "selected";
					}
					?>
				>Both</option>
				<option value="male" 
					<?php
					if ($cast->gender == 'male') {
						# code...
						echo "selected";
					}
					?>
				>Male</option>
				<option value="female"
					<?php
					if ($cast->gender == 'female') {
						# code...
						echo "selected";
					}
					?>
				>Female</option>
			</select>
				</div>
				<div class="col-lg-2 col-sm-3">
					<?php
					$checked = '';
					$catId = '';
					?>
					@if(!empty($getCategory->discId))
					<?php
						$catId = $getCategory->discId;
					?>
					@endif
					<label for='selCat'>
						Select Category
					</label>
					<br>
					<select name="selCat" class='js-example-basic-single' style="width: 120px">
						<option value="">Please select</option>
						@foreach($Discipline as $category)
						@if ($category->id == $catId))
							<?php
								$checked = 'selected';
							?>
						@else
							<?php
								$checked = '';
							?>
							@endif
						<option value="{{$category->id}}" <?php echo $checked; ?> >{{$category->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2 col-sm-3">
					<?php
					$checked = '';
					$catId = '';
					?>
					@if(!empty($getDisVal->castType))
					<?php
						$catId = $getDisVal->castType;
					?>
					@endif
					<label for='selType'>
						Select Type
					</label>
					<br>
					<select name="selType" name="selCat" class = 'sltp'>
						<option value="">Please select</option>
			@foreach($getDiscipline as $Discipline)
						@if ($Discipline->id == $catId))
							<?php
								$checked = 'selected';
							?>
						@else
							<?php
								$checked = '';
							?>
							@endif		
							<option value="{{$Discipline->id}}" <?php echo $checked; ?> >{{$Discipline->name}}</option>
			@endforeach
			</select>
				</div>
		</div>
	</div>

<div class="well">
<div class="row">
	<div class="col-lg-4 col-sm-4">
		{{ Form::label('Height') }}
		<br>
		{{ Form::select('heightFrom', array('' => '--Please select--', '210' => '210cm / 6.89ft', '209' => '209cm / 6.86ft', '208' => '208cm / 6.82ft', '207' => '207cm / 6.79ft', '206'=>'206cm / 6.76ft', '205' => '205cm / 6.73ft', '204' => '204cm / 6.69ft', '203'=>'203cm / 6.66ft', '202'=>'202cm / 6.63ft', '201'=>'201cm / 6.59cm',  '200'=>'200cm / 6.56ft', '199'=>'199cm / 6.53ft', '198'=>'198cm / 6.50ft', '197'=>'197cm / 6.46ft', '196'=>'196cm / 6.43ft', '195'=>'195cm / 6.40ft', '194'=>'194cm / 6.36ft', '193'=>'193cm / 6.33ft', '192'=>'192cm / 6.30ft', '191'=>'191cm / 6.27ft', '190'=>'190cm / 6.23ft', '189'=>'189cm / 6.20ft', '188'=>'188cm / 6.17ft', '187'=>'187cm / 6.14ft', '186'=>'186cm / 6.10ft', '185'=>'185cm / 6.07ft', '184'=>'184cm / 6.04ft', '183'=>'183cm / 6.00ft', '182'=>'182cm / 5.97ft', '181'=>'181cm / 5.94ft', '180'=>'180cm / 5.91ft', '179'=>'179cm / 5.87ft', '178'=>'178cm / 5.84ft', '177'=>'177cm / 5.81ft', '176'=>'176cm / 5.77ft','175'=>'175cm / 5.74ft', '174'=>'174cm / 5.71ft', '173'=>'173cm / 5.68ft', '172'=>'172cm / 5.64ft', '171'=>'171cm / 5.61ft', '170'=>'170cm / 5.58ft', '169'=>'169cm / 5.54ft', '168'=>'168cm / 5.51ft','167'=>'167cm / 5.48ft', '166'=>'166cm / 5.45ft', '165'=>'165cm / 5.41ft', '164'=>'164cm / 5.38ft', '163'=>'163cm / 5.35ft', '162'=>'162cm / 5.31ft', '161'=>'161cm / 5.28ft', '160'=>'160cm / 5.25ft','159'=>'159cm / 5.22ft', '158'=>'158cm / 5.18ft', '157'=>'157cm / 5.15ft', '156'=>'156cm / 5.12ft', '155'=>'155cm / 5.09ft', '154'=>'154cm / 5.05ft', '153'=>'153cm / 5.02ft','152'=>'152cm / 4.99ft', '151'=>'151cm / 4.95ft', '150'=>'150cm / 4.92ft', '149'=>'149cm / 4.89ft', '148'=>'148cm / 4.86ft', '147'=>'147cm / 4.82ft', '146'=>'146cm / 4.79ft', '145'=>'145cm / 4.76ft','144'=>'144cm / 4.72ft', '143'=>'143cm / 4.69ft', '142'=>'142cm / 4.66ft', '141'=>'141cm / 4.63ft', '140'=>'140cm / 4.59ft', '139'=>'139cm / 4.56ft', '138'=>'138cm / 4.53ft', '137'=>'137cm / 4.49ft', '136'=>'136cm / 4.46ft', '135'=>'135cm / 4.43ft', '134'=>'134cm / 4.40ft', '133'=>'133cm / 4.36ft', '132'=>'132cm / 4.33ft', '131'=>'131cm / 4.30ft', '130'=>'130cm / 4.27ft', '129'=>'129cm / 4.23ft','128'=>'128cm / 4.20ft', '127'=>'127cm / 4.17ft', '126'=>'126cm / 4.13ft', '125'=>'125cm / 4.10ft', '124'=>'124cm / 4.07ft', '123'=>'123cm / 4.04ft', '122'=>'122cm / 4.00ft', '121'=>'121cm / 3.97ft','120'=>'120cm / 3.94ft')) }}
		to
		{{ Form::select('heightTo', array('' => '--Please select--', '210' => '210cm / 6.89ft', '209' => '209cm / 6.86ft', '208' => '208cm / 6.82ft', '207' => '207cm / 6.79ft', '206'=>'206cm / 6.76ft', '205' => '205cm / 6.73ft', '204' => '204cm / 6.69ft', '203'=>'203cm / 6.66ft', '202'=>'202cm / 6.63ft', '201'=>'201cm / 6.59cm',  '200'=>'200cm / 6.56ft', '199'=>'199cm / 6.53ft', '198'=>'198cm / 6.50ft', '197'=>'197cm / 6.46ft', '196'=>'196cm / 6.43ft', '195'=>'195cm / 6.40ft', '194'=>'194cm / 6.36ft', '193'=>'193cm / 6.33ft', '192'=>'192cm / 6.30ft', '191'=>'191cm / 6.27ft', '190'=>'190cm / 6.23ft', '189'=>'189cm / 6.20ft', '188'=>'188cm / 6.17ft', '187'=>'187cm / 6.14ft', '186'=>'186cm / 6.10ft', '185'=>'185cm / 6.07ft', '184'=>'184cm / 6.04ft', '183'=>'183cm / 6.00ft', '182'=>'182cm / 5.97ft', '181'=>'181cm / 5.94ft', '180'=>'180cm / 5.91ft', '179'=>'179cm / 5.87ft', '178'=>'178cm / 5.84ft', '177'=>'177cm / 5.81ft', '176'=>'176cm / 5.77ft','175'=>'175cm / 5.74ft', '174'=>'174cm / 5.71ft', '173'=>'173cm / 5.68ft', '172'=>'172cm / 5.64ft', '171'=>'171cm / 5.61ft', '170'=>'170cm / 5.58ft', '169'=>'169cm / 5.54ft', '168'=>'168cm / 5.51ft','167'=>'167cm / 5.48ft', '166'=>'166cm / 5.45ft', '165'=>'165cm / 5.41ft', '164'=>'164cm / 5.38ft', '163'=>'163cm / 5.35ft', '162'=>'162cm / 5.31ft', '161'=>'161cm / 5.28ft', '160'=>'160cm / 5.25ft','159'=>'159cm / 5.22ft', '158'=>'158cm / 5.18ft', '157'=>'157cm / 5.15ft', '156'=>'156cm / 5.12ft', '155'=>'155cm / 5.09ft', '154'=>'154cm / 5.05ft', '153'=>'153cm / 5.02ft','152'=>'152cm / 4.99ft', '151'=>'151cm / 4.95ft', '150'=>'150cm / 4.92ft', '149'=>'149cm / 4.89ft', '148'=>'148cm / 4.86ft', '147'=>'147cm / 4.82ft', '146'=>'146cm / 4.79ft', '145'=>'145cm / 4.76ft','144'=>'144cm / 4.72ft', '143'=>'143cm / 4.69ft', '142'=>'142cm / 4.66ft', '141'=>'141cm / 4.63ft', '140'=>'140cm / 4.59ft', '139'=>'139cm / 4.56ft', '138'=>'138cm / 4.53ft', '137'=>'137cm / 4.49ft', '136'=>'136cm / 4.46ft', '135'=>'135cm / 4.43ft', '134'=>'134cm / 4.40ft', '133'=>'133cm / 4.36ft', '132'=>'132cm / 4.33ft', '131'=>'131cm / 4.30ft', '130'=>'130cm / 4.27ft', '129'=>'129cm / 4.23ft','128'=>'128cm / 4.20ft', '127'=>'127cm / 4.17ft', '126'=>'126cm / 4.13ft', '125'=>'125cm / 4.10ft', '124'=>'124cm / 4.07ft', '123'=>'123cm / 4.04ft', '122'=>'122cm / 4.00ft', '121'=>'121cm / 3.97ft','120'=>'120cm / 3.94ft')) }}
		</div>
		<div class="col-lg-4 col-sm-4">
		{{ Form::label('Age') }}
		<br>
		{{ Form::select('ageFrom', array('' => '--age--', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31', '32' => '32', '33' => '33', '34' => '34', '35' => '35', '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40', '41' => '41', '42' => '42', '43' => '43', '44' => '44', '45' => '45', '46' => '46', '47' => '47', '48' => '48', '49' => '49', '50' => '50', '51' => '51', '52' => '52', '53' => '53', '54' => '54', '55' => '55', '56' => '56', '57' => '57', '58' => '58', '59' => '59', '60' => '60', '61' => '61', '62' => '62', '63' => '63', '64' => '64', '65' => '65', '66' => '66', '67' => '67', '68' => '68', '69' => '69', '70' => '70')) }}
		to
		{{ Form::select('ageTo', array('' => '--age--', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31', '32' => '32', '33' => '33', '34' => '34', '35' => '35', '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40', '41' => '41', '42' => '42', '43' => '43', '44' => '44', '45' => '45', '46' => '46', '47' => '47', '48' => '48', '49' => '49', '50' => '50', '51' => '51', '52' => '52', '53' => '53', '54' => '54', '55' => '55', '56' => '56', '57' => '57', '58' => '58', '59' => '59', '60' => '60', '61' => '61', '62' => '62', '63' => '63', '64' => '64', '65' => '65', '66' => '66', '67' => '67', '68' => '68', '69' => '69', '70' => '70')) }}
    
		</div>
		</div>
</div>

	<div class="well">

					<div class="row">
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Chest/Bust') }}
						         <br>
		{{ Form::select('chestbustFrom', array('' => 'chest / bust', '65' => '65cm / 25.6', '66' => '66cm / 26.0', '67' => '67cm / 26.4', '68' => '68cm / 26.8', '69'=>'69cm / 27.2', '70' => '70cm / 27.6', '71' => '71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1',  '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3', '110'=>'110cm / 43.3', '111'=>'111cm / 43.7', '112'=>'112cm / 44.1', '113'=>'113cm / 44.5', '114'=>'114cm / 44.9', '115'=>'115cm / 45.3', '116'=>'116cm / 45.7', '117'=>'117cm / 46.1', '118' =>'118cm / 46.5', '119'=>'119cm / 46.9', '120'=>'120cm / 47.2', '121'=>'121cm / 47.6', '122'=>'122cm / 48.0', '123'=>'123cm / 48.4', '124'=>'124cm / 48.8', '125'=>'125cm / 49.2', '126'=>'126cm / 49.6', '127'=>'127cm / 50.0', '128'=>'128cm / 50.4', '129'=>'129cm / 50.8', '130'=>'130cm / 51.2', '131'=>'131cm / 51.6', '132'=>'132cm / 52.0', '133'=>'133cm / 52.4', '134'=>'134cm / 52.8', '135'=>'135cm / 53.1', '136'=>'136cm / 53.5', '137'=>'137cm / 53.9', '138' =>'138cm / 54.3', '139'=>'139cm / 54.7', '140'=>'140cm / 55.1', '141'=>'141cm / 55.5', '142'=>'142cm / 55.9', '143'=>'143cm / 56.3', '144'=>'144cm / 56.7', '145'=>'145cm / 57.1', '146'=>'146cm / 57.5', '147'=>'147cm / 57.9', '148'=>'148cm / 58.3', '149'=>'149cm / 58.7', '150'=>'150cm / 59.1')) }}

		to

	{{ Form::select('chestbustTo', array('' => 'chest / bust', '65' => '65cm / 25.6', '66' => '66cm / 26.0', '67' => '67cm / 26.4', '68' => '68cm / 26.8', '69'=>'69cm / 27.2', '70' => '70cm / 27.6', '71' => '71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1',  '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3', '110'=>'110cm / 43.3', '111'=>'111cm / 43.7', '112'=>'112cm / 44.1', '113'=>'113cm / 44.5', '114'=>'114cm / 44.9', '115'=>'115cm / 45.3', '116'=>'116cm / 45.7', '117'=>'117cm / 46.1', '118' =>'118cm / 46.5', '119'=>'119cm / 46.9', '120'=>'120cm / 47.2', '121'=>'121cm / 47.6', '122'=>'122cm / 48.0', '123'=>'123cm / 48.4', '124'=>'124cm / 48.8', '125'=>'125cm / 49.2', '126'=>'126cm / 49.6', '127'=>'127cm / 50.0', '128'=>'128cm / 50.4', '129'=>'129cm / 50.8', '130'=>'130cm / 51.2', '131'=>'131cm / 51.6', '132'=>'132cm / 52.0', '133'=>'133cm / 52.4', '134'=>'134cm / 52.8', '135'=>'135cm / 53.1', '136'=>'136cm / 53.5', '137'=>'137cm / 53.9', '138' =>'138cm / 54.3', '139'=>'139cm / 54.7', '140'=>'140cm / 55.1', '141'=>'141cm / 55.5', '142'=>'142cm / 55.9', '143'=>'143cm / 56.3', '144'=>'144cm / 56.7', '145'=>'145cm / 57.1', '146'=>'146cm / 57.5', '147'=>'147cm / 57.9', '148'=>'148cm / 58.3', '149'=>'149cm / 58.7', '150'=>'150cm / 59.1')) }}
						    		
						</div>
						<div class="col-lg-4 col-sm-4">
						         
						         {{ Form::label('Waist') }}
						         <br>
		{{ Form::select('waistFrom', array('' => '--waist--', '50' => '50cm / 19.7', '51' => '51cm / 20.1', '52' => '52cm / 20.5', '53' => '53cm / 20.9', '54'=>'54cm / 21.3', '55' => '55cm / 21.7', '56' => '56cm / 22.0', '57'=>'57cm / 22.4', '58'=>'58cm / 22.8', '59'=>'59cm / 23.2',  '60'=>'60cm / 23.6', '61'=>'61cm / 24.0', '62'=>'62cm / 24.4', '63'=>'63cm / 24.8', '64'=>'64cm / 25.2', '65'=>'65cm / 25.6', '66'=>'66cm / 26.0', '67'=>'67cm / 26.4', '68'=>'68cm / 26.8', '69'=>'69cm / 27.2', '70'=>'70cm / 27.6', '71'=>'71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1', '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3')) }}
		to
		{{ Form::select('waistTo', array('' => '--waist--', '50' => '50cm / 19.7', '51' => '51cm / 20.1', '52' => '52cm / 20.5', '53' => '53cm / 20.9', '54'=>'54cm / 21.3', '55' => '55cm / 21.7', '56' => '56cm / 22.0', '57'=>'57cm / 22.4', '58'=>'58cm / 22.8', '59'=>'59cm / 23.2',  '60'=>'60cm / 23.6', '61'=>'61cm / 24.0', '62'=>'62cm / 24.4', '63'=>'63cm / 24.8', '64'=>'64cm / 25.2', '65'=>'65cm / 25.6', '66'=>'66cm / 26.0', '67'=>'67cm / 26.4', '68'=>'68cm / 26.8', '69'=>'69cm / 27.2', '70'=>'70cm / 27.6', '71'=>'71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1', '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3')) }}
						    		
						</div>
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Hips') }}
						         <br>
		{{ Form::select('hipsFrom', array('' => 'Hips', '65' => '65cm / 25.6', '66' => '66cm / 26.0', '67' => '67cm / 26.4', '68' => '68cm / 26.8', '69'=>'69cm / 27.2', '70' => '70cm / 27.6', '71' => '71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1',  '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3', '110'=>'110cm / 43.3', '111'=>'111cm / 43.7', '112'=>'112cm / 44.1', '113'=>'113cm / 44.5', '114'=>'114cm / 44.9', '115'=>'115cm / 45.3', '116'=>'116cm / 45.7', '117'=>'117cm / 46.1', '118' =>'118cm / 46.5', '119'=>'119cm / 46.9', '120'=>'120cm / 47.2', '121'=>'121cm / 47.6', '122'=>'122cm / 48.0', '123'=>'123cm / 48.4', '124'=>'124cm / 48.8', '125'=>'125cm / 49.2', '126'=>'126cm / 49.6', '127'=>'127cm / 50.0', '128'=>'128cm / 50.4', '129'=>'129cm / 50.8', '130'=>'130cm / 51.2', '131'=>'131cm / 51.6', '132'=>'132cm / 52.0', '133'=>'133cm / 52.4', '134'=>'134cm / 52.8', '135'=>'135cm / 53.1', '136'=>'136cm / 53.5', '137'=>'137cm / 53.9', '138' =>'138cm / 54.3', '139'=>'139cm / 54.7', '140'=>'140cm / 55.1', '141'=>'141cm / 55.5', '142'=>'142cm / 55.9', '143'=>'143cm / 56.3', '144'=>'144cm / 56.7', '145'=>'145cm / 57.1', '146'=>'146cm / 57.5', '147'=>'147cm / 57.9', '148'=>'148cm / 58.3', '149'=>'149cm / 58.7', '150'=>'150cm / 59.1')) }}
		to
		{{ Form::select('hipsTo', array('' => 'Hips', '65' => '65cm / 25.6', '66' => '66cm / 26.0', '67' => '67cm / 26.4', '68' => '68cm / 26.8', '69'=>'69cm / 27.2', '70' => '70cm / 27.6', '71' => '71cm / 28.0', '72'=>'72cm / 28.3', '73'=>'73cm / 28.7', '74'=>'74cm / 29.1',  '75'=>'75cm / 29.5', '76'=>'76cm / 29.9', '77'=>'77cm / 30.3', '78'=>'78cm / 30.7', '79'=>'79cm / 31.1', '80'=>'80cm / 31.5', '81'=>'81cm / 31.9', '82'=>'82cm / 32.3', '83'=>'83cm / 32.7', '84'=>'84cm / 33.1', '85'=>'85cm / 33.5', '86'=>'86cm / 33.9', '87'=>'87cm / 34.3', '88'=>'88cm / 34.6', '89'=>'89cm / 35.0', '90'=>'90cm / 35.4', '91'=>'91cm / 35.8', '92'=>'92cm / 36.2', '93'=>'93cm / 36.6', '94'=>'94cm / 37.0', '95'=>'95cm / 37.4', '96'=>'96cm / 37.8', '97'=>'97cm / 38.2', '98'=>'98cm / 38.6', '99'=>'99cm / 39.0', '100'=>'100cm / 39.4', '101'=>'101cm / 39.8', '102'=>'102cm / 40.2', '103' =>'103cm / 40.6', '104'=>'104cm / 40.9', '105'=>'105cm / 41.3', '106'=>'106cm / 41.7', '107'=>'107cm / 42.1', '108'=>'108cm / 42.5', '109'=>'109cm / 42.9', '110'=>'110cm / 43.3', '110'=>'110cm / 43.3', '111'=>'111cm / 43.7', '112'=>'112cm / 44.1', '113'=>'113cm / 44.5', '114'=>'114cm / 44.9', '115'=>'115cm / 45.3', '116'=>'116cm / 45.7', '117'=>'117cm / 46.1', '118' =>'118cm / 46.5', '119'=>'119cm / 46.9', '120'=>'120cm / 47.2', '121'=>'121cm / 47.6', '122'=>'122cm / 48.0', '123'=>'123cm / 48.4', '124'=>'124cm / 48.8', '125'=>'125cm / 49.2', '126'=>'126cm / 49.6', '127'=>'127cm / 50.0', '128'=>'128cm / 50.4', '129'=>'129cm / 50.8', '130'=>'130cm / 51.2', '131'=>'131cm / 51.6', '132'=>'132cm / 52.0', '133'=>'133cm / 52.4', '134'=>'134cm / 52.8', '135'=>'135cm / 53.1', '136'=>'136cm / 53.5', '137'=>'137cm / 53.9', '138' =>'138cm / 54.3', '139'=>'139cm / 54.7', '140'=>'140cm / 55.1', '141'=>'141cm / 55.5', '142'=>'142cm / 55.9', '143'=>'143cm / 56.3', '144'=>'144cm / 56.7', '145'=>'145cm / 57.1', '146'=>'146cm / 57.5', '147'=>'147cm / 57.9', '148'=>'148cm / 58.3', '149'=>'149cm / 58.7', '150'=>'150cm / 59.1')) }}
						         
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4 col-sm-4">
						 {{ Form::label('Dress') }}
						         <br>
		{{ Form::select('dressFrom', array('' => 'Dress', '32' => '32 EU, 4 UK,  2  US', '34' => '34 EU, 6 UK,  4  US', '36' => '36 EU, 8 UK,  6  US', '38' => '38 EU, 10 UK, 8, US', '40'=>'40 EU, 12 UK, 10 US', '42' => '42 EU, 14 UK, 12 US', '44' => '44 EU, 16 UK, 14 US', '46'=>'46 EU, 18 UK, 16 US', '48'=>'48 EU, 20 UK, 18 US')) }}
		to
		{{ Form::select('dressTo', array('' => 'Dress', '32' => '32 EU, 4 UK,  2  US', '34' => '34 EU, 6 UK,  4  US', '36' => '36 EU, 8 UK,  6  US', '38' => '38 EU, 10 UK, 8, US', '40'=>'40 EU, 12 UK, 10 US', '42' => '42 EU, 14 UK, 12 US', '44' => '44 EU, 16 UK, 14 US', '46'=>'46 EU, 18 UK, 16 US', '48'=>'48 EU, 20 UK, 18 US')) }}
					                
						</div>
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Jacket') }}
						         <br>
		{{ Form::select('jacketFrom', array('' => 'Jacket', '42' => '42 EU, 34 UK, 28 US', '44' => '44 EU, 35 UK, 30 US', '46'=>'46 EU, 36 UK, 32 US', '48'=>'48 EU, 38 UK, 34 US', '50' => '50 EU, 40 UK, 36 US', '52'=>'52 EU, 42 UK, 38 US', '54'=>'54 EU, 44 UK, 40 US')) }}
		to
		{{ Form::select('jacketTo', array('' => 'Jacket', '42' => '42 EU, 34 UK, 28 US', '44' => '44 EU, 35 UK, 30 US', '46'=>'46 EU, 36 UK, 32 US', '48'=>'48 EU, 38 UK, 34 US', '50' => '50 EU, 40 UK, 36 US', '52'=>'52 EU, 42 UK, 38 US', '54'=>'54 EU, 44 UK, 40 US')) }}
						</div>
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Trousers') }}
						         <br>
		{{ Form::select('trousersFrom', array('' => 'Trousers', '38' => '38 EU, 38 UK, 28 US', '40' => '40 EU, 40 UK, 30 US', '42' => '42 EU, 42 UK, 32 US', '44' => '44 EU, 44 UK, 34 US', '46'=>'46 EU, 46 UK, 36 US', '48'=>'48 EU, 48 UK, 38 US', '50' => '50 EU, 52 UK, 40 US', '52'=>'52 EU, 54 UK, 42 US', '54'=>'54 EU, 56 UK, 44 US')) }}
		to
		{{ Form::select('trousersTo', array('' => 'Trousers', '38' => '38 EU, 38 UK, 28 US', '40' => '40 EU, 40 UK, 30 US', '42' => '42 EU, 42 UK, 32 US', '44' => '44 EU, 44 UK, 34 US', '46'=>'46 EU, 46 UK, 36 US', '48'=>'48 EU, 48 UK, 38 US', '50' => '50 EU, 52 UK, 40 US', '52'=>'52 EU, 54 UK, 42 US', '54'=>'54 EU, 56 UK, 44 US')) }}
				                
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Collar') }}
						         <br>
		{{ Form::select('collarFrom', array('' => 'Collar', '18' => '18cm / 7', '19' => '19cm / 7', '20' => '20cm / 8', '21' => '21cm / 8', '22'=>'22cm / 9', '23' => '23cm / 9', '24' => '24cm / 9', '25'=>'25cm / 10', '26'=>'26cm / 10', '27'=>'27cm / 11',  '28'=>'28cm / 11', '29'=>'29cm / 11', '30'=>'30cm / 12', '31'=>'31cm / 12', '32'=>'32cm / 13', '33'=>'33cm / 13', '34'=>'34cm / 13', '35'=>'35cm / 14', '36'=>'36cm / 14', '37'=>'37cm / 15', '38'=>'38cm / 15', '39'=>'39cm / 15', '40'=>'40cm / 16', '41'=>'41cm / 16', '42'=>'42cm / 17', '43'=>'43cm / 17', '44'=>'44cm / 17', '45'=>'45cm / 18')) }}
		to
		{{ Form::select('collarTo', array('' => 'Collar', '18' => '18cm / 7', '19' => '19cm / 7', '20' => '20cm / 8', '21' => '21cm / 8', '22'=>'22cm / 9', '23' => '23cm / 9', '24' => '24cm / 9', '25'=>'25cm / 10', '26'=>'26cm / 10', '27'=>'27cm / 11',  '28'=>'28cm / 11', '29'=>'29cm / 11', '30'=>'30cm / 12', '31'=>'31cm / 12', '32'=>'32cm / 13', '33'=>'33cm / 13', '34'=>'34cm / 13', '35'=>'35cm / 14', '36'=>'36cm / 14', '37'=>'37cm / 15', '38'=>'38cm / 15', '39'=>'39cm / 15', '40'=>'40cm / 16', '41'=>'41cm / 16', '42'=>'42cm / 17', '43'=>'43cm / 17', '44'=>'44cm / 17', '45'=>'45cm / 18')) }}
                
						</div>
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Shoes') }}
						         <br>
		{{ Form::select('shoesFrom', array('' => 'Shoes', '225' => '36 EU,  3 UK, 3 US', '232' => '37 EU,  4 UK, 4 US', '240' => '38 EU,  5 UK, 5 US', '247' => '39 EU,  6 UK, 6 US', '255'=>'40 EU, 6½ UK, 7 US', '262'=>'41 EU,  7 UK, 7½ US', '270' => '42 EU,  8 UK, 8 US', '277'=>'43 EU,  9 UK, 9 US', '285'=>'44 EU, 9½ UK, 10 US', '292'=>'45 EU, 10 UK, 11 US', '300' => '46 EU, 11 UK, 12 US', '307'=>'47 EU, 12 UK, 13 US', '315'=>'48 EU, 13 UK, 14 US', '322'=>'49 EU, 14 UK, 15 US')) }}
		to
		{{ Form::select('shoesTo', array('' => 'Shoes', '225' => '36 EU,  3 UK, 3 US', '232' => '37 EU,  4 UK, 4 US', '240' => '38 EU,  5 UK, 5 US', '247' => '39 EU,  6 UK, 6 US', '255'=>'40 EU, 6½ UK, 7 US', '262'=>'41 EU,  7 UK, 7½ US', '270' => '42 EU,  8 UK, 8 US', '277'=>'43 EU,  9 UK, 9 US', '285'=>'44 EU, 9½ UK, 10 US', '292'=>'45 EU, 10 UK, 11 US', '300' => '46 EU, 11 UK, 12 US', '307'=>'47 EU, 12 UK, 13 US', '315'=>'48 EU, 13 UK, 14 US', '322'=>'49 EU, 14 UK, 15 US')) }}
				                
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Eyes') }}
						         <br>
		{{ Form::select('eyes', array('' => 'Eyes', 'black' => 'Black', 'blue' => 'Blue', 'brown' => 'Brown', 'darkbrown' => 'Dark Brown', 'green'=>'Green', 'gray'=>'Gray', 'hazel' => 'Hazel', 'lightblue'=>'Light Blue', 'lightbrown'=>'Light Brown')) }}
                
						</div>
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Hair Color') }}
						         <br>
		{{ Form::select('hair_color', array('' => 'Hair Color', 'aubrum' => 'Aubrum', 'black' => 'Black', 'blonde' => 'Blonde', 'brown' => 'Brown', 'cendre'=>'Cendre', 'chestnut'=>'Chestnut', 'dark' => 'Dark', 'darkblonde'=>'Dark Blonde', 'darkbrown'=>'Dark Brown', 'grey'=>'Grey', 'hazel'=>'Hazel', 'lightblue' => 'Light Blue', 'redblonde'=>'Red Blonde', 'salt-pepper'=>'Salt and Pepper', 'lightblonde' => 'Light Blonde', 'strawberryblonde'=>'Strawberry Blonde')) }}
				               
						</div>
						
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Languages') }}
						         <br>
		{{ Form::select('languages', array('' => 'Languages', 'English' => 'English', 'Igbo' => 'Igbo', 'Hausa' => 'Hausa', 'Yoruba' => 'Yoruba', 'Pidgin'=>'Pidgin', 'Edo'=>'Edo', 'Tiv' => 'Tiv', 'Fulani'=>'Fulani', 'Idoma'=>'Idoma', 'Ijaw'=>'Ijaw', 'Kanuri'=>'Kanuri')) }}
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Complexion') }}
						         <br>
		{{ Form::select('complexion', array('' => 'Complexion', 'lightskin' => 'Light skinned', 'lightbrown' => 'Light brown-skin', 'brown-skin' => 'Brown-skin', 'dark-brown' => 'Dark brown-skin', 'darkskin'=>'Dark skin')) }}
						</div>
							
						
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Butt type') }}
						         <br>
		{{ Form::select('butt', array('' => 'Butt type', 'inverted' => 'Inverted “V” shape', 'squared' => 'Square shape', 'round' => 'Round shape', 'heart' => 'Heart shape')) }}
						</div>
						<div class="col-lg-4 col-sm-4">
						{{ Form::label('Hair type') }}
						         <br>
		{{ Form::select('hair_type', array('' => 'Hair type', 'skincut' => 'skin cut', 'lowcut' => 'low cut', 'afro' => 'Afro (virgin hair)', 'relaxedshort' => 'Relaxed hair (short)', 'relaxedlong' => 'Relaxed hair (long)', 'dreadlocks' => 'Dreadlocks')) }}
							
						</div>
					</div>
					</div>
					<div class="well">
					<div class="row">
						<div class="col-lg-6 col-sm-6">
						{{ Form::label('Ethnicity') }}
						         <br>
		{{ Form::select('ethnicity', array('' => 'Ethnicity', 'Abraka' => 'Abraka', 'Afemai' => 'Afemai', 'Afusari' => 'Afusari','Agbassa' => 'Agbassa', 'AgbonKingdom'=>'Agbon Kingdom', 'Akunakuna' => 'Akunakuna', 'Anaang' => 'Anaang', 'Anga'=>'Anga', 'AnloEwe'=>'Anlo Ewe', 'Anwain'=>'Anwain',  'Aro'=>'Aro', 'AsianNigerian'=>'Asian Nigerian', 'Atyap'=>'Atyap', 'Bali'=>'Bali', 'Bariba'=>'Bariba', 'Berom'=>'Berom', 'Bete'=>'Bete', 'Buduma'=>'Buduma', 'Chamba'=>'Chamba', 'Dendi'=>'Dendi', 'Ebira'=>'Ebira', 'Edda'=>'Edda', 'Efik'=>'Efik', 'Eket'=>'Eket', 'Ekoi'=>'Ekoi', 'Emai'=>'Emai', 'Esan'=>'Esan', 'Etsakor'=>'Etsakor', 'Ewe'=>'Ewe', 'Fali'=>'Fali', 'Fon'=>'Fon', 'Fula'=>'Fula', 'Gbagyi'=>'Gbagyi', 'Gokana'=>'Gokana kingdom', 'Hausa'=>'Hausa', 'Hausa–Fulani'=>'Hausa–Fulani', 'Ibibio'=>'Ibibio', 'Idoma'=>'Idoma', 'Igala'=>'Igala', 'Igbo'=>'Igbo', 'Igede'=>'Igede', 'Igue'=>'Igue', 'Ijigban'=>'Ijigban community', 'Ijaw'=>'Ijaw', 'Ikpide'=>'Ikpide', 'Isoko'=>'Isoko', 'Isu'=>'Isu', 'Itsekiri'=>'Itsekiri', 'Iwellemmedan'=>'Iwellemmedan', 'Jobawa'=>'Jobawa', 'Jukun'=>'Jukun', 'Kamuku'=>'Kamuku', 'Kanuri'=>'Kanuri', 'kalabari' =>'kalabari', 'Kele'=>'Kele', 'Kilba'=>'Kilba', 'Kirdi'=>'Kirdi', 'Kofyar'=>'Kofyar', 'Koma'=>'Koma', 'Kotoko'=>'Kotoko', 'Kurtey'=>'Kurtey', 'Kuteb'=>'Kuteb', 'Longuda' =>'Longuda', 'Mafa'=>'Mafa', 'MaguzawaHausa'=>'Maguzawa Hausa', 'Mambila'=>'Mambila', 'Mumuye'=>'Mumuye', 'Ngizim'=>'Ngizim', 'Nupe'=>'Nupe', 'OfoinIgboland'=>'Ofo in Igboland', 'Ogoni'=>'Ogoni', 'Ogugu'=>'Ogugu', 'Oron'=>'Oron', 'Saro'=>'Saro', 'Tarok'=>'Tarok', 'Tiv'=>'Tiv', 'Tuareg'=>'Tuareg', 'Umuoji'=>'Umuoji', 'Urhobo'=>'Urhobo', 'Wodaabe'=>'Wodaabe', 'YerwaKanuri'=>'Yerwa Kanuri', 'Yoruba'=>'Yoruba', 'Zarma'=>'Zarma')) }}
				                
						</div>
						<div class="col-lg-6 col-sm-6">
						{{ Form::label('Academic qualification') }}
						         <br>
		{{ Form::select('qualification', array('' => 'qualification', 'olevel' => 'O’level', 'diploma' => 'Diploma', 'bachelordegree' => 'Bachelor’s degree', 'masterdegree' => 'Masters degree', 'phd' => 'Ph.D', 'None' => 'None')) }}
							
						</div>
					</div>
					</div>
					{{ Form::close() }}	

					<div class="row">
						<button class = 'btn-col btn btn-primary btn-sm' id ="prefbtn">
							SEND
						</button>
					</div>    			
					
    		</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="invitemodels">
    	
    	<div class="row">
    		<div class="col-lg-12 col-sm-12">
    			<div class="row">
    				<div class="col-lg-12 col-sm-12">
    					<br>
    					<br>
    					<div id="castadded">
    						
    					</div>
    			<button class ='btn-col btn btn-primary btn-sm' style="font-size: 11px" id="invitemodel">INVITE MODELS</button>
    			<button class ='btn-col btn btn-primary btn-sm' style="font-size: 11px" data-toggle='modal' data-target='#exampleModal2'>INVITE CONTACTED/FAVOURITE MODELS</button>
    			<br>
    			<br>
    			<p class="bg-primary" style="padding: 5px">Go to model preferences to filter models based on your preference</p>
    			{{ Form::hidden('cast_ids', $value = $cast->id) }}
    			<br>
    				</div>
    			</div>
    			{{$result}}
    		</div>
    	</div>

    </div>
    <div role="tabpanel" class="tab-pane" id="invitedmodels">
    	<div class="row">
    		<div class="col-lg-12 col-sm-12">
    		<br>
    		<br>
    			@foreach($getinvited as $uses)
    					<div class="col-lg-2 col-sm-3 col-md-3" style="margin-bottom: 30px">
    						@if(isset($uses->imagename))
						{{ HTML::image($uses->imagename, 'profile picture', array('width' => '130px', 'Height' => '130px')) }}
					@else
						{{ HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px')) }}
					@endif
					<p><a href="/models/profile/{{ $uses->user_id }}">{{ str_limit($uses->displayName, $limit = 15, $end = '...') }}</a></p>
    					</div>
    					@endforeach
    		</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="manage">
    	<div class="row">
    		<div class="col-lg-12 col-sm-12">
    			<div class="row">
    				<br>
    				<br>
    				<div class="col-lg-3 col-sm-3">
    					<ul id="folder" class="nav nav-pills nav-stacked" role="tablist">
    						<li role="presentation"><a href="#" aria-controls="applicant" role="tab" data-toggle="tab">FOLDERS</a></li>
						  <li role="presentation" class="active"><a href="#applicant" id="applicants" aria-controls="applicant" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-option-vertical"></span>New Applicants</a></li>
						  <li role="presentation"><a id="confirms" href="#confirmed" aria-controls="confirmed" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-ok"></span>Confirmed</a></li>
						  <li role="presentation"><a id="discards" href="#discarded" aria-controls="discarded" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-trash"></span>Discarded</a></li>
						</ul>
						<br>
						<button class="btn btn-success form-control" id='checkout' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-shopping-cart'></i> Check out</button>
    				</div>
    				<br>
    				<div class="col-lg-9 col-sm-9">
    					<div class="well" style="padding-top: 5px; padding-bottom: 5px">
    						<div class="btn-group" role="group" aria-label="...">
							  <button type="button" class="btn btn-success" id="confirm"><i class='fa fa-check'></i> confirm applicants</button>
							  <button type="button" class="btn btn-danger" id="discard"><i class='fa fa-trash-o'></i> discard applicants</button>
							  
							</div>
    					</div>
    					<div class="row">
    					<div class="col-lg-12 col-sm-12">
    						<div id="show_div">
	    						
	    					</div>
	    					<div id="val"> 
	    						
	    					</div>
	    					<div class="valindex">
	    						@foreach($getAllUser as $userdata)
	    							<div class="well">
	    								<div class="row">
	    									<div class="col-lg-1 col-sm-1 col-xs-1" style="background-color:">
	    										{{ Form::checkbox('users', $userdata->user_id) }}
	    									</div>
	    									<div class="col-lg-7 col-sm-7 col-xs-11">
	    										{{ HTML::image($userdata->imagename, 'profile picture', array('width' => '130px', 'Height' => '160px', 'class' => 'img-left')) }}
	    										<div class="text-left">
	    										<p>{{ link_to("/models/profile/$userdata->user_id", $userdata->displayName, $attributes = array(), $secure = null) }}</p>
	    										<p>Height:  {{ $userdata->Height }} / cm</p>
	    										<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> {{ $userdata->location}}</p>
	    										</div>
	    									</div>
	    									<div class="col-lg-4 col-sm-4">
	    										
	    									</div>
	    								</div>
	    							</div>
	    						@endforeach
	    					</div>
    						
    					</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
  </div>
	</div>
	
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3>Invite Models</h3>
      </div>
      	 <div class="modal-body">
      		<div class="well">
      			<div class="row">
      				<div class="col-lg-4">
      					<select class="form-control getinvite">
      						<option>select options</option>
      						<option value="all">All</option>
      						<option value="contacted">Contacted</option>
      						<option value="favorite">favourite</option>
      					</select>
      				</div>
      			</div>
      		</div>
      		<div class="well">
      			<div class="row getdata">
      				
      			</div>
      		</div>
     	 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary sendinvite">Invite</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><i class='fa fa-shopping-cart'></i> Checkout Cast</h3>
      </div>
  			<div class="modelcheckout">
  				
  			</div>

    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>
@stop
@section('script')
{{ HTML::script('js/paginathing.js') }}

<script type="text/javascript">
	    $('.paginate').paginathing({
	    perPage: 5,
	    limitPagination: 9
		})
</script>

{{ HTML::script('js/showcast.js') }}
{{ HTML::script('js/select2.min.js') }}
@stop