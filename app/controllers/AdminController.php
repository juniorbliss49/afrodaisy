<?php

/**
* 
*/

use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

class AdminController extends BaseController
{
	
	public function randomnumber()
	{
		# code...
		 
		 $rand = array();

		for ($i = 0; $i<300; $i++) 
		{
		    $rand[] = $a = mt_rand(100000,999999);
		}

		foreach ($rand as $key => $value) {
			# code...
			$randomnumber = new randomnumbergenertor;
			$randomnumber->number = $value;
			$randomnumber->save();
		}

	}

	public function index()
	{
		# code...
		return View::make('admin.index');
	}

	public function newface()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'newFace')->Join('models', 'users.id', '=', 'models.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->select('users.id', 'models.displayName', 'models.country', 'models.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->orderBy('users.id', 'DESC')->get();
		return View::make('admin.newface')->with(compact('getpromodeluser'));

	}

	public function promodel()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'proModel')->Join('models', 'users.id', '=', 'models.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->select('users.id', 'models.displayName', 'models.country', 'models.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->orderBy('users.id', 'DESC')->get();
		return View::make('admin.promodel')->with(compact('getpromodeluser'));
		
	}

	public function photo()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->orderBy('users.id', 'DESC')->select('users.id', 'others.agentName', 'others.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->get();
		return View::make('admin.photo')->with(compact('getpromodeluser'));
		
	}

	public function agency()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->orderBy('users.id', 'DESC')->select('users.id', 'others.agentName', 'others.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->get();
		return View::make('admin.agency')->with(compact('getpromodeluser'));
		
	}

	public function fashion()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->orderBy('users.id', 'DESC')->select('users.id', 'others.agentName', 'others.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->get();
		return View::make('admin.fashion')->with(compact('getpromodeluser'));
		
	}

	public function artist()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->orderBy('users.id', 'DESC')->select('users.id', 'others.agentName', 'others.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->get();
		return View::make('admin.artist')->with(compact('getpromodeluser'));
		
	}

		public function tattoo()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'tattoo')->Join('others', 'users.id', '=', 'others.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->orderBy('users.id', 'DESC')->select('users.id', 'others.agentName', 'others.location', 'verificationtable.verify', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'photoupload.imagename')->get();
		return View::make('admin.tattoo')->with(compact('getpromodeluser'));
		
	}

	public function others()
	{
		# code...
		$getpromodeluser = DB::table('users')->where('user_type', 'others')->Join('others', 'users.id', '=', 'others.user_id')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->leftJoin('photoupload', 'users.id', '=', 'photoupload.user_id')->orderBy('users.id', 'DESC')->select('users.id', 'others.agentName', 'others.location', 'verificationtable.social', 'verificationtable.mobile','verificationtable.email', 'verificationtable.verify', 'photoupload.imagename')->get();

                                        $id = 0;
                                        $view = '';
                                        foreach($getpromodeluser as $user){

                                        	if(!empty($user->social)){
                                        $social = "<span class='label label-success'>Active</span>";
                                        }
                                        else{
                                        $social = "<span class='label label-danger'>Pending</span>";
                                        }

                                        if(!empty($user->mobile))
                                        {
                                        $mobile = "<span class='label label-success'>Active</span>";
                                        }
                                        else{
                                        $mobile = "<span class='label label-danger'>Pending</span>";
                                        }

                                        if(!empty($user->email)){
                                        $email = "<span class='label label-success'>Active</span>";
                                        }
                                        else{
                                        $email = "<span class='label label-danger'>Pending</span>";
                                        }
                                        
                                        $getuser = DB::table('industryprofessionalusers')->where('user_id', '=', $user->id)->first();
										$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
											$user_type_spec = $getusertype->name;
                                        $id += 1;
                                        
                                            if(!empty($user->verify)){
                                        $view .=    "<tr>
                                                    <td>$id</td>
                                                    <td>";
                                                    if(!empty($user->imagename)){
                                        $view .=    HTML::image($user->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
                                                    }else{
                                        $view .=    HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
                                                    }
                                        $view .=    "<strong>$user->agentName</strong></td>
                                        			<td>$user_type_spec</td>
                                                    <td>$user->location</td>
                                                    <td>$social</td>
                                                    <td>$mobile</td>
                                                    <td>$email</td>
                                                    <td><span class='label label-success'>Active</span></td>
                                                    <td><a class='btn btn-sm btn-success' href=/admin/othersview/$user->id>View</button></td>
                                                </tr>";
                                            }else{
                                        $view  .=   "<tr>
                                                    <td>$id</td>
                                                    <td>";
                                                    if(!empty($user->imagename)){
                                        $view .=    HTML::image($user->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
                                                    }else{
                                        $view .=    HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
                                                    }
                                        $view  .=   "<strong>$user->agentName</strong></td>
                                        			<td>$user_type_spec</td>
                                                    <td>$user->location</td>
                                                    <td>$social</td>
                                                    <td>$mobile</td>
                                                    <td>$email</td>
                                                    <td><span class='label label-danger'>Pending</span></td>
                                                    <td><button class='btn btn-sm btn-success viewother' data-toggle='modal' data-target='#exampleModal' id=$user->id>View</button></td>
                                                </tr>";
                                            }
                                            
                                        }

		return View::make('admin.others')->with(compact('getpromodeluser', 'view'));
		
	}

	public function viewprofile()
	{
		# code...
		$user = $_GET['user'];
		$getusers = DB::table('models')->where('models.user_id', $user)->leftJoin('photoupload', 'models.user_id', '=', 'photoupload.user_id')->where('photoupload.image_type', '=', 'profileImage')->get();

		$value = '';

								foreach ($getusers as $getuser) {
		$value .= "<div class='row'>
						<div class='col-lg-4'>";							# code...

				if(!empty($getuser->imagename)){
							 $value .=  $image = HTML::image($getuser->imagename ,'profile', array('width' => '130px', 'height' => '174px'));
							        }
							        else{
							$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px'));
									}
					$value .=	"</div>
						<div class='col-lg-8'>
							<div class='row'>
								<div class='col-lg-12'>
									<div class='row'>
										<div class='col-lg-6'>
										<p><strong>Full Name: </strong>".$getuser->firstName." ".$getuser->lastName."</p>
										<p><strong>Gender: </strong>".$getuser->gender."</p>
										<p><strong>Country: </strong>".$getuser->country."</p>
										<p><strong>Contact: </strong>".$getuser->phone."</p>
										</div>
										<div class='col-lg-6'>
										<p><strong>Full Name:</strong> ".$getuser->displayName."</p>
										<p><strong>Age:</strong> ".$getuser->Age."</p>
										<p><strong>State: </strong>".$getuser->location." </p>
										<p><strong>City: </strong> ".$getuser->town."</p>
										</div>
									</div>
									<div class='row'>
										<div class='col-lg-12'>
										<p><strong>About: </strong>".$getuser->about."</p>
										</div>
									</div>
								</div>
							</div>
						</div>
				  </div>";
				}
		echo $value;

	}

	public function viewothers()
	{
		# code...
		$user = $_GET['user'];
		$getusers = DB::table('others')->where('others.user_id', $user)->leftJoin('photoupload', 'others.user_id', '=', 'photoupload.user_id')->get();

		$value = '';

								foreach ($getusers as $getuser) {
		$value .= "<div class='row'>
						<div class='col-lg-4'>";							# code...

				if(!empty($getuser->imagename)){
							 $value .=  $image = HTML::image($getuser->imagename ,'profile', array('width' => '130px', 'height' => '174px'));
							        }
							        else{
							$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px'));
									}
					$value .=	"</div>
						<div class='col-lg-8'>
							<div class='row'>
								<div class='col-lg-12'>
									<div class='row'>
										<div class='col-lg-6'>
										<p><strong>Name: </strong>".$getuser->agentName."</p>
										<p><strong>CAC: </strong>".$getuser->CAC."</p>
										<p><strong>Website: </strong>".$getuser->Website."</p>
										<p><strong>Telephone: </strong>".$getuser->telephone."</p>
										<p><strong>Address: </strong>".$getuser->address."</p>
										</div>
										<div class='col-lg-6'>
										<p><strong>Chairman:</strong> ".$getuser->chairmanname."</p>
										<p><strong>Chairman Telephone:</strong> ".$getuser->chairmantel."</p>
										<p><strong>Chairman Email: </strong>".$getuser->chairmanemail." </p>
										</div>
									</div>
									<div class='row'>
										<div class='col-lg-12'>
										<p><strong>About: </strong>".$getuser->aboutus."</p>
										</div>
									</div>
								</div>
							</div>
						</div>
				  </div>";
				}
		echo $value;

	}

	public function getUserType($id)
{
	# code...
	$user_type_spec = '';
	$user = User::find($id);

		switch ($user->user_type) {
				case 'proModel':
					$user_type_spec = 'Professional model';
					break;
				case 'newFace':
					$user_type_spec = 'New Face';
					break;
				case 'photo':
					$user_type_spec = 'Photographer';
					break;
				case 'agent':
					$user_type_spec = 'Agency';
					break;
				case 'artist':
					$user_type_spec = 'Hair & Make-up Artist';
					break;
				case 'fashion':
					$user_type_spec = 'Fashion stylist';
					break;
				case 'tattoo':
					$user_type_spec = 'Tattoo Artist';
					break;
				case 'others':
					$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', $id)->first();
		if ($getuser) {
					$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
		}else{
			$user_type_spec = 'Others';
		}
			
					break;
			}

	return $user_type_spec;
}

	public function pendingapplicant()
	{
		# code...
		$getapplicant = DB::table('users')->where('user_type','!=', 'admin')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->select('users.id', 'verificationtable.verify')->orderBy('users.id', 'DESC')->get();

		$id = 0;
		$view = '';
		foreach ($getapplicant as $key) {
			# code...
		if (empty($key->verify)) {
			# code...
			$id += 1;
			$user = User::find($key->id);
		if (!empty($user->Others->agentName)) {
			# code...
			$name = $user->Others->agentName;
			$href = "/admin/othersview/$key->id";
			$class = "<a id=".$key->id." class='btn btn-sm btn-success' href=$href>View</a>";
			$btn = 'btn btn-sm btn-success verify';
		}elseif (!empty($user->NewModel->displayName)) {
			# code...
			$name = $user->NewModel->displayName;
			$href = "/admin/modelsview/$key->id";
			$class = "<a id=".$key->id." class='btn btn-sm btn-success' href=$href>View</a>";
			$btn = 'btn btn-sm btn-success verify';
			
		}else{
			$name = '';
			$class = "<button class='btn btn-sm btn-danger viewapplicant' id=".$key->id." data-toggle='modal' data-target='#exampleModal'>View</button>";
			$btn = '';
			$href = '';
		}

		$usertype = $this->getUserType($key->id);

		$view .= "<tr id=sd".$key->id.">
	                    <td>".$id."</td>
	                    <td>";
	                    if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}
	    $view .= $name." </td>
	    				<td>$usertype</td>
	                    <td><span class='btn btn-sm btn-warning'>Pending</span></td>
	                    <td>".$class."</td>
	                    <td><button id=".$key->id." class='".$btn."'>verify</button></td>
	                    <td><button id=".$key->id." class='btn btn-sm btn-danger decline'>Decline</button></td>
                    </tr>";

		}else{}
	}
		return View::make('admin.pending')->with(compact('getapplicant', 'view'));
	}

	public function viewapplicant()
	{
		$id = $_GET['user'];

		$getuser = User::find($id);
		$data = "<h4>Email:	$getuser->email</h4>";
		# code...
		echo $data;
	}

	public function verify()
	{
		# code...

		$user = $_GET['user'];

		$verificationtables = DB::table('verificationtable')->where('user_id', '=', $user)->count();

	if ($verificationtables > 0) {
		# code...
		$verificationtable = DB::table('verificationtable')->where('user_id', '=', $user)->update(array('verify' => 'yes'));
	}else{
		$verify = new verificationtable;
		$verify->user_id = $user;
		$verify->verify = 'yes';
		$verify->save();
	}


	}

	public function decline()
	{
		# code...

		$user = $_GET['user'];

		$verificationtables = DB::table('verificationtable')->where('user_id', '=', $user)->count();

	if ($verificationtables > 0) {
		# code...
		$verificationtable = DB::table('verificationtable')->where('user_id', '=', $user)->update(array('verify' => 'declined'));
	}else{
		$verify = new verificationtable;
		$verify->user_id = $user;
		$verify->verify = 'declined';
		$verify->save();
	}
		
	}

	public function declineduser()
	{
		# code...
		$getapplicant = DB::table('users')->where('user_type','!=', 'admin')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'declined')->select('users.id', 'verificationtable.verify')->orderBy('users.id', 'DESC')->get();

		$id = 0;
		$view = '';
		foreach ($getapplicant as $key) {
			# code...
			# code...
			$id += 1;
			$user = User::find($key->id);
		if (!empty($user->Others->agentName)) {
			# code...
			$name = $user->Others->agentName;
			$class = 'btn btn-sm btn-success viewother';
			$btn = 'btn btn-sm btn-success verify';
		}elseif (!empty($user->NewModel->displayName)) {
			# code...
			$name = $user->NewModel->displayName;
			$class = "btn btn-sm btn-success viewModel";
			$btn = 'btn btn-sm btn-success verify';
		}else{
			$name = '';
			$class = "";
			$btn = '';
		}
		$view .= "<tr id=sd".$key->id.">
	                    <td>".$id."</td>
	                    <td>";
	                    if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}
	    $view .= $name." </td>
	                    <td><span class='btn btn-sm btn-warning'>Declined</span></td>
	                    <td><button id=".$key->id." class='".$class."' data-toggle='modal' data-target='#exampleModal'>View</button></td>
                    </tr>";

	}
		return View::make('admin.declineduser')->with(compact('view'));

	}

