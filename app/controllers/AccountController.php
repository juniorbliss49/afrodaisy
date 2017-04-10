<?php

class AccountController extends BaseController{


	public function account()
	{
		# code...
		return View::make('account.index');
	}

	public function unpaidcast()
	{
		# code...
		$getunpaid = DB::table('unpaidcast')->orderBy('id', 'DESC')->get();
		$id = 0;
		$view = '';

		foreach ($getunpaid as $key) {
			# code...
			$getdtls = DB::table('casting')->where('id', '=', $key->cast_id)->first();

			$user = User::find($getdtls->user_id);
			$name = $user->Others->agentName;
                                        
            $id += 1;
                 $dateofcast = $getdtls->Yearcast."-".$getdtls->Monthcast."-".$getdtls->DayExp;                       
                 $expofcast = $getdtls->Yearend."-".$getdtls->Monthend."-".$getdtls->Dayend;
		$view .=	"<tr>
		                <td>$id</td>
		                <td>$getdtls->castTitle</td>
		                <td>$dateofcast</td>
		                <td>$expofcast</td>
		                <td>$name</td>
		            </tr>";
		}

		return View::make('account.unpaid')->with(compact('getunpaid', 'view'));
	}

	public function paidcast()
	{
		# code...
		$getpaid = DB::table('castreceipt')->select('id','cast_id')->groupBy('cast_id')->get();
		$id = 0;
		$view = '';


		foreach ($getpaid as $key) {
			# code...
			$total = DB::table('castreceipt')->where('cast_id', '=', $key->cast_id)->sum('amount');
			$getdtls = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$getcount = DB::table('modelscastpayment')->where('cast_id', '=', $key->cast_id)->where('status', '=', 'active')->count();

			$Amount = $getdtls->payDesc * $getcount;

			$user = User::find($getdtls->user_id);
			$name = $user->Others->agentName;
                                        
            $id += 1;
                 $dateofcast = $getdtls->Yearcast."-".$getdtls->Monthcast."-".$getdtls->DayExp;                       
                 $expofcast = $getdtls->Yearend."-".$getdtls->Monthend."-".$getdtls->Dayend;
		$view .=	"<tr>
		                <td>$id</td>
		                <td>$getdtls->castcode</td>
		                <td>$dateofcast</td>
		                <td>$expofcast</td>
		                <td>$name</td>
		                <td>$Amount</td>
		                <td>$total</td>
		                <td><button class='btn btn-success viewpaid' data-toggle='modal' data-target='#exampleModal' id=$key->cast_id>View</button></td>
		            </tr>";
		}

		return View::make('account.paid')->with(compact('getunpaid', 'view'));
	}

	public function castreceipt()
	{
		# code...
		$getreceipt = DB::table('castreceipt')->get();
		$id = 0;
		$view = '';

		foreach ($getreceipt as $key) {
			# code...
			$id += 1;

			$timestamp = strtotime($key->created_at);
    	$date = date('l, j F Y', $timestamp);

			$getdtls = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$view .=	"<tr>
		                <td>$id</td>
		                <td>$getdtls->castcode</td>
		                <td>$date</td>
		                <td><button class='btn btn-success viewreceipt' data-toggle='modal' data-target='#exampleModal' id=$key->id>View</button></td>
		            </tr>";
		}
		return View::make('account.castreceipt')->with(compact('view'));
	}

	public function viewpaid()
	{
		# code...
		$id = $_GET['id'];
		$view = '';
		$getcast = DB::table('paidcast')->where('cast_id', '=', $id)->first();
		$user = User::find($getcast->user_id);
		$name = $user->Others->agentName;
		$getcstdtl = DB::table('casting')->where('id', '=', $getcast->cast_id)->first();
		$getreceipt = DB::table('castreceipt')->where('cast_id', '=', $id)->get();

    	$date = date('Y-m-d');
    	$recno = "00".$getcast->id;
    	$amountword = $getcast->amount;
    	$total = '';
    	$nomodels = '';

	$view .=	"<div class-'row'>
					<div class='col-lg-12'>
						<table class='table table-responsive'>
							<thead>
							<tr>
								<th>Cast ID</th>
								<th>No:</th>
								<th>Amount</th>
							</tr>
							</thead>
							<tbody>";
						foreach ($getreceipt as $key) {
									# code...
							$total += $key->amount;
							$nomodels += $key->nomodels;
		$view .=				"<tr>
									<td>".$getcstdtl->castcode."</td>
									<td>".$key->nomodels."</td>
									<td>".$key->amount."</td>
								</tr>";
								}		
		$view	.=				"<tr>
									<td><strong>Total</strong></td>
									<td>$nomodels</td>
									<td>$total</td>
								</tr>
							</tbody>	
						</table>
					</div>
				</div>";

	echo $view;
	}

