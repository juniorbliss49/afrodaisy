<!DOCTYPE html>
<html>
<head>
	<title>EVENTandSHOW</title>
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
			<table data-sortable class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
                        <th>Job ID</th>
						<th>Name</th>
                        <th>Account No:</th>
                        <th>Bank</th>
                        <th>Amount</th>
					</tr>
				</thead>
				
				<tbody>
					{{$view}}
                    
				</tbody>
			</table>
		</div>
</div>
</body>
</html>