public function accepteduser()
	{
		# code...
		$getapplicant = DB::table('users')->where('user_type','!=', 'admin')->leftJoin('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->select('users.id', 'verificationtable.verify')->orderBy('users.id', 'DESC')->get();

		$id = 0;
		$view = '';
		foreach ($getapplicant as $key) {
			# code...
			# code...
			$id += 1;
			$user = User::find($key->id);
		if (!empty($user->Others->agentName)) {
			# code...
			$name = $user->Others->agentName;
			$class = 'btn btn-sm btn-success viewother';
			$btn = 'btn btn-sm btn-success verify';
		}elseif (!empty($user->NewModel->displayName)) {
			# code...
			$name = $user->NewModel->displayName;
			$class = "btn btn-sm btn-success viewModel";
			$btn = 'btn btn-sm btn-success verify';
		}else{
			$name = '';
			$class = "";
			$btn = '';
		}
		$view .= "<tr id=sd".$key->id.">
	                    <td>".$id."</td>
	                    <td>";
	                    if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}
	    $view .= $name." </td>
	                    <td><span class='btn btn-sm btn-success'>Accepted</span></td>
	                    <td><button id=".$key->id." class='".$class."' data-toggle='modal' data-target='#exampleModal'>View</button></td>
                    </tr>";

	}
		return View::make('admin.accepted')->with(compact('view'));

	}

	public function pendingcast()
	{
		# code...#
		$getcast = DB::table('casting')->where('status', '=', 'pending')->orderBy('id','DESC')->get();

		return View::make('admin.pendingshw')->with(compact('getcast'));
	}

	public function pendingdtls($id)
	{
		# code...

		$getcast = DB::table('casting')->where('id', '=', $id)->first();

		$getuser = DB::table('others')->where('user_id', '=', $getcast->user_id)->first();

		$getprev = DB::table('casting')->where('user_id', '=', $getcast->user_id)->where('status', '=', 'previous')->count();

		$castId = $id;
		$dis = $getcast;
		$getdis = DB::table('disciplines')->where('id', '=', $getcast->castCat)->first();
		return View::make('admin.castdetails')->with(compact('getcast', 'getdis', 'getuser', 'getprev', 'castId'));
	}

	public function acceptcast()
	{
		# code...
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/CS/".$rand."/".$csdate;

		$castid = $_GET['castid'];
		$updatecast = DB::table('casting')->where("id", '=', $castid)->update(array('status' => 'activated', 'castcode' => $code));

		$getcast = DB::table('casting')->where("id", '=', $castid)->first();

		$user = User::find($getcast->user_id);
		$getmail = User::find($getcast->user_id);
		$num = $user->Others->telephone;
		$displayName = $user->Others->agentName;
		$castTitle = $getcast->castTitle;
		$castcode = $code;
			$msg = "Your cast ($getcast->castTitle & $code) has been approved by www.Afrodaisy.com log in for more details";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);


  Mail::send('emails.activecast', array('user' => $displayName, 'castTitle' => $castTitle, 'castcode' => $castcode), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});


		$notify = DB::table('notification')->where('name', '=', 'upcomingCast')->first();

		$dates = date('d-m-Y');

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = 'all';
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifyupcomingcast;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $castid;
		$upcoming->date = $dates;
		$upcoming->save();


		echo "<div class='col-lg-12'>
				Cast Activated
				</div>";
	}

	public function castdeclined()
	{
		# code...
		$castid = $_GET['castid'];
		$updatecast = DB::table('casting')->where("id", '=', $castid)->update(array('status' => 'declined'));

$getcast = DB::table('casting')->where("id", '=', $castid)->first();

		$user = User::find($getcast->user_id);
		$getmail = User::find($getcast->user_id);
		$num = $user->Others->telephone;
		$displayName = $user->Others->agentName;
		$castTitle = $getcast->castTitle;
			$msg = "Your cast ($getcast->castTitle) has been declined by www.Afrodaisy.com log in for more details";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);


  Mail::send('emails.declinecast', array('user' => $displayName, 'castTitle' => $castTitle), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

		echo "<div class='col-lg-12'>
				Cast Declined
			  </div>";

	}

	public function acceptjob()
	{
		# code...
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/CS/".$rand."/".$csdate;

		$castid = $_GET['castid'];
		$updatecast = DB::table('job')->where("id", '=', $castid)->update(array('status' => 'activated', 'jobcode' => $code));

		$getcast = DB::table('job')->where("id", '=', $castid)->first();

		$user = User::find($getcast->user_id);
		$getmail = User::find($getcast->user_id);
		$num = $user->Others->telephone;
		$displayName = $user->Others->agentName;
		$castTitle = $getcast->title;
		$castcode = $code;
			$msg = "Your Contract ($getcast->title & $code) has been approved by www.Afrodaisy.com log in for more details";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);

			$getmail = User::find($getcast->user_id);
			$displayName = $getnum->agentName;
			$jobtitle = $getcast->title;
			$jobcode = $getcast->jobcode;
			Mail::send('emails.activejob', array('user' => $displayName, 'castTitle' => $jobtitle, 'castcode' => $jobcode), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});


		$notify = DB::table('notification')->where('name', '=', 'upcomingJob')->first();

		$dates = date('d-m-Y');

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = 'all';
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifyUpcomingjob;
		$upcoming->NotId = $ModelNotId;
		$upcoming->job_id = $castid;
		$upcoming->date = $dates;
		$upcoming->save();

		echo "<div class='col-lg-12'>
				Job Activated
				</div>";
	}

	public function jobdeclined()
	{
		# code...
		$castid = $_GET['castid'];
		$updatecast = DB::table('job')->where("id", '=', $castid)->update(array('status' => 'declined'));

		$getcast = DB::table('job')->where("id", '=', $castid)->first();

		$user = User::find($getcast->user_id);
		$getmail = User::find($getcast->user_id);
		$num = $user->Others->telephone;
		$displayName = $user->Others->agentName;
		$castTitle = $getcast->title;
			$msg = "Your job ($getcast->title) has been been declined by www.Afrodaisy.com log in for more details";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);


  Mail::send('emails.declinejob', array('user' => $displayName, 'castTitle' => $castTitle), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

		echo "<div class='col-lg-12'>
				Cast Declined
			  </div>";
	}

	public function showdeclinedjob()
	{
		# code...
		$getcast = DB::table('job')->where('status', '=', 'declined')->orderBy('id','DESC')->get();

		return View::make('admin.pendingjobdcl')->with(compact('getcast'));
	}

	public function showdeclined()
	{
		# code...
		$getcast = DB::table('casting')->where('status', '=', 'declined')->orderBy('id','DESC')->get();

		return View::make('admin.pendingcast')->with(compact('getcast'));
	}

	public function showdeclineddtl($id)
	{
		# code...
		$getcast = DB::table('casting')->where('id', '=', $id)->first();

		$getuser = DB::table('others')->where('user_id', '=', $getcast->user_id)->first();

		$getprev = DB::table('casting')->where('user_id', '=', $getcast->user_id)->where('status', '=', 'previous')->count();

		$castId = $id;
		$dis = $getcast;
		$getdis = DB::table('disciplines')->where('id', '=', $getcast->castCat)->first();
		return View::make('admin.showdeclineddtl')->with(compact('getcast', 'getdis', 'getuser', 'getprev', 'castId'));
	}


