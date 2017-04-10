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
				<div class="col-lg-4">
					<img src="/img/photo.jpg" height="100px" width="100px">
				</div>
				<div class="col-lg-6 text-center">
				<h3>Offline payment Reciept for {{$getjob->title}}</h3>
				<h4>JOB ID : {{$getjob->jobcode}}</h4>	
				</div>
				<div class="col-lg-2">
					
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class='col-lg-6'>
				<p>Bank: Guarantee Trust Bank (Gtb)<p>
				<p>Account name: Kajandi Limited</p>
				<p>Account number : 0229313812
				</div>
				<div class="col-lg-6 text-center">
				<p><strong>Use this sender name as {{$code}}</strong></p>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-6">
					<p style="color: red"><b><i>Note: you must include your name and sender name code on the space provided in your bank slip</i></b></p>
				</div>
			</div>
			<br>
			<table data-sortable class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
                        <th>Bank</th>
                        <th>Account No:</th>
                        <th>Amount</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>1</td>
						<td></td>
						<td></td>
						<th>{{$getjob->amount}}</th>
					</tr>
				</tbody>
			</table>
			<br>
			<br>
			<table data-sortable class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
                        <th>Job Payment ID</th>
                        <th>Amount</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>1</td>
						<td>{{$code}}</td>
						<th>{{$getjob->amount}}</th>
					</tr>
				</tbody>
			</table>
			
		</div>
</div>
</body>
</html>