	public function viewreceipt()
	{
		# code...
		$id = $_GET['id'];
		$view = '';
		$getcast = DB::table('castreceipt')->where('id', '=', $id)->first();
		$getcstdtl = DB::table('casting')->where('id', '=', $getcast->cast_id)->first();
		$user = User::find($getcstdtl->user_id);
		$name = $user->Others->agentName;

    	$timestamp = strtotime($getcast->created_at);
    	$date = date('Y-m-d', $timestamp);
    	$recno = "00".$getcast->id;
    	$amountword = $getcast->amount;
    	$total = '';
    	$nomodels = '';

	$view .=	"<div class-'row'>
					<div class='col-lg-4 pull-left'>";
	$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '80px'));
	$view .=		"</div>
					<div class='col-lg-4'>
					</div>
					<div class='col-lg-4'>
						<h5>Date: ".$date."</h5>
						<h5>Official Receipt</h5>
						<h5>No: ".$recno."</h5>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-12 text-left'>
						<h5>To : ".$name."</h5>
						<h5>The sum of : ".$amountword."</h5>
						<h5>Cast code : ".$getcstdtl->castcode."</h5>
						<h5>Being full payment for : ".$getcstdtl->castTitle."</h5>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-12'>
						<table data-sortable class='table table-hover'>
							<thead>
								<tr>
									<th>No</th>
									<th>Type</th>
									<th>Qty</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td>1</td>
									<td>Models</td>
									<td>".$getcast->nomodels."</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-4'>
					<hr>
					<h4>Sign</h4>
					</div>
				</div>";

	echo $view;

	}

	public function castpayment()
	{
		# code...
		$getcast = DB::table('casting')->where('status', '=', 'finished')->orderBy('id', 'DESC')->where('payType', '=', 'paid')->get();

		$view = '';
		$no = 0;

		$view .= "<tbody>";
				foreach ($getcast as $key) {

		$btn = '';

		$getpayment = DB::table('castpayment')->where('cast_id', '=', $key->id)->get();
		if ($getpayment) {
			$btn = "<i class='fa fa-check'></i>Paid";
			$btn2 = "<button class='btn btn-success'>Paid</button>";
		}else{
			$btn = "<i class='fa fa-exclamation-circle'></i>Pending";
			$btn2 = "<a class='btn btn-success' href=castpayment/$key->id>View</a>";
		}
					# code...
		$getamount = DB::table('modelscastpayment')->where('cast_id', '=', $key->id)->where('status', '=', 'active')->sum('amount');
					$no += 1;
		$view .= "<tr>
						<td>$no</td>
						<td>$key->castcode</td>
						<td>$getamount</td>
						<td>$btn</td>
						<td>$btn2</td>
						<td><button class='btn btn-success viewslip' data-toggle='modal' data-target='#exampleModal' id=$key->id>View</button></td></td>
					</tr>";
				}


		$view	.= "</tbody>";


		return View::make('account.castpayment')->with(compact('view'));

	}

	public function payment($id)
	{
		$getdtl = DB::table('casting')->where('id', '=', $id)->first();
		$getcast = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('status', '=', 'active')->get();
		$view = '';
		$cast = $id;
		$id = '';

		foreach ($getcast as $key) {
			# code...
			$id += 1;

			$getmodels = User::find($key->user_id);
			$name = $getmodels->NewModel->displayName;
			$pix = $getmodels->photoupload->imagename;

			$getack = DB::table('castackmsg')->where('user_id', '=', $key->user_id)->where('cast_id', '=', $cast)->first();

			if ($getack) {
				$btn = "<i class='fa fa-check'></i> Pending";
				# code...
			}else{
				$btn = "<i class='fa fa-check'></i> Acknoledged";
			}

		$view .= "<tr>	
					<td>$id</td>
					<td><input type='checkbox' name='model_id[]' value=$key->user_id></td>
					<td><img src=/".$pix." width='50px'>$name</td>
					<td>$btn</td>
				  </tr>";
		}

		# code...
		return View::make('account.payment')->with(compact('view', 'getdtl'));
	}

	public function createpayment()
	{
		# code...

		$data = Input::all();

		$validator = Validator::make($data, castpayment::$rules);

		if ($validator->fails()) {

		return Redirect::back()->withErrors($validator)->withInput();

		}

		$model_id = $_POST['model_id'];
		$cast_id = $_POST['cast_id'];
		$ackid = 1;
		$getcast = DB::table('casting')->where('id', '=', $cast_id)->first();
		foreach ($model_id as $key => $value) {
			# code...
			$chpay = DB::table('castpayment')->where('cast_id', '=', $cast_id)->where('user_id', '=', $value)->where('ackid', '=', $ackid)->get();

			if ($chpay) {
				# code...
			}else{
			$castpayment = new castpayment;
			$castpayment->cast_id = $cast_id;
			$castpayment->user_id = $value;
			$castpayment->ackid = $ackid;
			$castpayment->amount = $getcast->payDesc;
			$castpayment->save();
			}
		}
		return $this->viewpayslip($cast_id, $ackid);
			
	}

	public function viewpayslip($id, $ackid)
	{
		# code...
		$id = $id;
		$ackid = $ackid;
		$getpayment = DB::table('castpayment')->where('cast_id', '=', $id)->where('ackid', '=', $ackid)->get();
		$view = '';
		$no = '';
		$amount = '';
		$acctName = '';
		$bank = '';
		$acctnum = '';
		$getcast = DB::table('casting')->where('id', '=', $id)->first();

		foreach ($getpayment as $key) {
			# code...
			$no += 1;

			$getmodels = User::find($key->user_id);

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

			$bankdetails = DB::table('bankdetails')->where('user_id', '=', $key->user_id)->first();
			if ($bankdetails) {
				$acctnum = $bankdetails->acctno;
				$acctName = $bankdetails->acctname;
				$bank = $bankdetails->bank;
			}else{
				$acctName = $name;
			}

			$pix = $getmodels->photoupload->imagename;
			$amount += $getcast->payDesc;

		$view .= "<tr>	
					<td>$no</td>
					<td>$getcast->castcode</td>
				  <td>$acctName</td>
					<td>$acctnum</td>
					<td>$bank</td>
					<td>$getcast->payDesc</td>
				  </tr>";
		}
		$view .="<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td>$amount</td>
				</tr>";

		return View::make('account.viewpayslip')->with(compact('view', 'getcast','ackid'));

	}

	public function printpaymentslip($cast, $ackid)
	{
		# code...
		$id = $cast;
		$ackid = $ackid;
		$getpayment = DB::table('castpayment')->where('cast_id', '=', $id)->where('ackid', '=', $ackid)->get();
		$view = '';
		$no = '';
		$amount = '';
		$acctName = '';
		$bank = '';
		$acctnum = '';
		$getcast = DB::table('casting')->where('id', '=', $id)->first();

		foreach ($getpayment as $key) {
			# code...
			$no += 1;

			$getmodels = User::find($key->user_id);

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

			$bankdetails = DB::table('bankdetails')->where('user_id', '=', $key->user_id)->first();
			if ($bankdetails) {
				$acctnum = $bankdetails->acctno;
				$acctName = $bankdetails->acctname;
				$bank = $bankdetails->bank;
			}else{
				$acctName = $name;
			}

			$pix = $getmodels->photoupload->imagename;
			$amount += $getcast->payDesc;

		$view .= "<tr>	
					<td>$no</td>
					<td>$getcast->castcode</td>
				  <td>$acctName</td>
					<td>$acctnum</td>
					<td>$bank</td>
					<td>$getcast->payDesc</td>
				  </tr>";
		}
		$view .="<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td>$amount</td>
				</tr>";

		return View::make('account.printpaymentslip')->with(compact('view', 'getcast', 'ackid'));
	}

	public function report()
	{
		# code...
		$getcast = DB::table('casting')->where('status', '!=', '')->get();
		$getlocation = DB::table('casting')->where('status', '!=', '')->select('location')->distinct()->get();
		$id = '';
		$view = '';

		foreach ($getcast as $key) {
			# code...
			$total = DB::table('castreceipt')->where('cast_id', '=', $key->id)->sum('amount');
			$user = User::find($key->user_id);
			$name = $user->Others->agentName;
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>$key->castcode</td>
						<td>$name</td>
						<td>$key->location</td>
						<td>$total</td>
						<td>$key->status</td>
					 </tr>";
		}
		return View::make('account.report')->with(compact('view', 'getlocation'));
	}

	public function filterReport()
	{
		# code...
		$fromDay = $_GET['fromDay'];
      $fromMonth = $_GET['fromMonth'];
      $fromYear = $_GET['fromYear'];
      $toDay = $_GET['toDay'];
      $toMonth = $_GET['toMonth'];
      $toYear = $_GET['toYear'];
      $paystatus = $_GET['paystatus'];
      $location = $_GET['location'];

      $cast = DB::table('casting');
      $getit = '';
      $view = '';

      if ($fromDay != 0) {
      	# code...
			$getit = $cast->where('Daycast', '>=', $fromDay)->where('Monthcast', '>=', $fromMonth)->where('Yearcast', '>=', $fromYear)->where('Daycast', '<=', $toDay)->where('Monthcast', '<=', $toMonth)->where('Yearcast', '<=', $toYear);
      }
      if (!empty($paystatus)) {
      	# code...
      		if ($paystatus == 'paid') {
      			# code...
      			$getit = $cast->where('payType', '=', 'paid');
      		}else{
      			# code...
      			$getit = $cast->where('payType', '!=', 'paid');
      		}
      }if (!empty($location)) {
      	# code...
      	if ($location == 'all') {
      			# code...
      		$getit = $cast->where('location', '!=', '');
      		}else{
      		$getit = $cast->where('location', '=', $location);
      		}
      }

      $result = $getit->where('status', '!=', '')->get();

      if ($result) {
      	# code...
      	$id = '';
	 $view  .=   	"<table data-sortable class='table table-hover'>
						<thead>
							<tr>
								<th>No</th>
			                    <th>Cast ID</th>
								<th>Posted By</th>
			                    <th>Loctation</th>
			                    <th>Amount</th>
			                    <th>Status</th>
							</tr>
						</thead>
						
						<tbody>";

      	foreach ($result as $key) {
      	# code...
      		$total = DB::table('castreceipt')->where('cast_id', '=', $key->id)->sum('amount');
      		$user = User::find($key->user_id);
			$name = $user->Others->agentName;
      		$id += 1;
      			$view .= "<tr>
						<td>$id</td>
						<td>$key->castcode</td>
						<td>$name</td>
						<td>$key->location</td>
						<td>$total</td>
						<td>$key->status</td>
					 <tr>";
      }
      $view .= "</tbody>
      			</table>";

      }else{
      	$view .= 'Empty';
      }
      
      echo $view;

	}

	public function poppayslip()
	{
		# code...
		$id = $_GET['id'];
		$getcast = DB::table('casting')->where('id', '=', $id)->first();
		$getpayment = DB::table('castpayment')->where('cast_id', '=', $id)->groupBy('ackid')->get();

		$view = '';
		$no = '';

		$view .= "<div class='row'>
					<div class='col-lg-12'>
						<h3>$getcast->castcode</h3>
						<br>
						<table data-sortable class='table table-hover'>
							<thead>
								<tr>
									<th>No</th>
									<th>Models</th>
									<th>Amount</th>
                                    <th>View Payslip</th>
								</tr>
							</thead>
							<tbody>";

		foreach ($getpayment as $key) {
			# code...
			$no += 1;
		$getnomodels = DB::table('castpayment')->where('cast_id', '=', $id)->where('ackid', '=', $key->ackid)->count();
		$getamount = DB::table('castpayment')->where('cast_id', '=', $id)->where('ackid', '=', $key->ackid)->sum('amount');
		
		$view	.=		"
								<tr>
									<td>$no</td>
									<td>$getnomodels</td>
									<td>$getamount</td>
									<td><a class='btn btn-success' target='#' href=viewpayslip/$id/$key->ackid>View</a></td>
								</tr>
							";
	}
		$view .= "</tbody>
					</table>
					</div>
				</div>";

	echo $view;
	}

	public function popjobpayslip()
	{
		# code...
		$id = $_GET['id'];
		$getcast = DB::table('job')->where('id', '=', $id)->first();
		$getpayment = DB::table('jobpayment')->where('job_id', '=', $id)->get();

		$view = '';
		$no = '';

		$view .= "<div class='row'>
					<div class='col-lg-12'>
						<h3>$getcast->jobcode</h3>
						<br>
						<table data-sortable class='table table-hover'>
							<thead>
								<tr>
									<th>No</th>
									<th>Users</th>
									<th>Amount</th>
                                    <th>View Payslip</th>
								</tr>
							</thead>
							<tbody>";

		foreach ($getpayment as $key) {
			# code...
			$no += 1;
		$getnomodels = DB::table('jobpayment')->where('job_id', '=', $id)->count();
		$getamount = DB::table('jobpayment')->where('job_id', '=', $id)->sum('amount');
		
		$view	.=		"
								<tr>
									<td>$no</td>
									<td>$getnomodels</td>
									<td>$getamount</td>
									<td><a class='btn btn-success' target='#' href=viewjobpayslip/$id>View</a></td>
								</tr>
							";
	}
		$view .= "</tbody>
					</table>
					</div>
				</div>";

	echo $view;
	}

	public function outstanding()
	{
		# code...
		$getpayment = DB::table('castpayment')->orderBy('cast_id', 'DESC')->groupBy('cast_id')->get();
		$view = '';
		$id = '';

		foreach ($getpayment as $key) {
			# code...
			$getcastpayment = DB::table('modelscastpayment')->where('status', '=', 'active')->where('cast_id', '=', $key->cast_id)->get();

			if ($getcastpayment) {
				# code...
				foreach ($getcastpayment as $keys) {
				 	# code...
				 	$getpay = DB::table('castpayment')->where('cast_id', '=', $keys->cast_id)->where('user_id', '=', $keys->user_id)->get();
				 	if ($getpay) {
				 		# code...
				 	}else{
				 		$id += 1;
				$getcast = DB::table('casting')->where('id', '=', $keys->cast_id)->first();
				$user = User::find($keys->user_id);
				$agent = User::find($getcast->user_id);
				$agentName = $agent->Others->agentName;
				$name = $user->NewModel->displayName;
				$view .= "<tr>
							<td>$id</td>
							<td>$getcast->castcode</td>
							<td>$agentName</td>
							<td>$name</td>
							<td>$getcast->payDesc</td>
							<td><a class='btn btn-success' href=/account/outstanding/$keys->cast_id/$keys->user_id>View</a></td>
						</tr>";
				 	}
				 } 
			}
		}
		return View::make('account.outstanding')->with(compact('view'));
	}

	public function outstandingview($cast, $id)
	{
		# code...
		$view = '';
		$getcast = DB::table('casting')->where('id', '=', $cast)->first();
		


		$getack = DB::table('castackmsg')->where('cast_id', '=', $cast)->where('user_id', '=', $id)->first();
		
$accept = 'pay';
		$Decline = 'decline';

		if ($getack) {
			$user = User::find($getcast->user_id);
		$agentName = $user->Others->agentName;

		$users = User::find($getack->user_id);
		$name = $users->NewModel->displayName;

			$view .= "<div class='row' style='padding-left: 20px;'>
						<div class='col-lg-12'>
							<h2>Cast: $getcast->castcode</h2>
						</div>
					</div>

					<div class='row' style='padding-left: 20px;'>
						<div class='col-lg-2'>
							<h4>From: </h4>
							<h4>$agentName</h4>
						</div>
						<div class='col-lg-2'>
							<h4>To: </h4>
							<h4>$name</h4>
						</div>
						<div class='col-lg-8'>
							<h4>Reason: </h4>
							<h4>$getack->msg</h4>
						</div>
					</div><br><br>
					<div class='row' style='padding-left: 20px;'>
						<div class='col-lg-4'>
							<a class='btn btn-success' href=/account/castrefund/$cast/$accept/$id><i class='fa fa-check acceptmodel'></i> Accept</a>
							<a class='btn btn-danger' href=/account/castrefund/$cast/$Decline/$id><i class='fa fa-trash refund'></i> Decline</a>
						<div>
					</div>";
		}else{
			$view .= "<div class='row' style='padding-left: 20px;'>
						<div class='col-lg-12'>
							<h4>Not Found</h4>
						</div>
					</div>
					<div class='row' style='padding-left: 20px;'>
						<div class='col-lg-4'>
							<a class='btn btn-success' href=/account/castrefund/$cast/$accept/$id><i class='fa fa-check acceptmodel'></i> Accept</a>
							<a class='btn btn-danger' href=/account/castrefund/$cast/$Decline/$id><i class='fa fa-trash refund'></i> Decline</a>
						<div>
					</div>";
		}
		return View::make('account.outstandingview')->with(compact('view'));
	}

	public function castapplication()
	{
		$view = '';
		$getapply = DB::table('castapply')->orderBy('id', 'DESC')->get();
		$id = 0;

		foreach ($getapply as $key) {
			# code...
			$id += 1;
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$getcast = DB::table('casting')->where('cast_id', '=', $key->cast_id)->first();
			$user = User::find($getcast->user_id);
			$name = $user->Others->agentName;

			$users = User::find($key->user_id);
			$names = $users->NewModel->displayName;

			$view .= "<tr>
						<td>$id</td>
						<td>$getcast->castcode</td>
						<td>$date</td>
						<td>$name</td>
						<td>$key->amount</td>
						<td>$names</td>
						<td>$getcast->location</td>
					</tr>";
		}
		return View::make('account.castapplication')->with(compact('view'));
	}

	public function courses()
	{
		$getcourse = DB::table('courses')->where('status', '=', 'active')->orderBy('id', 'DESC')->get();
		$view = '';
		$id = 0;


		foreach ($getcourse as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
    	$user = User::find($key->user_id);
    	$name = $user->Others->agentName;

			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>course</td>
						<td>$key->title</td>
						<td>$date</td>
						<td>$key->price</td>
						<td>$key->discount</td>
						<td>$name</td>
					</tr>";
		}
		return View::make('account.courses')->with(compact('view'));
	}

	public function services()
	{
		# code...

		$getservice = DB::table('servicemarketplace')->where('status', '=', 'active')->orderBy('id', 'DESC')->get();
		$view = '';
		$id = 0;

		foreach ($getservice as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
    	$user = User::find($key->user_id);
    	$name = $user->Others->agentName;

			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Service</td>
						<td>$key->name</td>
						<td>$date</td>
						<td>$key->price</td>
						<td>$key->discount</td>
						<td>$name</td>
					</tr>";
		}
		return View::make('account.services')->with(compact('view'));
	}

	public function photosession()
	{
		# code...
		$getphotosession = DB::table('photosession')->where('status', '=', 'active')->orderBy('id', 'DESC')->get();
		$view = '';
		$id = 0;

		foreach ($getphotosession as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
    	$user = User::find($key->user_id);
    	$name = $user->Others->agentName;

			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Photosession</td>
						<td>$key->title</td>
						<td>$date</td>
						<td>$key->price</td>
						<td>$key->discount</td>
						<td>$name</td>
					</tr>";
		}
		return View::make('account.photosession')->with(compact('view'));
	}

	public function booked()
	{
		# code...
		$getcoursebook = DB::table('bookcourse')->orderBy('id', 'DESC')->get();
		$getbookphotosession = DB::table('bookphotosession')->orderBy('id', 'DESC')->get();
		$getbookservice = DB::table('bookservice')->orderBy('id', 'DESC')->get();
		
		$view = '';
		$id = 0;

		foreach ($getcoursebook as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('courses')->where('id', '=', $key->coursesid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Courses</td>
						<td>$name</td>
						<td>$getcoursedtl->title</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}

		foreach ($getbookphotosession as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('photosession')->where('id', '=', $key->photoid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Photosession</td>
						<td>$name</td>
						<td>$getcoursedtl->title</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}

		foreach ($getbookservice as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    		$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('servicemarketplace')->where('id', '=', $key->serviceid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Services</td>
						<td>$name</td>
						<td>$getcoursedtl->name</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}

		return View::make('account.booked')->with(compact('view'));

	}

	public function changeType()
	{
		# code...
				$getcoursebook = DB::table('bookcourse')->orderBy('id', 'DESC')->get();
		$getbookphotosession = DB::table('bookphotosession')->orderBy('id', 'DESC')->get();
		$getbookservice = DB::table('bookservice')->orderBy('id', 'DESC')->get();
		$id = $_GET['id'];

		if ($id == "all") {
			# code...
			$view = '';
			$view = "<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
							<thead>
								<tr>
									<th>No</th>
                                    <th>Type</th>
									<th>Name</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Booked Date</th>
								</tr>
							</thead>
							
							<tbody>";
					foreach ($getcoursebook as $key) {
			# code...
						$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('courses')->where('id', '=', $key->coursesid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Courses</td>
						<td>$name</td>
						<td>$getcoursedtl->title</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}

		foreach ($getbookphotosession as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('photosession')->where('id', '=', $key->photoid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Photosession</td>
						<td>$name</td>
						<td>$getcoursedtl->title</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}

		foreach ($getbookservice as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('servicemarketplace')->where('id', '=', $key->serviceid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Services</td>
						<td>$name</td>
						<td>$getcoursedtl->name</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}
		$view .= "</tbody>
					</table>";
		echo $view;
		}

		if ($id == "courses") {
			# code...
			$view = "";
			$view = "
						<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
							<thead>
								<tr>
									<th>No</th>
                                    <th>Type</th>
									<th>Name</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Booked Date</th>
								</tr>
							</thead>
							
							<tbody>";
			foreach ($getcoursebook as $key) {
			# code...
				$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('courses')->where('id', '=', $key->coursesid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Courses</td>
						<td>$name</td>
						<td>$getcoursedtl->title</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}
			$view .= "</tbody>
					</table>
				";
				echo $view;
		}

				if ($id == "services") {
			# code...
			$view = "";
			$view = "
						<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
							<thead>
								<tr>
									<th>No</th>
                                    <th>Type</th>
									<th>Name</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Booked Date</th>
								</tr>
							</thead>
							
							<tbody>";
			foreach ($getbookservice as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('servicemarketplace')->where('id', '=', $key->serviceid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Services</td>
						<td>$name</td>
						<td>$getcoursedtl->name</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}
			$view .= "</tbody>
					</table>
				";
				echo $view;
		}
		
		if ($id == "photosession") {
			# code...
			$view = "";
			$view = "
						<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
							<thead>
								<tr>
									<th>No</th>
                                    <th>Type</th>
									<th>Name</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Booked Date</th>
								</tr>
							</thead>
							
							<tbody>";
			foreach ($getbookphotosession as $key) {
			# code...
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$user = User::find($key->user_id);
			$name = $user->NewModel->displayName;
			$getcoursedtl = DB::table('photosession')->where('id', '=', $key->photoid)->first();
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>Photosession</td>
						<td>$name</td>
						<td>$getcoursedtl->title</td>
						<td>$getcoursedtl->price</td>
						<td></td>
						<td>$date</td>
					</tr>";
		}
			$view .= "</tbody>
					</table>
				";
				echo $view;
		}
	}

	public function afrounlimited()
	{
		# code...
				$plan = usersplan::where('status', '=', 'active')->where('plan_id', '=', '3')->get();
				$view = '';
				$id = 0;

				foreach ($plan as $key) {
					# code...

					$getplan = DB::table('userplanduration')->where('user_id', '=', $key->user_id)->where('status', '=', 'active')->Join('limitation', 'userplanduration.plan_id', '=', 'limitation.plan_id')->first();

					$user = User::find($key->user_id);
					$name = $user->NewModel->displayName;
					$location = $user->NewModel->location;

					$stmonth = $getplan->durationFromMonth;
					  $stday = $getplan->durationFromDay;
					  $styear = $getplan->durationFromYear;
					  $stdate = $styear."-".$stmonth."-".$stday;

					  $month = $getplan->durationToMonth;
					  $day = $getplan->durationToDay;
					  $year = $getplan->durationToYear;
					  $date = $year."-".$month."-".$day;

					  if (date('Y') >= $styear) {
					  	# code...
					  	if (date('m') >= $stmonth) {
					  		# code...
					  		if (date('d') >= $stday) {
					  			# code...
					  			$data = "active";
					  		}else{
					  			$data = "inactive";
					  		}
					  	}else{
					  		$data = 'inactive';
					  	}
					  }else{
					  	# code...
					  	$data = "inactive";
					  }

					$id += 1;

				$view .= "<tr>
							<td>$id</td>
							<td>$name</td>
							<td>$location</td>
							<td>3500</td>
							<td>$stdate</td>
							<td>$date</td>
							<td>$data</td>
						 </tr>";
				}

				return View::make('account.afrounlimited')->with(compact('view'));

	}

	public function free()
	{
		# code...
				$plan = usersplan::where('status', '=', 'active')->where('plan_id', '=', '1')->get();
				$view = '';
				$id = 0;

				foreach ($plan as $key) {
					# code...

					$getplan = DB::table('userplanduration')->where('user_id', '=', $key->user_id)->where('status', '=', 'active')->Join('limitation', 'userplanduration.plan_id', '=', 'limitation.plan_id')->first();

					$user = User::find($key->user_id);
					$name = $user->NewModel->displayName;
					$location = $user->NewModel->location;

					$stmonth = $getplan->durationFromMonth;
					  $stday = $getplan->durationFromDay;
					  $styear = $getplan->durationFromYear;
					  $stdate = $styear."-".$stmonth."-".$stday;

					  $month = $getplan->durationToMonth;
					  $day = $getplan->durationToDay;
					  $year = $getplan->durationToYear;
					  $date = $year."-".$month."-".$day;

					  if (date('Y') >= $styear) {
					  	# code...
					  	if (date('m') >= $stmonth) {
					  		# code...
					  		if (date('d') >= $stday) {
					  			# code...
					  			$data = "active";
					  		}else{
					  			$data = "inactive";
					  		}
					  	}else{
					  		$data = 'inactive';
					  	}
					  }else{
					  	# code...
					  	$data = "inactive";
					  }

					$id += 1;

				$view .= "<tr>
							<td>$id</td>
							<td>$name</td>
							<td>$location</td>
							<td>Free</td>
							<td>$stdate</td>
							<td>$date</td>
							<td>$data</td>
						 </tr>";
				}

				return View::make('account.free')->with(compact('view'));

	}

	public function afroplus()
	{
		# code...
				$plan = usersplan::where('status', '=', 'active')->where('plan_id', '=', '2')->get();
				$view = '';
				$id = 0;

				foreach ($plan as $key) {
					# code...

					$getplan = DB::table('userplanduration')->where('user_id', '=', $key->user_id)->where('status', '=', 'active')->Join('limitation', 'userplanduration.plan_id', '=', 'limitation.plan_id')->first();

					$user = User::find($key->user_id);
					$name = $user->NewModel->displayName;
					$location = $user->NewModel->location;

					$stmonth = $getplan->durationFromMonth;
					  $stday = $getplan->durationFromDay;
					  $styear = $getplan->durationFromYear;
					  $stdate = $styear."-".$stmonth."-".$stday;

					  $month = $getplan->durationToMonth;
					  $day = $getplan->durationToDay;
					  $year = $getplan->durationToYear;
					  $date = $year."-".$month."-".$day;

					  if (date('Y') >= $styear) {
					  	# code...
					  	if (date('m') >= $stmonth) {
					  		# code...
					  		if (date('d') >= $stday) {
					  			# code...
					  			$data = "active";
					  		}else{
					  			$data = "inactive";
					  		}
					  	}else{
					  		$data = 'inactive';
					  	}
					  }else{
					  	# code...
					  	$data = "inactive";
					  }

					$id += 1;

				$view .= "<tr>
							<td>$id</td>
							<td>$name</td>
							<td>$location</td>
							<td>2000</td>
							<td>$stdate</td>
							<td>$date</td>
							<td>$data</td>
						 </tr>";
				}

				return View::make('account.afroplus')->with(compact('view'));

	}
	public function income()
	{
		$getReceipt = DB::table('castreceipt')->orderBy('id', 'DESC')->get();
		$id = 0;
		$view = '';
		$form = 10/100;
		$amount = 0;
		$total = 0;
		$tot = 0;

		foreach ($getReceipt as $key) {
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$id += 1;
			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$getuser = User::find($getcast->user_id);
			$name = $getuser->Others->agentName;
			$amount = $form * $key->amount;
			$total += $amount; 
			$tot += $key->amount;
			$view .= "<tr>
						<td>$id</td>
						<td>Cast</td>
						<td>$name</td>
						<td>$getcast->castcode</td>
						<td>$key->amount</td>
						<td>$amount</td>
						<td>$date</td>
					</tr>";
		}

		$view .= 	"<thead>
						<th></th>
						<th></th>
						<th></th>
						<th><strong>Total</strong></th>
						<th>$tot</th>
						<th>$total</th>
						<th></th>
					</thead>";

		return View::make('account.income')->with(compact('view', 'total'));
	}

	public function getincome()
	{
		$source = $_GET['source'];
		$month = $_GET['month'];
		$year = $_GET['year'];

		$id = 0;
		$view = '';
		$form = 10/100;
		$amount = 0;
		$total = 0;
		$tot = 0;


		if ($source == 'cast') {
			if (empty($month)) {
				$getReceipt = DB::table('castreceipt')->orderBy('id', 'DESC')->where('year', '=', $year)->get();
			}elseif (empty($year)) {
				$getReceipt = DB::table('castreceipt')->orderBy('id', 'DESC')->where('month', '=', $month)->get();
			}else{
				$getReceipt = DB::table('castreceipt')->orderBy('id', 'DESC')->where('month', '=', $month)->where('year', '=', $year)->get();
			}

		$view .= "<div class='table-responsive'>
                        <table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
						<thead>
							<tr>
								<th>No</th>
                                <th>Source</th>
								<th>User</th>
                                <th>Cast code</th>
                                <th>Amount Paid</th>
                                <th>Interest</th>
                                <th>Date Paid</th>
							</tr>
						</thead>
						
						<tbody>";
            
		foreach ($getReceipt as $key) {
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$id += 1;
			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$getuser = User::find($getcast->user_id);
			$name = $getuser->Others->agentName;
			$amount = $form * $key->amount;
			$total += $amount;
			$tot += $key->amount;
			$view .= "<tr>
						<td>$id</td>
						<td>Cast</td>
						<td>$name</td>
						<td>$getcast->castcode</td>
						<td>$key->amount</td>
						<td>$amount</td>
						<td>$date</td>
					</tr>";
		}

		$view .= 	"<thead>
						<th></th>
						<th></th>
						<th></th>
						<th><strong>Total</strong></th>
						<th>$tot</th>
						<th>$total</th>
						<th></th>
					</thead>";

		$view .= 	"</tbody>
					</table>
				</div>";

		echo $view;
		}

				if ($source == 'subscription') {
			if (empty($month)) {
				$getReceipt = DB::table('subscription')->orderBy('id', 'DESC')->where('year', '=', $year)->get();
			}elseif (empty($year)) {
				$getReceipt = DB::table('subscription')->orderBy('id', 'DESC')->where('month', '=', $month)->get();
			}else{
				$getReceipt = DB::table('subscription')->orderBy('id', 'DESC')->where('month', '=', $month)->where('year', '=', $year)->get();
			}

		$view .= "<div class='table-responsive'>
                        <table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
						<thead>
							<tr>
								<th>No</th>
                                <th>Source</th>
								<th>User</th>
								<th>Plan</th>
                                <th>Amount Paid</th>
                                <th>Date Paid</th>
							</tr>
						</thead>
						
						<tbody>";
            
		foreach ($getReceipt as $key) {
			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);
			$id += 1;
			$getuser = User::find($key->user_id);
			$name = $getuser->NewModel->displayName;
			$amount = $key->amount;
			if ($key->plan_id == '2') {
				# code...
				$btn = 'Afro Plus';
			}else{
				$btn = 'Afro Unlimited';
			}
			$total += $amount;
			$tot += $key->amount;
			$view .= "<tr>
						<td>$id</td>
						<td>Subscription</td>
						<td>$name</td>
						<td>$btn</td>
						<td>$key->amount</td>
						<td>$date</td>
					</tr>";
		}

		$view .= 	"<thead>
						<th></th>
						<th></th>
						<th></th>
						<th><strong>Total</strong></th>
						<th>$tot</th>
						<th>$total</th>
						<th></th>
					</thead>";

		$view .= 	"</tbody>
					</table>
				</div>";

		echo $view;


		}

	}

	public function summary()
		{
			$view = '';
			$totinc = 0;

			$year = date('Y');

			$getcast = DB::table('castreceipt')->orderBy('id', 'DESC')->where('year', '=', $year)->sum('amount');
			$getsub = DB::table('subscription')->orderBy('id', 'DESC')->where('year', '=', $year)->sum('amount');

			$totinc = $getcast + $getsub;

			$getcastrefund = DB::table('castrefund')->orderBy('id')->where('year', '=', $year)->sum('amount');
			$gain = $totinc - $getcastrefund;

			$view .= "<tr>
						<td>1</td>
						<td>$totinc</td>
						<td>$getcastrefund</td>
						<td>$gain</td>
					</tr>";


			return View::make('account.summary')->with(compact('view'));
		}

		public function castrefund($cast,$dtl,$id)
		{
			# code...
			$user_id = $id;
			$cast_id = $cast;
			$dtl = $dtl;

			$getcastpayment = DB::table('modelscastpayment')->where('status', '=', 'active')->where('cast_id', '=', $cast_id)->where('user_id', '=', $user_id)->update(array('status' => 'inactive'));


			$getcast = DB::table('casting')->where('id', '=', $cast_id)->first();
			$amount = $getcast->payDesc * 0.1;
			$total = $getcast->payDesc - $amount;

			if ($dtl == 'pay') {
				# code...
				$getpayment = DB::table('castpayment')->where('cast_id', '=', $cast_id)->where('user_id', '=', $user_id)->where('ackid', '=', 2)->get();
				if ($getpayment) {
					# code...

				}else{
				$castpayment = new castpayment;
				$castpayment->cast_id = $cast_id;
				$castpayment->user_id = $user_id;
				$castpayment->ackid = 2;
				$castpayment->amount = $amount;  
				$castpayment->save();
				}


			return $this->castprintpay($cast_id,$user_id);

			}elseif ($dtl == 'decline') {
				# code..

			$getcastrefund = DB::table('castrefund')->where('cast_id', '=', $cast_id)->where('user_id', '=', $user_id)->get();

			if ($getcastrefund) {
				# code...
			}else{
			$castrefund = new castrefund;
			$castrefund->cast_id = $cast_id;
			$castrefund->user_id = $user_id;
			$castrefund->month = date('m');
			$castrefund->year = date('Y');
			$castrefund->amount = $total;
			$castrefund->save();

			}


			return $this->refund();

			}


		}

		public function castprintpay($cast_id,$user_id)
		{
		# code...
		$id = $cast_id;
		$ackid = 2;
		$getpayment = DB::table('castpayment')->where('cast_id', '=', $id)->where('ackid', '=', $ackid)->where('user_id', '=', $user_id)->get();
		$view = '';
		$no = '';
		$amount = '';
		$getcast = DB::table('casting')->where('id', '=', $id)->first();

		foreach ($getpayment as $key) {
			# code...
			$no += 1;

			$getmodels = User::find($key->user_id);
			$name = $getmodels->NewModel->displayName;
			$pix = $getmodels->photoupload->imagename;
			$amount += $getcast->payDesc;

		$view .= "<tr>	
					<td>$no</td>
					<td>$getcast->castcode</td>
					<td>$name</td>
					<td>1234566</td>
					<td>Gtbank</td>
					<td>$getcast->payDesc</td>
				  </tr>";
		}
		$view .="<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td>$amount</td>
				</tr>";

		return View::make('account.printpaymentslip')->with(compact('view', 'getcast', 'ackid'));
	}

	public function refund()
	{
		$getrefund = DB::table('castrefund')->orderBy('id', 'DESC')->get();
		$id = 0;
		$view = '';

		foreach ($getrefund as $key) {
			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$getuser = User::find($getcast->user_id);
			$name = $getuser->Others->agentName;

			$agent = User::find($key->user_id);
			$user = $agent->NewModel->displayName;
			$id += 1;
			$view .= "<tr>
						<td>$id</td>
						<td>$name</td>
						<td>$user</td>
						<td>$getcast->castcode</td>
						<td>$key->amount</td>
					</tr>";
		}
		return View::make('account.refund')->with(compact('view'));
	}

	public function expenses()
	{
		# code...
		$getcastrefund = DB::table('castrefund')->orderBy('id', 'DESC')->get();
		$view = '';
		$id = 0;

		foreach ($getcastrefund as $key) {
			# code...
			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$user = User::find($getcast->user_id);
			$name = $user->Others->agentName;
			$id += 1; 
			$view .= "<tr>
						<td>$id</td>
						<td>$name</td>
						<td>$getcast->castcode</td>
						<td>$key->amount</td>
					 </tr>";
		}
		return View::make('account.expenses')->with(compact('view'));
	}

	public function advert()
	{
		# code...
		$view = '';
		$id = 0;
		$getadvert = DB::table('advert')->orderBy('id', 'DESC')->get();
		foreach ($getadvert as $key) {
			# code...
			$id += 1;
		$view .= "<tr>
					<td>$id</td>
					<td>$key->user</td>
					<td>$key->advertname</td>
					<td>$key->duration</td>
					<td>$key->amount</td>
				</tr>";
		}

		return View::make('account.advert')->with(compact('view'));
	}

	public function createadvert()
	{

		$user = $_POST['user'];
		$advertname = $_POST['advertname'];
		$duration = $_POST['duration'];
		$amount = $_POST['amount'];

		$createadvert = new advert;
		$createadvert->user = $user;
		$createadvert->advertname = $advertname;
		$createadvert->duration = $duration;
		$createadvert->amount = $amount;
		$createadvert->month = date('m');
		$createadvert->year = date('Y');
		$createadvert->save();

		return Redirect::to('account/advert');
	}

	public function offphoto()
	{
		$getdata = DB::table('offlinepayoutphotosession')->get();
		$id = '';

		$view = '';
		$status = '';
		$name = '';
		$btn = '';

		foreach ($getdata as $key) {
			$id++;
			$getphotosession = DB::table('photosession')->where('id', '=', $key->photosession_id)->first();
			if ($key->status == '') {
				$status = "<button class='btn btn-warning'>Pending</button>";
				$btn = "<button class='btn btn-success verifyphoto' data-toggle='modal' data-target='#exampleModal' id=$key->id>Verify</button>";
			}else{
				$status = "<button class='btn btn-success'>Active</button>";
				$btn = "<button class='btn btn-success'>Verified</button>";
			} 

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

		$view .= "<tr id=photo$key->id>
						<td>$id</td>
						<td>$name</td>
						<td>$getphotosession->title</td>
						<td>$key->ref_id</td>
						<td>$key->amount</td>
						<td>$status</td>
						<td>$btn</td>
					</tr>";
		}
		return View::make('account/offphoto')->with(compact('view'));
	}

	public function getverifyphoto()
	{
		$getid = $_GET['val'];
		$view = '';
		$getphot = DB::table("offlinepayoutphotosession")->where("id", '=', $getid)->first();
		$view = "<div class='row'>
					<div class='col-lg-12'>
					<p><strong>Are u sure u want to active $getphot->ref_id?</strong></p>
					<button class='btn btn-success photoyes' id=$getid>Yes</button>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
					</div>
				</div>";
		echo $view;
	}

	public function approvephoto()
	{
	
	$getid = $_GET['val'];
	$offlinepayoutphotosession = DB::table('offlinepayoutphotosession')->where('id', '=', $getid)->update(array('status' => 'yes'));

	$getphoto = DB::table('offlinepayoutphotosession')->where('id', '=', $getid)->first();

	$photocoursebook = new bookphotosession;
	$photocoursebook->photoid = $getphoto->photosession_id;
	$photocoursebook->user_id = $getphoto->user_id;
	$photocoursebook->amount = $getphoto->amount;
	$photocoursebook->save();
	}

	public function offcourses()
	{
		$getdata = DB::table('offlinepayoutcourses')->get();
		$id = '';

		$view = '';
		$status = '';
		$name = '';
		$btn = '';

		foreach ($getdata as $key) {
			$id++;
			$getphotosession = DB::table('courses')->where('id', '=', $key->course_id)->first();
			if ($key->status == '') {
				$status = "<button class='btn btn-warning'>Pending</button>";
				$btn = "<button class='btn btn-success verifycourses' data-toggle='modal' data-target='#exampleModal' id=$key->id>Verify</button>";
			}else{
				$status = "<button class='btn btn-success'>Active</button>";
				$btn = "<button class='btn btn-success'>Verified</button>";
			} 

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

		$view .= "<tr id=course$key->id>
						<td>$id</td>
						<td>$name</td>
						<td>$getphotosession->title</td>
						<td>$key->ref_id</td>
						<td>$key->amount</td>
						<td>$status</td>
						<td>$btn</td>
					</tr>";
		}
		return View::make('account/offcourses')->with(compact('view'));
	}
	
	public function getverifycourses()
	{
		$getid = $_GET['val'];
		$view = '';
		$getphot = DB::table("offlinepayoutcourses")->where("id", '=', $getid)->first();
		$view = "<div class='row'>
					<div class='col-lg-12'>
					<p><strong>Are u sure u want to active $getphot->ref_id?</strong></p>
					<button class='btn btn-success courseyes' id=$getid>Yes</button>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
					</div>
				</div>";
		echo $view;
	}

	public function approvecourse()
	{
	
	$getid = $_GET['val'];
	$offlinepayoutphotosession = DB::table('offlinepayoutcourses')->where('id', '=', $getid)->update(array('status' => 'yes'));

	$getphoto = DB::table('offlinepayoutcourses')->where('id', '=', $getid)->first();

	$photocoursebook = new bookcourse;
	$photocoursebook->coursesid = $getphoto->course_id;
	$photocoursebook->user_id = $getphoto->user_id;
	$photocoursebook->amount = $getphoto->amount;
	$photocoursebook->save();
	}

	public function offservice()
	{
		$getdata = DB::table('offlinepayoutservices')->get();
		$id = '';

		$view = '';
		$status = '';
		$name = '';
		$btn = '';

		foreach ($getdata as $key) {
			$id++;
			$getphotosession = DB::table('servicemarketplace')->where('id', '=', $key->service_id)->first();
			if ($key->status == '') {
				$status = "<button class='btn btn-warning'>Pending</button>";
				$btn = "<button class='btn btn-success verifyservice' data-toggle='modal' data-target='#exampleModal' id=$key->id>Verify</button>";
			}else{
				$status = "<button class='btn btn-success'>Active</button>";
				$btn = "<button class='btn btn-success'>Verified</button>";
			} 

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

		$view .= "<tr id=service$key->id>
						<td>$id</td>
						<td>$name</td>
						<td>$getphotosession->name</td>
						<td>$key->ref_id</td>
						<td>$key->amount</td>
						<td>$status</td>
						<td>$btn</td>
					</tr>";
		}
		return View::make('account/offservice')->with(compact('view'));
	}

	public function getverifyservice()
	{
		$getid = $_GET['val'];
		$view = '';
		$getphot = DB::table("offlinepayoutservices")->where("id", '=', $getid)->first();
		$view = "<div class='row'>
					<div class='col-lg-12'>
					<p><strong>Are u sure u want to active $getphot->ref_id?</strong></p>
					<button class='btn btn-success serviceyes' id=$getid>Yes</button>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
					</div>
				</div>";
		echo $view;
	}

	public function approveservice()
	{
	$getid = $_GET['val'];
	$offlinepayoutphotosession = DB::table('offlinepayoutservices')->where('id', '=', $getid)->update(array('status' => 'yes'));

	$getphoto = DB::table('offlinepayoutservices')->where('id', '=', $getid)->first();

	$photocoursebook = new bookservice;
	$photocoursebook->serviceid = $getphoto->service_id;
	$photocoursebook->user_id = $getphoto->user_id;
	$photocoursebook->amount = $getphoto->amount;
	$photocoursebook->save();
	}

	public function offcast()
	{
		$getdata = DB::table('offlinepayoutcast')->groupBy('ref_id')->get();
		$id = '';

		$view = '';
		$status = '';
		$name = '';
		$btn = '';

		foreach ($getdata as $key) {
			$id++;
			$getphotosession = DB::table('casting')->where('id', '=', $key->cast_id)->first();

					$getdata = DB::table('offlinepayoutcast')->where('ref_id', '=', $key->ref_id)->count();
		$amount = $getdata * $getphotosession->payDesc;

			if ($key->status == '') {
				$status = "<button class='btn btn-warning'>Pending</button>";
				$btn = "<button class='btn btn-success verifycast' data-toggle='modal' data-target='#exampleModal' id=$key->id>Verify</button>";
			}else{
				$status = "<button class='btn btn-success'>Active</button>";
				$btn = "<button class='btn btn-success'>Verified</button>";
			} 

			$users = User::find($getphotosession->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

		$view .= "<tr id=cast$key->id>
						<td>$id</td>
						<td>$name</td>
						<td>$getphotosession->castTitle</td>
						<td>$key->ref_id</td>
						<td>$amount</td>
						<td>$status</td>
						<td>$btn</td>
					</tr>";
		}
		return View::make('account/offcast')->with(compact('view'));
	}

	public function getverifycast()
	{
		$getid = $_GET['val'];
		$view = '';
		$getphot = DB::table("offlinepayoutcast")->where("id", '=', $getid)->first();
		$view = "<div class='row'>
					<div class='col-lg-12'>
					<p><strong>Are u sure u want to active $getphot->ref_id?</strong></p>
					<button class='btn btn-success castyes' id=$getid>Yes</button>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
					</div>
				</div>";
		echo $view;
	}

	public function approvecast()
	{
	$getid = $_GET['val'];

	$getphoto = DB::table('offlinepayoutcast')->where('id', '=', $getid)->first();

	$getdata = DB::table('modelscastpayment')->where('cast_id', '=', $getphoto->cast_id)->get();
	if ($getdata) {
	$offlinepayoutphotosession = DB::table('offlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->update(array('status' => 'yes'));
		
		$id = $getphoto->cast_id;
	$val = '';
	$user = Auth::user()->id;
	$getpaymentmethod = DB::table('casting')->where('id', '=', $id)->first();
	$getuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
	$getusercount = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();
	$updcastpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->update(array('status' => 'inactive'));
	$updmodelacknoledge = DB::table('modelacknolodgement')->where('cast_id', '=', $id)->update(array('status' => 'inactive'));

	$getrec = DB::table('castreceipt')->where('cast_id', '=', $id)->get();

	$count = '';
	foreach ($getrec as $key) {
		# code...
		$count += $key->nomodels; 
	}

	$gtupdcastpayment =	DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('status', '=', 'active')->count();

	//get number of users
	foreach ($getuser as $key) {
			$getpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->first();
			if ($getpayment) {
				# code...
				if ($getpayment->status == 'inactive') {
					# code...
				}
			}else{

				$val += 1;
			}
			# code.. .
		}

	//to get receipt no
	if ($getusercount <= $count) {
		$rccastpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('status', '=', 'inactive')->first();
		$rec_id = $rccastpayment->rec_id;
	}else{

		$amtpaid = $getpaymentmethod->payDesc * $val;

		$castreceipt = new castreceipt;
			$castreceipt->cast_id = $id;
			$castreceipt->nomodels = $val;
			$castreceipt->amount = $amtpaid;
			$castreceipt->save();
			$rec_id = $castreceipt->id;
	}

	foreach ($getuser as $key) {
		# code...
		$getcastpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->first();
		if ($getcastpayment) {
			# code...
		$setupdcastpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->update(array('status' => 'active'));
		$setmodelacknolodgement = DB::table('modelacknolodgement')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->update(array('status' => 'active'));
		}else{
				# code...
			
			$instmodelscastpayment = new modelscastpayment;
			$instmodelscastpayment->cast_id = $id;
			$instmodelscastpayment->user_id = $key->user_id;
			$instmodelscastpayment->rec_id = $rec_id;
			$instmodelscastpayment->amount = $getpaymentmethod->payDesc;
			$instmodelscastpayment->status = 'active';
			$instmodelscastpayment->save();

			$modelacknolodgement = new modelacknolodgement;
			$modelacknolodgement->cast_id = $id;
			$modelacknolodgement->user_id = $key->user_id;
			$modelacknolodgement->status = 'active';
			$modelacknolodgement->save();
			

		}
	}

	}else{

	$getphotosession = DB::table('casting')->where('id', '=', $getphoto->cast_id)->first();

	$offlinepayoutphotosession = DB::table('offlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->update(array('status' => 'yes'));
	$updatecast = DB::table('casting')->where('id', '=', $getphoto->cast_id)->update(array('status' => 'finished'));
	$getcount = DB::table('offlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->count();

	$getuser = DB::table('offlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->get();

	$amount = $getphotosession->payDesc * $getcount;

		$paidcast = new paidcast;
		$paidcast->cast_id = $getphoto->cast_id;
		$paidcast->user_id = $getphotosession->user_id;
		$paidcast->Amount = $amount;
		$paidcast->save();

		$checkout = new castcheckout;
		$checkout->cast_id = $getphoto->cast_id;
		$checkout->user_id = $getphotosession->user_id;
		$checkout->paidstatus = 'paid';
		$checkout->save();

		$castreceipt = new castreceipt;
		$castreceipt->cast_id = $getphoto->cast_id;
		$castreceipt->nomodels = $getcount;
		$castreceipt->amount = $amount;
		$castreceipt->save();
		$rec_id = $castreceipt->id;

		foreach ($getuser as $key) {

			$modelscastpayment = new modelscastpayment;
			$modelscastpayment->cast_id = $getphoto->cast_id;
			$modelscastpayment->user_id = $key->model_id;
			$modelscastpayment->rec_id = $rec_id;
			$modelscastpayment->amount = $getphotosession->payDesc;
			$modelscastpayment->status = 'active';
			$modelscastpayment->save();

			$modelacknolodgement = new modelacknolodgement;
			$modelacknolodgement->cast_id = $getphoto->cast_id;
			$modelacknolodgement->user_id = $key->model_id;
			$modelacknolodgement->status = 'active';
			$modelacknolodgement->save();

		}
		}
	}

	public function offjobs()
	{
		$getdata = DB::table('offlinepayoutjob')->get();
		$id = '';

		$view = '';
		$status = '';
		$name = '';
		$btn = '';

		foreach ($getdata as $key) {
			$id++;
			$getphotosession = DB::table('job')->where('id', '=', $key->job_id)->first();
			if ($key->status == '') {
				$status = "<button class='btn btn-warning'>Pending</button>";
				$btn = "<button class='btn btn-success verifyjob' data-toggle='modal' data-target='#exampleModal' id=$key->id>Verify</button>";
			}else{
				$status = "<button class='btn btn-success'>Active</button>";
				$btn = "<button class='btn btn-success'>Verified</button>";
			} 

			$users = User::find($getphotosession->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

		$view .= "<tr id=job$key->id>
						<td>$id</td>
						<td>$name</td>
						<td>$getphotosession->title</td>
						<td>$key->refid</td>
						<td>$getphotosession->amount</td>
						<td>$status</td>
						<td>$btn</td>
					</tr>";
		}
		return View::make('account/offjobs')->with(compact('view'));
	}

	public function getverifyjob()
	{
		$getid = $_GET['val'];
		$view = '';
		$getphot = DB::table("offlinepayoutjob")->where("id", '=', $getid)->first();
		$view = "<div class='row'>
					<div class='col-lg-12'>
					<p><strong>Are u sure u want to active $getphot->refid?</strong></p>
					<button class='btn btn-success jobyes' id=$getid>Yes</button>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
					</div>
				</div>";
		echo $view;
	}

	public function approvejob()
	{
		$getid = $_GET['val'];

	$getphoto = DB::table('offlinepayoutjob')->where('id', '=', $getid)->first();
	$getphotosession = DB::table('job')->where('id', '=', $getphoto->job_id)->first();

	$offlinepayoutphotosession = DB::table('offlinepayoutjob')->where('refid', '=', $getphoto->refid)->update(array('status' => 'yes'));
	$updatecast = DB::table('job')->where('id', '=', $getphoto->job_id)->update(array('status' => 'finished'));
	$getcount = DB::table('offlinepayoutjob')->where('refid', '=', $getphoto->refid)->count();

	$getuser = DB::table('jobtable')->where('job_id', '=', $getphoto->job_id)->where('jobStatus', '=', 'confirmed')->get();


		$checkout = new jobcheckout;
		$checkout->job_id = $getphoto->job_id;
		$checkout->user_id = $getphotosession->user_id;
		$checkout->paidstatus = 'paid';
		$checkout->save();

		$castreceipt = new jobreceipt;
		$castreceipt->job_id = $getphoto->job_id;
		$castreceipt->amount = $getphotosession->amount;
		$castreceipt->save();
		$rec_id = $castreceipt->id;

		foreach ($getuser as $key) {

			$modelscastpayment = new othersjobpayment;
			$modelscastpayment->job_id = $getphoto->job_id;
			$modelscastpayment->user_id = $key->user_id;
			$modelscastpayment->rec_id = $rec_id;
			$modelscastpayment->amount = $getphotosession->amount;
			$modelscastpayment->status = 'active';
			$modelscastpayment->save();

		}
	}

	public function offsub()
	{
		$getdata = DB::table('offlinepayoutsub')->get();
		$id = '';

		$view = '';
		$status = '';
		$name = '';
		$btn = '';

		foreach ($getdata as $key) {
			$id++;

		if ($key->sub_id == '2') {
			$plan = 'Afro Plus';
			$Amount = 2500;
		}elseif ($key->sub_id == '3') {
			$plan = 'Afro Unlimited';
			$Amount = 3500;
		}

			if ($key->status == '') {
				$status = "<button class='btn btn-warning'>Pending</button>";
				$btn = "<button class='btn btn-success verifysub' data-toggle='modal' data-target='#exampleModal' id=$key->id>Verify</button>";
			}else{
				$status = "<button class='btn btn-success'>Active</button>";
				$btn = "<button class='btn btn-success'>Verified</button>";
			} 

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

		$view .= "<tr id=sub$key->id>
						<td>$id</td>
						<td>$name</td>
						<td>$plan</td>
						<td>$key->ref_id</td>
						<td>$key->amount</td>
						<td>$status</td>
						<td>$btn</td>
					</tr>";
		}
		return View::make('account/offsub')->with(compact('view'));
	}

	public function getverifysub()
	{
		$getid = $_GET['val'];
		$view = '';
		$getphot = DB::table("offlinepayoutsub")->where("id", '=', $getid)->first();
		$view = "<div class='row'>
					<div class='col-lg-12'>
					<p><strong>Are u sure u want to active $getphot->ref_id?</strong></p>
					<button class='btn btn-success subyes' id=$getid>Yes</button>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
					</div>
				</div>";
		echo $view;
	}

	public function approvesub()
	{
		$getid = $_GET['val'];

		$planstatus = 'active';
    	$startdate = time();

	$getphoto = DB::table('offlinepayoutsub')->where('id', '=', $getid)->first();

	$offlinepayoutphotosession = DB::table('offlinepayoutsub')->where('ref_id', '=', $getphoto->ref_id)->update(array('status' => 'yes'));


	$id = $getphoto->sub_id;
	$status = 'active';
	$user_id = $getphoto->user_id;
	$dateplan = $this->calculate_next_year($startdate);

		$dateFrom = $startdate;
    	$month = date('m', $startdate);
	  $day = date('d', $startdate);
	  $year = date('Y', $startdate);

    	$date = time($dateplan);
		$Expyear = date('Y', $dateplan);
		$Expmonth = date('m', $dateplan);
		$Expday = date('d', $dateplan);

		$dateplans = $dateplan;

		$startdates = strtotime("$year-$month-$day");

    	$userplanid = DB::table('usersplan')->where('user_id', '=', $user_id)->where('status', '=', 'active')->first();

    	if ($userplanid) {
    		# code...
    		if ($id == '2') {
    		# code...
    	$affectedRow = usersplan::where('user_id', '=', $user_id)->where('status', '=', 'active')->update(array('status' => 'inactive'));

    	$affectedRows = userplanduration::where('user_id', '=', $user_id)->where('status', '=', 'active')->update(array('status' => 'inactive'));

			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$userplan->status = $status;
			    	$userplan->save();

			    	$usersub = new userplanduration;
			    	$usersub->user_id = $user_id;
			    	$usersub->plan_id = $id;
			    	$usersub->startdate = $startdates;
			    	$usersub->durationFromDay = $day;
			    	$usersub->durationFromMonth = $month;
			    	$usersub->durationFromYear = $year;
			    	$usersub->durationToDay = $Expday;
			    	$usersub->durationToMonth = $Expmonth;
			    	$usersub->durationToYear = $Expyear;
			    	$usersub->enddate = $dateplans;
			    	$usersub->status = $status;
			    	$usersub->save();

    	}elseif ($id == '3') {
    		# code...
    	$affectedRow = usersplan::where('user_id', '=', $user_id)->where('status', '=', 'active')->update(array('status' => 'inactive'));

    	$affectedRows = userplanduration::where('user_id', '=', $user_id)->where('status', '=', 'active')->update(array('status' => 'inactive'));

			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$userplan->status = $status;
			    	$userplan->save();

			    	$usersub = new userplanduration;
			    	$usersub->user_id = $user_id;
			    	$usersub->plan_id = $id;
			    	$usersub->startdate = $startdates;
			    	$usersub->durationFromDay = $day;
			    	$usersub->durationFromMonth = $month;
			    	$usersub->durationFromYear = $year;
			    	$usersub->durationToDay = $Expday;
			    	$usersub->durationToMonth = $Expmonth;
			    	$usersub->durationToYear = $Expyear;
			    	$usersub->enddate = $dateplans;
			    	$usersub->status = $status;
			    	$usersub->save();
			    }
    	}else{

    		if ($id == '2') {
    		# code...

			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$userplan->status = $status;
			    	$userplan->save();

			    	$usersub = new userplanduration;
			    	$usersub->user_id = $user_id;
			    	$usersub->plan_id = $id;
			    	$usersub->startdate = $startdates;
			    	$usersub->durationFromDay = $day;
			    	$usersub->durationFromMonth = $month;
			    	$usersub->durationFromYear = $year;
			    	$usersub->durationToDay = $Expday;
			    	$usersub->durationToMonth = $Expmonth;
			    	$usersub->durationToYear = $Expyear;
			    	$usersub->enddate = $dateplans;
			    	$usersub->status = $status;
			    	$usersub->save();

    	}elseif ($id == '3') {
    		# code...

			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$userplan->status = $status;
			    	$userplan->save();

			    	$usersub = new userplanduration;
			    	$usersub->user_id = $user_id;
			    	$usersub->plan_id = $id;
			    	$usersub->startdate = $startdates;
			    	$usersub->durationFromDay = $day;
			    	$usersub->durationFromMonth = $month;
			    	$usersub->durationFromYear = $year;
			    	$usersub->durationToDay = $Expday;
			    	$usersub->durationToMonth = $Expmonth;
			    	$usersub->durationToYear = $Expyear;
			    	$usersub->enddate = $dateplans;
			    	$usersub->status = $status;
			    	$usersub->save();
			    }

    	}
	}

	public function calculate_next_year($start_date = FALSE)
	{
		# code...
		if ($start_date) {
	    $now = $start_date; // Use supplied start date.
	  } else {
	    $now = time(); // Use current time.
	  }
	  $month = date('m', $now);
	  $day = date('d', $now);
	  $year = date('Y', $now) + 1;
	  $plus_one_year = strtotime("$year-$month-$day"); // Use ISO 8601 standard.
	  return $plus_one_year;
	}

	public function jobreceipt()
	{
		$getreceipt = DB::table('jobreceipt')->get();
		$id = 0;
		$view = '';

		foreach ($getreceipt as $key) {
			# code...
			$id += 1;

			$timestamp = strtotime($key->created_at);
    	$date = date('Y-m-d', $timestamp);

			$getdtls = DB::table('job')->where('id', '=', $key->job_id)->first();
			$view .=	"<tr>
		                <td>$id</td>
		                <td>$getdtls->jobcode</td>
		                <td>$date</td>
		                <td><button class='btn btn-success viewjobreceipt' data-toggle='modal' data-target='#exampleModal' id=$key->id>View</button></td>
		            </tr>";
		}
		return View::make('account.jobreceipt')->with(compact('view'));
	}

	public function viewjobreceipt()
	{
		# code...
		$id = $_GET['id'];
		$view = '';
		$getcast = DB::table('jobreceipt')->where('id', '=', $id)->first();
		$getcstdtl = DB::table('job')->where('id', '=', $getcast->job_id)->first();
		$user = User::find($getcstdtl->user_id);
		$name = $user->Others->agentName;

    	$timestamp = strtotime($getcast->created_at);
    	$date = date('Y-m-d', $timestamp);
    	$recno = "00".$getcast->id;
    	$amountword = $getcast->amount;
    	$total = '';
    	$nomodels = '';

	$view .=	"<div class-'row'>
					<div class='col-lg-4 pull-left'>";
	$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '80px'));
	$view .=		"</div>
					<div class='col-lg-4'>
					</div>
					<div class='col-lg-4'>
						<h5>Date: ".$date."</h5>
						<h5>Official Receipt</h5>
						<h5>No: ".$recno."</h5>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-12 text-left'>
						<h5>To : ".$name."</h5>
						<h5>The sum of : ".$amountword."</h5>
						<h5>Job code : ".$getcstdtl->jobcode."</h5>
						<h5>Being full payment for : ".$getcstdtl->title."</h5>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-12'>
						<table data-sortable class='table table-hover'>
							<thead>
								<tr>
									<th>No</th>
									<th>Type</th>
									<th>Qty</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td>1</td>
									<td>Users</td>
									<td>1</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-4'>
					<hr>
					<h4>Sign</h4>
					</div>
				</div>";

	echo $view;

	}

	public function jobpayment()
	{
		$getcast = DB::table('job')->where('status', '=', 'finished')->orderBy('id', 'DESC')->get();

		$view = '';
		$no = 0;

		$view .= "<tbody>";
				foreach ($getcast as $key) {

		$btn = '';

		$getpayment = DB::table('jobpayment')->where('job_id', '=', $key->id)->get();
		if ($getpayment) {
			$btn = "<i class='fa fa-check'></i>Paid";
			$btn2 = "<button class='btn btn-success'>Paid</button>";
		}else{
			$btn = "<i class='fa fa-exclamation-circle'></i>Pending";
			$btn2 = "<a class='btn btn-success' href=jobpay/$key->id>View</a>";
		}
					# code...
		$getamount = DB::table('othersjobpayment')->where('job_id', '=', $key->id)->where('status', '=', 'active')->sum('amount');
					$no += 1;
		$view .= "<tr>
						<td>$no</td>
						<td>$key->jobcode</td>
						<td>$getamount</td>
						<td>$btn</td>
						<td>$btn2</td>
						<td><button class='btn btn-success viewjobslip' data-toggle='modal' data-target='#exampleModal' id=$key->id>View</button></td></td>
					</tr>";
				}


		$view	.= "</tbody>";


		return View::make('account.jobpayment')->with(compact('view'));
	}

	public function jobpay($id)
	{
		$getdtl = DB::table('job')->where('id', '=', $id)->first();
		$getcast = DB::table('othersjobpayment')->where('job_id', '=', $id)->where('status', '=', 'active')->get();
		$view = '';
		$cast = $id;
		$id = '';

		foreach ($getcast as $key) {
			# code...
			$id += 1;

			$getmodels = User::find($key->user_id);
			
			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

			$pix = $getmodels->photoupload->imagename;

				$btn = "<i class='fa fa-check'></i> Acknoledged";
			

		$view .= "<tr>	
					<td>$id</td>
					<td><input type='checkbox' name='user_id[]' value=$key->user_id></td>
					<td><img src=/".$pix." width='50px'>$name</td>
					<td>$btn</td>
				  </tr>";
		}

		# code...
		return View::make('account.jobpay')->with(compact('view', 'getdtl'));
	}

	public function createjobpayment()
	{
		# code...

		$data = Input::all();

		$validator = Validator::make($data, jobpayment::$rules);

		if ($validator->fails()) {

		return Redirect::back()->withErrors($validator)->withInput();

		}

		$model_id = $_POST['user_id'];
		$cast_id = $_POST['job_id'];
		$getcast = DB::table('job')->where('id', '=', $cast_id)->first();
		foreach ($model_id as $key => $value) {
			# code...
			$chpay = DB::table('jobpayment')->where('job_id', '=', $cast_id)->where('user_id', '=', $value)->get();

			if ($chpay) {
				# code...
			}else{
			$castpayment = new jobpayment;
			$castpayment->job_id = $cast_id;
			$castpayment->user_id = $value;
			$castpayment->amount = $getcast->amount;
			$castpayment->save();
			}
		}
		return $this->viewjobpayslip($cast_id);
			
	}

	public function viewjobpayslip($id)
	{
		# code...
		$id = $id;
		$getpayment = DB::table('jobpayment')->where('job_id', '=', $id)->get();
		$view = '';
		$no = '';
		$amount = '';
		$acctnum = '';
		$acctName = '';
		$bank = '';
		$getcast = DB::table('job')->where('id', '=', $id)->first();

		foreach ($getpayment as $key) {
			# code...
			$no += 1;

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

			$bankdetails = DB::table('bankdetails')->where('user_id', '=', $key->user_id)->first();
			if ($bankdetails) {
				$acctnum = $bankdetails->acctno;
				$acctName = $bankdetails->acctname;
				$bank = $bankdetails->bank;
			}else{
				$acctName = $name;
			}

			$getmodels = User::find($key->user_id);
			
			$pix = $getmodels->photoupload->imagename;
			$amount += $getcast->amount;

		$view .= "<tr>	
					<td>$no</td>
					<td>$getcast->jobcode</td>
					<td>$acctName</td>
					<td>$acctnum</td>
					<td>$bank</td>
					<td>$amount</td>
				  </tr>";
		}
		$view .="<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td>$amount</td>
				</tr>";

		return View::make('account.viewjobpayslip')->with(compact('view', 'getcast'));

	}

	public function printjobpaymentslip($cast)
	{
		# code...
		$id = $cast;
		$getpayment = DB::table('jobpayment')->where('job_id', '=', $id)->get();
		$view = '';
		$no = '';
		$amount = '';
		$acctnum = '';
		$acctName = '';
		$bank = '';
		$getcast = DB::table('job')->where('id', '=', $id)->first();

		foreach ($getpayment as $key) {
			# code...
			$no += 1;

			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

			$bankdetails = DB::table('bankdetails')->where('user_id', '=', $key->user_id)->first();
			if ($bankdetails) {
				$acctnum = $bankdetails->acctno;
				$acctName = $bankdetails->acctname;
				$bank = $bankdetails->bank;
			}else{
				$acctName = $name;
			}

			$getmodels = User::find($key->user_id);
			$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$pix = $getmodels->photoupload->imagename;
			$amount += $getcast->amount;

		$view .= "<tr>	
					<td>$no</td>
					<td>$getcast->jobcode</td>
					<td>$name</td>
					<td>$acctnum</td>
					<td>$bank</td>
					<td>$getcast->amount</td>
				  </tr>";
		}
		$view .="<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td>$amount</td>
				</tr>";

		return View::make('account.printjobpaymentslip')->with(compact('view', 'getcast'));
	}

}