public function jobtracking()
	{
		# code...
		$gettracking = DB::table('job')->where('status', '=', 'activated')->orwhere('status', '=', 'checkout')->orwhere('status', '=', 'finished')->orderBy('job.id', 'DESC')->get();
		return View::make('admin.jobtracking')->with(compact('gettracking'));
	}
	public function casttracking()
	{
		# code...
		$gettracking = DB::table('casting')->where('status', '=', 'activated')->orwhere('status', '=', 'checkout')->orwhere('status', '=', 'finished')->orderBy('casting.id', 'DESC')->get();
		return View::make('admin.casttracking')->with(compact('gettracking'));
	}
	public function castevent($id)
	{
		# code...
		$getcast = DB::table('casting')->where('id', '=', $id)->first();
		$getcastuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
$view = '';
$view	.= "<table data-sortable class='table table-hover'>
					<thead>
						<tr>
							<th>No</th>
							<th>Model</th>
						</tr>
					</thead>
					<tbody>";
					$id = 0;
					foreach ($getcastuser as $key) {
						# code...
						$id += 1;
						$user = User::find($key->user_id);
				$view .=	"<tr>
							<td>$id</td>
							<td>";
							if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}	
				$view	.=	$user->NewModel->displayName. " </td>
						</tr>";
					}
	$view	.=		"</tbody>
				</table>";

		return View::make('admin.castevent')->with(compact('getcast', 'getcastuser', 'view'));
	}

	public function jobevent($id)
	{
		# code...
		$getcast = DB::table('job')->where('id', '=', $id)->first();
		$getcastuser = DB::table('jobtable')->where('job_id', '=', $id)->where('jobStatus', '=', 'confirmed')->get();
$view = '';
$view	.= "<table data-sortable class='table table-hover'>
					<thead>
						<tr>
							<th>No</th>
							<th>Professionals</th>
						</tr>
					</thead>
					<tbody>";
					$id = 0;
					foreach ($getcastuser as $key) {
						# code...
						$id += 1;
						$user = User::find($key->user_id);
				$view .=	"<tr>
							<td>$id</td>
							<td>";
							if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}	
				$view	.=	$user->Others->agentName. " </td>
						</tr>";
					}
	$view	.=		"</tbody>
				</table>";

		return View::make('admin.jobevent')->with(compact('getcast', 'getcastuser', 'view'));
	}

	public function addcategory()
	{
		# code...
		$getCategory = DB::table('disciplines')->orderBy('id','DESC')->get();
		return View::make('admin/addcategory')->with(compact('getCategory'));
	}

	public function addcat()
	{
		# code...
		$Discipline = new Discipline;
		$Discipline->name = Input::get('Name');
		$Discipline->save();

		return Redirect::back();
	}

	public function addtype()
	{
		# code...
		$getType = DB::table('categories')->orderBy('id','DESC')->get();
		return View::make('admin/addtype')->with(compact('getType'));
	}

	public function sendtype()
	{
		# code...
		$Category = new Category;
		$Category->name = Input::get('Name');
		$Category->save();

		return Redirect::back();
	}

	public function addservice()
	{
		# code...
		$getservice = DB::table('industryprofessional')->orderBy('id','DESC')->get();
		return View::make('admin/addservice')->with(compact('getservice'));
	}

	public function sendservice()
	{
		# code...
		$otherprofessional = new industryprofessional;
		$otherprofessional->name = Input::get('Name');
		$otherprofessional->save();

		return Redirect::back();
	}

	public function services()
	{
		# code...
		$getservices = DB::table('servicemarketplace')->orderBy('id', 'DESC')->get();
$view = '';
$view .= "<input type='hidden' class='paraminfo' value='service'>";
$view	.= "<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Service</th>
							<th>Posted By</th>
							<th>Date</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody class='text-center'>";
					$id = 0;
					foreach ($getservices as $key) {
						# code...
						$id += 1;

						$date1 = strtotime($key->date);	
						$datecast = date('l, j F Y', $date1);

						if ($key->status == 'pending') {
							# code...
							$button = "<button class='btn btn-warning'><i class='fa fa-exclamation-circle'></i> Pending</button>";
							$btn = "<button id=".$key->id." class='btn btn-success acptserv'><i class='fa fa-check'> Approve</i></button> 
							<button id=".$key->id." class='btn btn-danger discserv' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-trash-o'></i> Discard</button>";
						}elseif ($key->status == 'discard') {
							$button = "<button class='btn btn-danger'><i class='fa fa-trash-o'></i> Discarded</button>";
							$btn = "<button id=".$key->id." class='btn btn-success acptserv'><i class='fa fa-check'></i> Approve</button>";
						}elseif ($key->status == 'active') {
							$button = "<button class='btn btn-success'><i class='fa fa-check'></i> Active</button>";
							$btn = "<button id=".$key->id." class='btn btn-danger discserv' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-trash-o'></i> Discard</button>";
						}

						$user = User::find($key->user_id);
						if (!empty($user->Others->agentName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							# code...
							$name = $user->NewModel->displayName;
						}
						$servName = str_limit($key->name, $limit = 15, $end = '...');


				$view .=	"<tr class='serv".$key->id."'>
							<td>$id</td>
							<td>";
							if(!empty($key->image)){
							 $view .=  "<a href='#service' class='servinfo' data-toggle='modal' data-target='#exampleModal1' id=".$key->id.">".$image = HTML::image($key->image ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= "<a data-toggle='modal' class='servinfo' data-target='#exampleModal' href='#service' id=".$key->id.">".$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}	
				$view	.=	$servName."</a> 
							</td>
							<td>".$name."</td>
							<td>".$datecast."</td>
							<td>".$button."</td>
							<td>".$btn."</td>

						</tr>";
					}
	$view	.=		"</tbody>
				</table>";

				return View::make('admin/services')->with(compact('view'));
	}

	public function acceptservice()
	{
		# code...
		$id = $_GET['id'];
		$val = $_GET['val'];

			# code...
		if ($val == 'acptserv') {
			# code...
		$accpet = DB::table('servicemarketplace')->where('id', '=', $id)->update(array('status' => 'active'));			
		}elseif ($val == 'acptphoto') {
			# code...
		$accpet = DB::table('photosession')->where('id', '=', $id)->update(array('status' => 'active'));	
		}elseif ($val == 'acptcourses') {
			# code...
		$accpet = DB::table('courses')->where('id', '=', $id)->update(array('status' => 'active'));	
		}
		

	}

	public function modalservice()
	{
		# code...
		$id = $_GET['id'];
		$val = $_GET['val'];
		$view = '';

		if ($val == 'discserv') {
			# code...
		$getservice = DB::table('servicemarketplace')->where('id', '=', $id)->first();
		$view .= "<input type='hidden' class='para' value='service'>";
		}elseif ($val == 'discphoto') {
			# code...
		$getservice = DB::table('photosession')->where('id', '=', $id)->first();
		$view .= "<input type='hidden' class='para' value='photo'>";
		}elseif ($val == 'disccourses') {
			# code...
		$getservice = DB::table('courses')->where('id', '=', $id)->first();
		$view .= "<input type='hidden' class='para' value='courses'>";
		}



		$user = User::find($getservice->user_id);
		if (!empty($user->Others->agentName)) {
			# code...
			$name = $user->Others->agentName;
		}else{
			# code...
			$name = $user->NewModel->displayName;
		}

		$view .= "<input type='hidden' class='discid' value=".$id.">";

		$view .= "<div class='row'>
					<div class='col-lg-12'>
					<h4><i class='fa fa-user'></i>".$name."</h4>
					</div>
				</div>";
		$view .= "<div class='row'>
					<div class='col-lg-12'>
						<textarea rows='5' id='discval' class='form-control' placeholder='Reasons for discarding'>
						</textarea>
					</div>
				</div>";

		echo $view;
	}

	public function sendmsgservice()
	{
		# code...
		$id = $_GET['id'];
		$val = $_GET['val'];
		$para = $_GET['para'];

		if ($para == 'service') {
			# code...
		$getservice = DB::table('servicemarketplace')->where('id', '=', $id)->first();
		$accpet = DB::table('servicemarketplace')->where('id', '=', $id)->update(array('status' => 'discard'));
		}elseif ($para == 'photo') {
			# code...
		$getservice = DB::table('photosession')->where('id', '=', $id)->first();
		$accpet = DB::table('photosession')->where('id', '=', $id)->update(array('status' => 'discard'));
		}elseif ($para == 'courses') {
			# code...
		$getservice = DB::table('courses')->where('id', '=', $id)->first();
		$accpet = DB::table('courses')->where('id', '=', $id)->update(array('status' => 'discard'));
		}



		$castmessage = new castmessage;
		$castmessage->sender = 1;
		$castmessage->reciever = $getservice->user_id;
		$castmessage->message = $val;
		$castmessage->msgdate = date('Y-m-d');
		$castmessage->save();

	}

	public function viewserviceinfo()
	{
		# code...
		$id = $_GET['id'];
		$param = $_GET['param'];

		if ($param == 'service') {
			# code...
		$getservice = DB::table('servicemarketplace')->where('id', '=', $id)->first();
		$name = $getservice->name;

		}elseif ($param == 'photo') {
			# code...
		$getservice = DB::table('photosession')->where('id', '=', $id)->first();
		$name = $getservice->title;
		}elseif ($param == 'courses') {
			# code...
		$getservice = DB::table('courses')->where('id', '=', $id)->first();
		$name = $getservice->title;
		}

		$view = '';

		$getserviceinfo = DB::table('otherprofessional')->where('id', '=', $getservice->service)->first();

		$view .= "<div class='row'>
					<div class='col-lg-12'>";
						if(!empty($getservice->image)){
							 $view .=  $image = HTML::image($getservice->image ,'profile', array('width' => '180px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture');
									}
	$view .=	"   </div>
				</div>
				<hr>
				<div class='row'>
					<div class='col-lg-6'>
						<h4><strong>Name: </strong>".$name."</h4>
						<h4><strong>Service: </strong>".$getserviceinfo->name."</h4>
						<h4><strong>Duration: </strong>".$getservice->duration."</h4>
						<h4><strong>Country: </strong>".$getservice->country."</h4>
					</div>
					<div class='col-lg-6'>
						<h4><strong>Location: </strong>".$getservice->location."</h4>
						<h4><strong>City: </strong>".$getservice->city."</h4>
						<h4><strong>Price: </strong>".$getservice->price."</h4>
						<h4><strong>Discount: </strong>".$getservice->discount."</h4>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-12'>
						<h4><strong>Description</strong></h4>
						<p>".$getservice->description."</p>
					</div>
				</div>";
	echo $view;
	}

	public function photosession()
	{
		# code...
		$getservices = DB::table('photosession')->orderBy('id', 'DESC')->get();
$view = '';
$view .= "<input type='hidden' class='paraminfo' value='photo'>";
$view	.= "<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Service</th>
							<th>Posted By</th>
							<th>Date</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody class='text-center'>";
					$id = 0;
					foreach ($getservices as $key) {
						# code...
						$id += 1;

						$date1 = strtotime($key->date);	
						$datecast = date('l, j F Y', $date1);

						if ($key->status == 'pending') {
							# code...
							$button = "<button class='btn btn-warning'><i class='fa fa-exclamation-circle'></i> Pending</button>";
							$btn = "<button id=".$key->id." class='btn btn-success acptphoto'><i class='fa fa-check'> Approve</i></button> 
							<button id=".$key->id." class='btn btn-danger discphoto' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-trash-o'></i> Discard</button>";
						}elseif ($key->status == 'discard') {
							$button = "<button class='btn btn-danger'><i class='fa fa-trash-o'></i> Discarded</button>";
							$btn = "<button id=".$key->id." class='btn btn-success acptphoto'><i class='fa fa-check'></i> Approve</button>";
						}elseif ($key->status == 'active') {
							$button = "<button class='btn btn-success'><i class='fa fa-check'></i> Active</button>";
							$btn = "<button id=".$key->id." class='btn btn-danger discphoto' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-trash-o'></i> Discard</button>";
						}

						$user = User::find($key->user_id);
						if (!empty($user->Others->agentName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							# code...
							$name = $user->NewModel->displayName;
						}
						$servName = str_limit($key->title, $limit = 15, $end = '...');


				$view .=	"<tr class='serv".$key->id."'>
							<td>$id</td>
							<td>";
							if(!empty($key->image)){
							 $view .=  "<a href='#service' class='servinfo' data-toggle='modal' data-target='#exampleModal1' id=".$key->id.">".$image = HTML::image($key->image ,'profile', array('width' => '50px', 'height' => '50px'));
							        }else{
							$view .= "<a data-toggle='modal' class='servinfo' data-target='#exampleModal' href='#service' id=".$key->id.">".$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}	
				$view	.=	$servName."</a> 
							</td>
							<td>".$name."</td>
							<td>".$datecast."</td>
							<td>".$button."</td>
							<td>".$btn."</td>

						</tr>";
					}
	$view	.=		"</tbody>
				</table>";

				return View::make('admin/photosession')->with(compact('view'));
	}

	public function courses()
	{
		# code...
		$getservices = DB::table('courses')->orderBy('id', 'DESC')->get();
$view = '';
$view .= "<input type='hidden' class='paraminfo' value='courses'>";
$view	.= "<table id='datatables-1' class='table table-striped table-bordered' cellspacing='0' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Service</th>
							<th>Posted By</th>
							<th>Date</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody class='text-center'>";
					$id = 0;
					foreach ($getservices as $key) {
						# code...
						$id += 1;

						$date1 = strtotime($key->date);	
						$datecast = date('l, j F Y', $date1);

						if ($key->status == 'pending') {
							# code...
							$button = "<button class='btn btn-warning'><i class='fa fa-exclamation-circle'></i> Pending</button>";
							$btn = "<button id=".$key->id." class='btn btn-success acptcourses'><i class='fa fa-check'> Approve</i></button> 
							<button id=".$key->id." class='btn btn-danger disccourses' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-trash-o'></i> Discard</button>";
						}elseif ($key->status == 'discard') {
							$button = "<button class='btn btn-danger'><i class='fa fa-trash-o'></i> Discarded</button>";
							$btn = "<button id=".$key->id." class='btn btn-success acptcourses'><i class='fa fa-check'></i> Approve</button>";
						}elseif ($key->status == 'active') {
							$button = "<button class='btn btn-success'><i class='fa fa-check'></i> Active</button>";
							$btn = "<button id=".$key->id." class='btn btn-danger disccourses' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-trash-o'></i> Discard</button>";
						}

						$user = User::find($key->user_id);
						if (!empty($user->Others->agentName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							# code...
							$name = $user->NewModel->displayName;
						}
						$servName = str_limit($key->title, $limit = 15, $end = '...');


				$view .=	"<tr class='serv".$key->id."'>
							<td>$id</td>
							<td>";
							if(!empty($key->image)){
							 $view .=  "<a href='#service' class='servinfo' data-toggle='modal' data-target='#exampleModal1' id=".$key->id.">";
							$view .=  HTML::image($key->image ,'profile', array('width' => '50px', 'height' => '50px'));
							        }
				        else{
							$view .= "<a data-toggle='modal' class='servinfo' data-target='#exampleModal' href='#service' id=".$key->id.">";
							$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}	
				$view	.=	$servName."</a> 
							</td>
							<td>".$name."</td>
							<td>".$datecast."</td>
							<td>".$button."</td>
							<td>".$btn."</td>

						</tr>";
					}
	$view	.=		"</tbody>
				</table>";

				return View::make('admin/courses')->with(compact('view'));
	}

	public function account()
	{
		# code...
		return View::make('');
	}

	public function pendingjob()
	{
		# code...#
		$getcast = DB::table('job')->where('status', '=', 'pending')->orderBy('id','DESC')->get();

		return View::make('admin.pendingjob')->with(compact('getcast'));
	}

		public function pendingdtlsjobs($id)
	{
		# code...

		$getcast = DB::table('job')->where('id', '=', $id)->first();

		$getuser = DB::table('others')->where('user_id', '=', $getcast->user_id)->first();

		$getprev = DB::table('job')->where('user_id', '=', $getcast->user_id)->where('status', '=', 'previous')->count();

		$castId = $id;
		return View::make('admin.castdetailsjob')->with(compact('getcast', 'getuser', 'getprev', 'castId'));
	}

	public function othersview($id)
	{
		$getuser = DB::table('others')->where('user_id', '=', $id)->first();
		$pix = User::find($id);

		if (empty($pix->photoupload->imagename)) {
			$getpix = '';
		}else{
			$getpix = $pix->photoupload->imagename;
		}


		return View::make('admin.othersview')->with(compact('getuser', 'getpix'));
	}

	public function modelsview($id)
	{
		$getuser = DB::table('models')->where('user_id', '=', $id)->first();
		$pix = User::find($id);
		if (!empty($pix->photoupload->imagename)) {
			$getpix = $pix->photoupload->imagename;
		}else{
			$getpix = 'img/photo.jpg';
		}
		$getmodel = DB::table('modelpreference')->where('modelid', '=', $id)->first();
		$user = User::find($id);
	$dis = distable::where('user_id', '=', $id)->JOIN('disciplines', 'distable.dis_id', '=', 'disciplines.id')->get();
		$getplan = DB::table('usersplan')->where('user_id', '=', $id)->where('status', '=', 'active')->first();

		return View::make('admin.modelsview')->with(compact('getuser', 'getpix', 'getmodel', 'dis', 'user', 'getplan'));
	}
}