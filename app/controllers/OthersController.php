<?php

use Illuminate\Support\Facades\Input;

class OthersController extends BaseController{

public function welcome()
{
	$others = 'others';
	Session::set('others', $others);
		$getindustry = DB::table('industryprofessional')->get();

	$user = User::find(Auth::user()->id);
	$user_type = $user->user_type;

	switch ($user_type) {
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
			$user_type_spec = 'Others';
			break;
		default:
			# code...
			break;
	}
	$getnotifyunseen = '';
	return View::make('others/welcome')->with(compact('others', 'user_type_spec', 'getindustry', 'user_type', 'getnotifyunseen'));
}

public function dashboard()
{
	# code...

	$values = '';
	Session::forget('others');
	$otherspage = 'otherspage';
	Session::set('otherspage', $otherspage);
	$user = User::find(Auth::user()->id);

	$user = User::find(Auth::user()->id);
	$user_type = $user->user_type;
	switch ($user_type) {
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
		$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

	$status = $this->getfollowersupdate();

	$models =  DB::table('models')->orderBy('verificationtable.id','DESC')->Join('verificationtable', 'models.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->take(9)->get();

	#to fetch users of the same location
	$user_id = Auth::user()->id;
	$otherpartner = DB::table('users')->where('user_type', '=', $user->user_type)->where('users.id', '!=', $user_id)->Join('others', 'users.id', '=', 'others.user_id')->Join('photoupload', 'users.id', '=', 'photoupload.user_id')->where('others.location', '=', $user->others->location)->take(5)->get();

	#to fetch cast
	$castget = DB::table('casting')->where('status', 'activated')->where('status', '=', 'activated')->orderBy('id','DESC')->take(3)->get();

	#to fetch my cast
	$casting = DB::table('casting')->orderBy('casting.id','DESC')->where('status', 'activated')->where('casting.user_id', '=', $user_id)->take(5)->get();

	if ($casting) {
		foreach ($casting as $key) {
			$year = date('Y');
		$month = date('m');
		$day = date('d');
		$daycast = $key->Dayend;
		$monthcast = $key->Monthend;
		$yearcast = $key->Yearend;

		if ($year == $yearcast){
			if ($month == $monthcast) {
				if ($day > $daycast){
					$values = '';
				}else{

        $values        .=   "<tr>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>$key->castTitle </a></td>
										<td>$key->location</td>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>View</a></td>
									</tr>";

				}
			}elseif ($monthcast > $month) {
		$values        .=   "<tr>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>$key->castTitle </a></td>
										<td>$key->location</td>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>View</a></td>
									</tr>";
			}

		}elseif($yearcast > $year) {

        $values        .=   "<tr>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>$key->castTitle </a></td>
										<td>$key->location</td>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>View</a></td>
									</tr>";
		}else{
			$values .= '';
		}
		}
	}
	$getmsgunseen = $this->getmsgunseen();
	$getnotifyunseen = $this->getunseen();
	$verification = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();

	return View::make('others.dashboard')->with(compact('verification','user','getnotifyunseen', 'models', 'user_type_spec', 'otherpartner', 'status', 'castget', 'values', 'getmsgunseen'));

}

public function create()
{ 


	$data = Input::all();

	$getusertype = User::find(Auth::user()->id);
	if ($getusertype->user_type == 'others') {
		# code...
		$validator = Validator::make($data, Others::$others_rule2);
	}else{
		$validator = Validator::make($data, Others::$others_rules);
	}

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

		$user_id = Auth::user()->id;

		$others = new Others;
		$others->user_id = $user_id;
		$others->agentName = Input::get('Name');
		$others->CAC = Input::get('CAC');
		$others->Website = Input::get('Website');
		$others->country = Input::get('country');
		$others->location = Input::get('location');
		$others->address = Input::get('address');
		$others->telephone = Input::get('telephone');
		$others->landline = Input::get('landline');
		$others->chairmantel = Input::get('chairmantel');
		$others->chairmanemail = Input::get('chairmanemail');
		$others->chairmanname = Input::get('chairmanname');
		$others->aboutus = Input::get('aboutus');
		$others->save();

		$csdate = date('Y');
   		 $rand = mt_rand(1000000,9999999);

   		 $emailverification = new emailverification;
   		 $emailverification->user_id = $user_id;
   		 $emailverification->code = $rand.$csdate;
   		 $emailverification->save();

   		 $code = $rand.$csdate;
   		 $url=Auth::user()->id."/".$code;

   		 Mail::send('emails.welcome', array('url' => $url, 'user' => Input::get('Name')), function($message)
		{
			$message->from('ucheeberechukwu@gmail.com', 'Afrodaisy');
		    $message->to(Auth::user()->email)->subject('Welcome!');
		    
		});


		if ($getusertype->user_type == 'others') {
			$industry = new industryprofessionalusers;
			$industry->user_id = Auth::user()->id;
			$industry->industry_id = Input::get('industry');
			$industry->save();
		}


		$access = 'granted';
		$user = User::find(Auth::user()->id);
	return Redirect::to('others/uploadphoto');



	# code...
}

public function createcast()
{

	$data = Input::all();

		$validator = Validator::make($data, Casting::$cast_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

		$user_id = Auth::user()->id;

if(Input::hasFile('image')){		
		$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/castimage/' . $filename);
			Image::make($image->getRealPath())->save($path);
			$imageName = 'img/castimage/'.$filename;
}else{
	$imageName = ""; 
}
		
		    	$date = explode("/", Input::get('startDate'));
		$Monthcast = $date[0];
		$Daycast = $date[1];
		$Yearcast = $date[2];

		$date2 = explode("/", Input::get('endDate'));
		$Monthend = $date2[0];
		$Dayend = $date2[1];
		$Yearend = $date2[2];

		$date3 = explode("/", Input::get('expDate'));
		$MonthExp = $date3[0];
		$DayExp = $date3[1];
		$YearExp = $date3[2];

		$others = new Casting;
		$others->user_id = $user_id;
		$others->castTitle = Input::get('title');
		$others->castCat = Input::get('categories');
		$others->gender = Input::get('gender');		
		$others->castDescription = Input::get('casting');
		$others->castRequirement = Input::get('require');
		$others->payType = Input::get('paymethod');
		$others->payDesc = Input::get('paydetail');
		$others->country = Input::get('country');
		$others->location = Input::get('location');
		$others->area = Input::get('town');
		$others->venue = Input::get('venue');
		$others->Daycast = $Daycast;
		$others->Monthcast = $Monthcast;
		$others->Yearcast = $Yearcast;
		$others->Dayend = $Dayend;
		$others->Monthend = $Monthend;
		$others->Yearend = $Yearend;
		$others->DayExp = $DayExp;
		$others->MonthExp = $MonthExp;
		$others->YearExp = $YearExp;
		$others->castImage = $imageName;
		$others->status = 'pending';
		$others->visibility = 'all';
		$others->save();

		$catlist = Input::get('cat');

		$access = 'granted';
		$lastid  = $others->id;


		for ($i = 0; $i < count($catlist); ++$i) {

		$add = castingtype::create(array('castId' => $others->id, 'castType' => $catlist[$i] ));		
    }

		return Redirect::to('others/castadded');


	# code...
}

public function newjob()
{
	$getprofession = DB::table('industryprofessional')->get();
	$user = User::find(Auth::user()->id);
	$getnotifyunseen = $this->getunseen();
	$verification = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();
	$getverify = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->where('verify', '=', 'yes')->where('mobile', '=', 'yes')->get();
	return View::make('others.newjob')->with(compact('user', 'getnotifyunseen', 'getprofession', 'verification', 'getverify'));
}

public function createjob()
{
		$data = Input::all();

		$validator = Validator::make($data, job::$job_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

		$user_id = Auth::user()->id;

		
		$date = explode("/", Input::get('startDate'));
		$jobMonth = $date[0];
		$jobDay = $date[1];
		$jobYear = $date[2];

		$date2 = explode("/", Input::get('endDate'));
		$Monthend = $date2[0];
		$Dayend = $date2[1];
		$Yearend = $date2[2];

		$date3 = explode("/", Input::get('expDate'));
		$monthexp = $date3[0];
		$Dayexp = $date3[1];
		$yearexp = $date3[2];

		$others = new job;
		$others->user_id = $user_id;
		$others->title = Input::get('title');
		$others->job_description = Input::get('job_description');
		$others->job_task = Input::get('job_task');		
		$others->amount = Input::get('amount');
		$others->country = Input::get('country');
		$others->location = Input::get('location');
		$others->area = Input::get('town');
		$others->venue = Input::get('venue');
		$others->jobDay = $jobDay;
		$others->jobMonth = $jobMonth;
		$others->jobYear = $jobYear;
		$others->Dayend = $Dayend;
		$others->Monthend = $Monthend;
		$others->Yearend = $Yearend;
		$others->Dayexp = $Dayexp;
		$others->monthexp = $monthexp;
		$others->yearexp = $yearexp;
		$others->status = 'pending';
		$others->visibility = 'all';
		$others->user_spec = Input::get('user_spec');		
		$others->save();

		$catlist = Input::get('cat');

		$access = 'granted';
		$lastid  = $others->id;

		$dates = date('d-m-Y');

		$notify = DB::table('notification')->where('name', '=', 'upcomingJob')->first();

    	$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $user_id;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifyUpcomingjob;
		$upcoming->NotId = $ModelNotId;
		$upcoming->job_id = $lastid;
		$upcoming->date = $dates;
		$upcoming->save();


	

		return Redirect::to('others/jobadded');

}

public function jobadded()
{
	$user = User::find(Auth::user()->id);
			$getnotifyunseen = $this->getunseen();
	return View::make('others.jobadded')->with(compact('user', 'getnotifyunseen'));
}

public function castadded()
{
	$user = User::find(Auth::user()->id);
			$getnotifyunseen = $this->getunseen();
	return View::make('others.castadded')->with(compact('user', 'getnotifyunseen'));
}

public function joblisting()
{
	$user = User::find(Auth::user()->id);
	$getcast = DB::table('job')->where('user_id', '=', Auth::user()->id)->orderBy('id','DESC')->get();
	$view = '';
	$getNum = DB::table('job')->where('user_id', '=', Auth::user()->id)->count();
	$num = $getNum/5;
	$val = ceil($num);

	foreach($getcast as $casting){
		$getbtnlink = $this->getbtnlink2($casting->id);
		$view .=	"<li>
						<div class='row' style='border: 1px solid #000'>
                        <div class='col-lg-2 col-sm-2 col-xs-12'>";
                        	if(!empty($casting->castImage)){
                $view .= HTML::image($casting->castImage ,'cast picture', array('width' => '130px', 'height' => '170px', 'class' => 'img-responsive'));
                        	}
                        	else{
                $view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '170px', 'class' => 'img-responsive')); 
                    		}
               $view .= "</div>
               			<div class='col-lg-1'></div>
                        <div class='col-lg-6 col-sm-6 col-xs-12'>
                            <h5><strong>$casting->title</strong></h5>
                            <p>Contract code: <strong>$casting->jobcode</strong>
                            <p>Contract Status:  <strong>$casting->status</strong></p>
                        </div>
                        <div class='col-lg-3 col-sm-3 col-xs-12 text-center'>
                        <br>
                        <br>";
                        	
                    $view .= $getbtnlink;
                    $view .=  "</div>
                    </div>
					<br>
					</li>";
		}

		$view = "<ul class='paginate' style='list-style-type:none'>
					$view
				</ul>";

		$getnotifyunseen = $this->getunseen();

	return View::make('others.joblisting')->with(compact('user', 'getnotifyunseen', 'getcast', 'view', 'val'));
}

public function uploadphoto()
{
	$getnotifyunseen = '';
	Session::forget('others');
	
	$user = User::find(Auth::user()->id);
	return View::make('others/photoupload')->with(compact('user', 'getnotifyunseen'));
}
public function uploadImage()
{

	$data = Input::all();

		$validator = Validator::make($data,  photoupload::$rules2);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

			$user_id = Auth::user()->id;
			if(Input::hasFile('image')){
			$imageclass = new photoupload;
			$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/profile/' . $filename);
			Image::make($image->getRealPath())->save($path);
			$imageclass->user_id = $user_id;
			$imageclass->image_type = Input::get('image_type');
			$imageclass->imagename = 'img/profile/'.$filename;
			$imageclass->image_desc = 'profileImage';
			$imageclass->save();

			$imagegallery = new imagegallery;
			$imagegallery->user_id = $user_id;
			$imagegallery->imagename = 'img/profile/'.$filename;
			$imagegallery->save();
			}
	$user = Auth::user()->id;

	


			$otherspage = 'otherspage';
			Session::set('otherspage', $otherspage);
	$user = User::find(Auth::user()->id);
	return  Redirect::to('others/dashboard');
}

public function profile($id)
{
	$user = User::find($id);
	return View::make('others.profile', compact('user'));
	
}

public function edit()
{
	$user = User::find(Auth::user()->id);
	$user_type = $user->user_type;
	switch ($user_type) {
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
		$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

	$user_id = Auth::user()->id;
	$Others = Others::where('user_id',$user->id)->first();

	$getnotifyunseen = $this->getunseen();	


	$getgallery = DB::table('imagegallery')->where('user_id', '=', Auth::user()->id)->get();

	return View::make('others.edit')->with(compact('user', 'getnotifyunseen', 'user_type_spec', 'Others', 'getgallery'));
}

public function newcasting()
{
	$categories = Discipline::select('id', 'name')->get();
	$dis = DB::table('categories')->get();
	$user = User::find(Auth::user()->id);
	$getnotifyunseen = $this->getunseen();
	$getverify = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->where('verify', '=', 'yes')->where('mobile', '=', 'yes')->get();
	$verification = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();

	return View::make('others.newcasting')->with(compact('user', 'getnotifyunseen', 'categories', 'dis', 'getverify', 'verification'));
}

public function getbtnlink($id)
{
	# code...
	$casting = DB::table('casting')->where('id', '=', $id)->first();
	$view = '';
	if($casting->status == 'activated'){ 

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$daycast = $casting->DayExp;
		$monthcast = $casting->MonthExp;
		$yearcast = $casting->YearExp;

		if ($year == $yearcast){
			if ($month == $monthcast) {
				if ($day > $daycast){
					$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";
				}else{

        $view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=showcast/$casting->id><i class='fa fa-gears'></i> MANAGE CAST</a>";

				}
			}elseif ($monthcast > $month) {
        $view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=showcast/$casting->id><i class='fa fa-gears'></i> MANAGE CAST</a>";		
			}

		}elseif($yearcast > $year) {

        $view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=showcast/$casting->id><i class='fa fa-gears'></i> MANAGE CAST</a>";
		}else{
			$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";
		}

            	}
            	elseif($casting->status == 'pending'){
        $view .=  "<button class='btn btn-xs btn-warning'><i class='fa fa-exclamation-circle'></i> Pending</button>";
            	}
            	elseif($casting->status == 'declined'){
        $view .=  "<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i> Declined</button>";
            	}elseif ($casting->status == 'finished') {
            		# code...
            		date('d-m-Y');
            		$year = date('Y');
            		$month = date('m');
            		$day = date('d');
            		$daycast = $casting->Daycast;
            		$monthcast = $casting->Monthcast;
            		$yearcast = $casting->Yearcast;
            		if ($year == $yearcast) {
            			# code...
            			if ($month == $monthcast) {
            				# code...
            				$daydiff = $daycast - $day;
            				if ($daycast == $day) {
            					
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=acknoledge/$casting->id><i class='fa fa-gears'></i> Acknowledge Models</a>";
            				}elseif ($daydiff < 7) {
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=acknoledge/$casting->id><i class='fa fa-gears'></i> Acknowledge Models</a>";
            				}elseif ($day > $daycast) {
            		$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";
            				}else{
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=manage/$casting->id><i class='fa fa-gears'></i> MANAGE CAST</a>";	
            				}
            			}elseif ($monthcast > $month) {
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=manage/$casting->id><i class='fa fa-gears'></i> MANAGE CAST</a>";
            			}else{
            		$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";	
            			}
            		}elseif($yearcast > $year){
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=manage/$casting->id><i class='fa fa-gears'></i> MANAGE CAST</a>";
            		}
            		else{
            			$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";
            		}
            	}
            	return $view;
}

public function getbtnlink2($id)
{
	# code...
	$casting = DB::table('job')->where('id', '=', $id)->first();
	$view = '';
	if($casting->status == 'activated'){ 
        $view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=showjob/$casting->id><i class='fa fa-gears'></i> MANAGE CONTRACT</a>";
            	}
            	elseif($casting->status == 'pending'){
        $view .=  "<button class='btn btn-xs btn-warning'><i class='fa fa-exclamation-circle'></i> Pending</button>";
            	}
            	elseif($casting->status == 'declined'){
        $view .=  "<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i> Declined</button>";
            	}elseif ($casting->status == 'finished') {
            		# code...
            		date('d-m-Y');
            		$year = date('Y');
            		$month = date('m');
            		$day = date('d');
            		$daycast = $casting->jobDay;
            		$monthcast = $casting->jobMonth;
            		$yearcast = $casting->jobYear;
            		if ($year == $yearcast) {
            			# code...
            			if ($month == $monthcast) {
            				# code...
            				$daydiff = $daycast - $day;
            				if ($daycast == $day) {
            					
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=acknoledge/$casting->id><i class='fa fa-gears'></i> Acknowledge Users</a>";
            				}elseif ($daydiff < 7) {
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=acknoledge/$casting->id><i class='fa fa-gears'></i> Acknowledge Users</a>";
            				}elseif ($day > $daycast) {
            		$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";
            				}else{
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=manage/$casting->id><i class='fa fa-gears'></i> MANAGE CONTRACT</a>";	
            				}
            			}elseif ($monthcast > $month) {
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=manage/$casting->id><i class='fa fa-gears'></i> MANAGE CONTRACT</a>";
            			}else{
            		$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";	
            			}
            		}elseif($yearcast > $year){
            		$view .= "<a class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;' href=manage/$casting->id><i class='fa fa-gears'></i> MANAGE CONTRACT</a>";
            		}
            		else{
            			$view .= "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Completed</button>";
            		}
            	}
            	return $view;
}

public function castlisting()
{
	$user = User::find(Auth::user()->id);
	$getcast = DB::table('casting')->where('user_id', '=', Auth::user()->id)->orderBy('id','DESC')->get();
	$view = '';
	$getNum = DB::table('casting')->where('user_id', '=', Auth::user()->id)->count();
	$num = $getNum/5;
	$val = ceil($num);

	foreach($getcast as $casting){
		$getbtnlink = $this->getbtnlink($casting->id);
		$view .=	"<li>
						<div class='row' style='border: 1px solid #000'>
                        <div class='col-lg-2 col-sm-2 col-xs-12'>";
                        	if(!empty($casting->castImage)){
                $view .= HTML::image($casting->castImage ,'cast picture', array('width' => '130px', 'height' => '170px', 'class' => 'img-responsive'));
                        	}
                        	else{
                $view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '170px', 'class' => 'img-responsive')); 
                    		}
               $view .= "</div>
               			<div class='col-lg-1'></div>
                        <div class='col-lg-6 col-sm-6 col-xs-12'>
                            <h5><strong>$casting->castTitle</strong></h5>
                            <p>Cast code: <strong>$casting->castcode</strong>
                            <p>Cast Status:  <strong>$casting->status</strong></p>
                        </div>
                        <div class='col-lg-3 col-sm-3 col-xs-12 text-center'>
                        <br>
                        <br>";
                        	
                    $view .= $getbtnlink;
                    $view .=  "</div>
                    </div>
					<br>
					</li>";
		}

		$view = "<ul class='paginate' style='list-style-type:none'>
					$view
				</ul>";

		$getnotifyunseen = $this->getunseen();

	return View::make('others.castlisting')->with(compact('user', 'getnotifyunseen', 'getcast', 'view', 'val'));
}

public function getinvite($value)
{
	# code...
	$castPref = DB::table('castpreference')->where('castId', '=', $value)->first();
	$casting = DB::table('casting')->where('id', '=', $value)->first();
	$catType = DB::table('castingtype')->where('castingtype.castId', '=', $value)->Join('catinput', 'castingtype.castType', '=', 'catinput.cat_id')->first();
	$distable = DB::table('castdisciplines')->where('castdisciplines.castId', '=', $value)->Join('distable', 'castdisciplines.discId', '=', 'distable.dis_id')->first();
	$model = DB::table('models')->leftJoin('catinput', 'models.user_id', '=', 'catinput.user_id')->leftJoin('distable', 'models.user_id', '=', 'distable.user_id')->leftJoin('users', 'models.user_id', '=', 'users.id')->leftJoin('modelpreference', 'models.user_id', '=', 'modelpreference.modelId');
	$view = '';

	if ($castPref) {
		# code...

		if (!empty($castPref->ethnicity)) {
			# code...
			$ethnicity = $castPref->ethnicity;
			$getit = $model->where('modelpreference.ethnicity', '=', $ethnicity );
                    
		}
		if (!empty($castPref->hair_type)) {
			# code...
			$Hair_type = $castPref->hair_type;
			$getit = $model->where('modelpreference.Hair_type', '=', $Hair_type );
                    
		}
		if (!empty($castPref->butt)) {
			# code...
			$butt = $castPref->butt;
			$getit = $model->where('modelpreference.butt', '=', $butt );
                    
		}
		if (!empty($castPref->languages)) {
			# code...
			$languages = $castPref->languages;
			$getit = $model->where('modelpreference.languages', '=', $languages );
                    
		}
		if (!empty($castPref->qualification)) {
			# code...
			$qualification = $castPref->qualification;
			$getit = $model->where('modelpreference.qualification', '=', $qualification );
                    
		}
		if (!empty($castPref->shoesFrom)) {
			# code...
			$shoesmin = $castPref->shoesFrom;
			$getit = $model->where('modelpreference.shoes', '>=', $shoesmin );
                    
		}
		if (!empty($castPref->shoesTo)) {
			# code...
			$shoesmax = $castPref->shoesTo;
			$getit = $model->where('modelpreference.shoes', '<=', $shoesmax );
                    
		}
		if (!empty($castPref->jacketFrom)) {
			# code...
			$jacketmin = $castPref->jacketFrom;
			$getit = $model->where('modelpreference.jacket', '>=', $jacketmin );
                   
		}
		if (!empty($castPref->jacketTo)) {
			# code...
			$jacketmax = $castPref->jacketTo;
			$getit = $model->where('modelpreference.jacket', '<=', $jacketmax );
                    
		}
		if (!empty($castPref->waistFrom)) {
			# code...
			$waistmin = $castPref->waistFrom;
			$getit = $model->where('modelpreference.hair_color', '>=', $waistmin );
                    
		}
		if (!empty($castPref->waistTo)) {
			# code...
			$waistmax = $castPref->waistTo;
			$getit = $model->where('modelpreference.waist', '<=', $waistmax );
                    
		}
		if (!empty($castPref->hair_color)) {
			# code...
			$haircolor = $castPref->hair_color;
			$getit = $model->where('modelpreference.hair_color', '=', $haircolor );
                    
		}
		if (!empty($castPref->dressFrom)) {
			# code...
			$dressmin = $castPref->dressFrom;
			$getit = $model->where('modelpreference.dress', '>=', $dressmin );
                    
		}
		if (!empty($castPref->dressTo)) {
			# code...
			$dressmax = $castPref->dressTo;
			$getit = $model->where('modelpreference.dress', '<=', $dressmax );
		}
		if (!empty($castPref->collarFrom)) {
			# code...
			$collarmin = $castPref->collarFrom;
			$getit = $model->where('modelpreference.collar', '>=', $collarmin );
		}
		if (!empty($castPref->collarTo)) {
			# code...
			$collarmax = $castPref->collarTo;
            $getit = $model->where('modelpreference.collar', '<=', $collarmax );
		}
		if (!empty($castPref->heightFrom)) {
			# code...
			$heightmin = $castPref->heightFrom;
			$getit = $model->where('models.Height', '>=', $heightmin);
		}
		if (!empty($castPref->heightTo)) {
			# code...
			$heightmax = $castPref->heightTo;
			$getit = $model->where('models.Height', '<=', $heightmax);
		}
		if (!empty($castPref->trousersFrom)) {
			# code...
			$trousersFrom = $castPref->trousersFrom;
			$getit = $model->where('modelpreference.trousers', '>=', $trousersFrom);
		}
		if (!empty($castPref->trousersTo)) {
			# code...
			$trousersTo = $castPref->trousersTo;
			$getit = $model->where('modelpreference.trousers', '<=', $trousersTo);
		}
		if (!empty($castPref->ageTo)) {
			# code...
			$agemax = $castPref->ageTo;
			$getit = $model->where('models.Age', '<=', $agemax);
		}
		if (!empty($castPref->ageFrom)) {
			# code...
			$agemin = $castPref->ageFrom;
			$getit = $model->where('models.Age', '>=', $agemin);
		}
		if (!empty($catType->cat_id)) {
			# code...
			$catTyp = $catType->cat_id;
			$getit = $model->where('catinput.cat_id', '=', $catTyp);
		}		
		if (!empty($distable->dis_id)) {
			# code...
			$distbl = $distable->dis_id;
			$getit = $model->where('distable.dis_id', '=', $distbl);
		}
		if (!empty($casting->getstates)) {
			# code...
			$getstates = $casting->getstates;
			$getit = $model->where('location', '=', $getstates);
		}
		if (!empty($casting->getcountry)) {
			# code...
			$getcountry = $casting->getcountry;
			$getit = $model->where('models.country', '=', $getcountry);
		}
		if (!empty($casting->gender)) {
			# code...
			if ($casting->gender == 'both') {
				# code...
			$getit= $model->where('models.gender', '!=', '');	
			}else{
			$gender = $casting->gender;
			$getit= $model->where('models.gender', '=', $gender);
			}
		}
		if (!empty($castPref->eyes)) {
			# code...
			$eyes = $castPref->eyes;
                $getit = $model->where('modelpreference.eyes', '=', $eyes);
		}
		if (!empty($castPref->chestbustFrom)) {
			# code...
			$bustmin = $castPref->chestbustFrom;
                $getit = $model->where('modelpreference.chestbust', '>=', $bustmin);
		}
		if (!empty($castPref->chestbustTo)) {
			# code...
			$bustmax = $castPref->chestbustTo;
                $getit = $model->where('modelpreference.chestbust', '<=', $bustmax);
		}
		if(!empty($castPref->waistFrom)) {
			# code...
			$waistmax = $castPref->waistFrom;
			$getit = $model->where('modelpreference.waist', '>=', $waistmax );
		}
		if(!empty($castPref->waistTo)) {
			# code...
			$waistmin = $castPref->waistTo;
			$getit = $model->where('modelpreference.waist', '<=', $waistmin );
		}


		$result = $getit->select('models.user_id')->distinct()->get();

	}else{
		$result = $model->select('models.user_id')->distinct()->get();
	}

	


    	$view	.=	"<div class='row'>
    			<div class='col-lg-12'>
    				<div class=''>
    			<ul class='paginates' style='list-style-type:none;'>";
    					foreach($result as $uses){
    						$user_id = $uses->user_id;
    						$getuser = DB::table('casttable')->where(function($query1) use ($user_id, $value){
									$query1
									->where('cast_id', '=', $value)
									->where('user_id', '=', $user_id)
									->where('castMethod','=', 'invited')
						    		->where('castStatus', '!=', 'confirmed');				
									})
    								->orwhere(function($query2) use ($user_id, $value){
									$query2
									->where('cast_id', '=', $value)
									->where('user_id', '=', $user_id)
						    		->where('castStatus', '=', 'confirmed');				
									})->count();
    						if ($getuser < 1) {
    							# code...
    							$user = User::find($uses->user_id);
    						if (empty($user->photoupload->imagename)) {
    		$view .= '';
    						}else{
    		$view .=	"<li><div id='invchck'>
    					<div class='col-lg-2 col-sm-3 col-md-3 thumbnail-image' style='margin-top: 5px'>
    						<div class='checkbx'>
    						<input type = 'checkbox' name='cat' value=".$uses->user_id."></div>";
    						
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
							$name = str_limit($user->NewModel->displayName, $limit = 12, $end = '...');
    	$view	.=		"<br>
    					<p><a href=/models/profile/$uses->user_id>$name</a></p>
    					</div>
    					</div></li>";
    					}	
    					}
    					}
    	$view	.=		"</ul>
    				<br><br>
    			<script type='text/javascript'>
			    $('.paginates').paginathing({
			    perPage: 24,
			    limitPagination: 10
				})
				</script></div>
    			</div>
    			</div>";
	
		return $view;
}

public function showcast($id)
{

#to get cast 

	$getDiscipline = DB::table('categories')->get();

	$Discipline = DB::table('disciplines')->get();

	$getDisVal = DB::table('castingtype')->where('castId', '=',  $id)->first();

	$getCategory = DB::table('castdisciplines')->where('castId', '=', $id)->first();

#to fetch invited and applied user
	$getAllUser = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $id)->where('casttable.castStatus', '=', '')->where('casttable.castRequest', '=', 'request')->get();

#to fetch discarded user
	$getAlldiscarded = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $id)->where('casttable.castStatus', '=', 'discarded')->where(						function($query1){
									$query1
									->where('casttable.castRequest', '=', 'request')
									->orwhere('casttable.castMethod', '=', 'invited');				
									})->get();

#to fetch confirmed user
	$getAllconfirmed = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $id)->where('casttable.castStatus', '=', 'confirmed')->where('casttable.castMethod', '=', 'invited')->get();

	$getcastpreference = DB::table('castpreference')->where('castId', '=', $id)->first();

	$getinvited = DB::table('casttable')->where('cast_id', '=', $id)->Join('models', 'casttable.user_id', '=', 'models.user_id')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->get();

	$result = $this->getinvite($id);

	$getUser = DB::table('models')->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->get();
	$user = User::find(Auth::user()->id);
	$cast = Casting::find($id);
	$getnotifyunseen = $this->getunseen();
	return View::make('others.showcast')->with(compact('user', 'getnotifyunseen', 'cast', 'getUser', 'getAllUser', 'Discipline', 'result', 'getDisVal', 'getCategory', 'getDiscipline', 'getAllconfirmed', 'getAlldiscarded', 'getcastpreference', 'getinvited'));	


}

public function showjob($id)
{


#to fetch invited and applied user
	$getAllUser = DB::table('jobtable')->Join('photoupload', 'jobtable.user_id', '=', 'photoupload.user_id')->Join('others', 'jobtable.user_id', '=', 'others.user_id')->where('jobtable.job_id', '=', $id)->where('jobtable.jobStatus', '=', '')->where('jobtable.jobRequest', '=', 'request')->get();

#to fetch discarded user
	$getAlldiscarded = DB::table('jobtable')->Join('photoupload', 'jobtable.user_id', '=', 'photoupload.user_id')->Join('others', 'jobtable.user_id', '=', 'others.user_id')->where('jobtable.job_id', '=', $id)->where('jobtable.jobStatus', '=', 'discarded')->where(						function($query1){
									$query1
									->where('jobtable.jobRequest', '=', 'request')
									->orwhere('jobtable.jobMethod', '=', 'invited');				
									})->get();

#to fetch confirmed user
	$getAllconfirmed = DB::table('jobtable')->Join('photoupload', 'jobtable.user_id', '=', 'photoupload.user_id')->Join('others', 'jobtable.user_id', '=', 'others.user_id')->where('jobtable.job_id', '=', $id)->where('jobtable.jobStatus', '=', 'confirmed')->where('jobtable.jobMethod', '=', 'invited')->get();

	$getinvited = DB::table('jobtable')->where('job_id', '=', $id)->Join('others', 'jobtable.user_id', '=', 'others.user_id')->Join('photoupload', 'jobtable.user_id', '=', 'photoupload.user_id')->get();


	$user = User::find(Auth::user()->id);
	$job = job::find($id);
	$getjob = DB::table('job')->first();
	$getnotifyunseen = $this->getunseen();
	$getprofession = DB::table('industryprofessional')->get();
	return View::make('others.showjob')->with(compact('user', 'getjob', 'getprofession', 'getnotifyunseen', 'job', 'getAllUser', 'getAllconfirmed', 'getAlldiscarded', 'getinvited'));	


}


public function castupdate($id)
{


$data = Input::all();

		$validator = Validator::make($data, Casting::$cast_update);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

$cast_id = Input::get('cast_id');

$imagevar = Input::file('image');

if (Input::hasFile('image')) {

	$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/castimage/' . $filename);
			Image::make($image->getRealPath())->save($path);

	$imageInput = 'img/castimage/'.$filename;
}else{

	$imageInput = Input::get('imageName');
}

$affectedRows = Casting::where('id', '=', $cast_id)->update(array('castTitle' => Input::get('castTitle'),
					'castDescription' => Input::get('castDescription'),
					'payType' => Input::get('payType'),			
					'payDesc' => Input::get('payDesc'),
					'location' => Input::get('location'),			
					'area' => Input::get('area'),
					'Daycast' => Input::get('Daycast'),			
					'Monthcast' => Input::get('Monthcast'),
					'Yearcast' => Input::get('Yearcast'),
					'DayExp' => Input::get('DayExp'),
					'MonthExp' => Input::get('MonthExp'),
					'YearExp' => Input::get('YearExp'),
					'castImage' => $imageInput
					));

	return $this->showcast($cast_id);

}

public function jobupdate($id)
{


$data = Input::all();

		$validator = Validator::make($data, job::$job_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

$cast_id = Input::get('job_id');

$affectedRows = job::where('id', '=', $cast_id)->update(array('title' => Input::get('title'),
					'job_description' => Input::get('job_description'),
					'job_task' => Input::get('job_task'),			
					'amount' => Input::get('amount'),
					'country' => Input::get('country'),
					'location' => Input::get('location'),			
					'area' => Input::get('town'),
					'venue' => Input::get('venue'),
					'jobDay' => Input::get('jobDay'),
					'jobMonth' => Input::get('jobMonth'),
					'jobYear' => Input::get('jobYear'),
					'Dayend' => Input::get('Dayend'),
					'Monthend' => Input::get('Monthend'),
					'Yearend' => Input::get('Yearend'),
					'Dayexp' => Input::get('Dayexp'),
					'monthexp' => Input::get('monthexp'),
					'yearexp' => Input::get('yearexp'),
					'user_spec' => Input::get('user_spec')
					));

	return Redirect::back();

}

public function invitemodels()
{
		$catlist = $_GET['cats'];
		$cast_id = $_GET['cast_ids'];

		$val = '';
		$val2 = '';
			foreach ($catlist as $key => $value) {
		foreach ($value as $cat ) {
		
		$val .= $cat;

		}
	}

	$pieces = explode("cat", $val);
		$vals = $pieces;
			# code...
		foreach ($pieces as $keys => $value) {

			$val2 = $value;

		$castmethod = "invited";
		$getval = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $val2)->where('castRequest','=', 'request')->get();

		if (!empty($val2)) {

			$chckinv = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $val2)->where('castMethod', '=', $castmethod)->count();
			if ($chckinv < 1) {
				# code...
				if ($getval) {
			# code...
			$insertVal = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $val2)->where('castRequest','=', 'request')->update(array('castStatus' => 'confirmed'));
			$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $val2;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast_id;
		$upcoming->user_id = $val2;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

		$getnum = DB::table('models')->where('user_id', '=', $val2)->first();
		$num = $getnum->phone;
		$user = $getnum->displayName;
		$getmail = User::find($val2);

	$msg = "You have been invited for a cast/job. Log in to check details @ www.afrodaisymodels.com";

	$send = "<script type='text/javascript'>
		var data = JSON.stringify({
	  'from': 'Afrodaisy',
	  'to': $num,
	  'text': '$msg'
	});

	var xhr = new XMLHttpRequest();
	xhr.withCredentials = false;

	xhr.addEventListener('readystatechange', function () {
	  if (this.readyState === this.DONE) {
	    console.log(this.responseText);
	  }
	});

	xhr.open('POST', 'https://api.infobip.com/sms/1/text/single');
	xhr.setRequestHeader('authorization', 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ==');
	xhr.setRequestHeader('content-type', 'application/json');
	xhr.setRequestHeader('accept', 'application/json');

	xhr.send(data);
	</script>";

	Mail::send('emails.invited', array('user' => $user), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

	echo $send;

		$dates = date('d-m-Y');
		}else{
		$add = casttable::create(array('cast_id' => $cast_id, 'user_id' => $val2, 'castMethod' => $castmethod ));

		$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'castinvitation')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $val2;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast_id;
		$upcoming->user_id = $val2;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

		$getnum = DB::table('models')->where('user_id', '=', $val2)->first();
		$num = $getnum->phone;
		$user = $getnum->displayName;
		$getmail = User::find($val2);

		$msg = "You have been invited for a cast/job. Log in to check details @ www.afrodaisymodels.com";

		$send = "<script type='text/javascript'>
			var data = JSON.stringify({
		  'from': 'Afrodaisy',
		  'to': $num,
		  'text': '$msg'
		});

		var xhr = new XMLHttpRequest();
		xhr.withCredentials = false;

		xhr.addEventListener('readystatechange', function () {
		  if (this.readyState === this.DONE) {
		    console.log(this.responseText);
		  }
		});

		xhr.open('POST', 'https://api.infobip.com/sms/1/text/single');
		xhr.setRequestHeader('authorization', 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ==');
		xhr.setRequestHeader('content-type', 'application/json');
		xhr.setRequestHeader('accept', 'application/json');

		xhr.send(data);
		</script>";

		echo $send;
		Mail::send('emails.invited', array('user' => $user), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

		$dates = date('d-m-Y');
		}
			}
		
		}
	}

	

	echo "<div class='row'>
			<div class='col-lg-4'>
		<h5 class='bg-primary' style='padding: 5px'>user invited</h5>
		</div>
		<div>";

}

public function processconfirm2()
{
		
	$user = $_GET['user'];
	$cast = $_GET['cast'];
	$vals = $_GET['val'];

		if (!empty($user)) {
			# code...
		jobtable::where('job_id', '=', $cast)->where('user_id', '=', $user)->update(array('jobStatus' => 'confirmed'));
			# code...
	}


	echo "<p class='bg-success' style='padding: 10px'>Added Successfully</p>";
	
}


public function processconfirm()
{
		
	$user = $_GET['user'];
	$cast = $_GET['cast'];
	$vals = $_GET['val'];

	$val = '';
    foreach ($user as $key => $value) {
	foreach ($value as $use) {
		$val .= $use;

		}
	}

	$pieces = explode($vals, $val);

	foreach ($pieces as $key => $users){
		if (!empty($users)) {
			# code...
		casttable::where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('castStatus' => 'confirmed'));

		$dates = date('d-m-Y');
		$times = date('g:i A');

$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $users;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast;
		$upcoming->user_id = $users;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

		$dates = date('d-m-Y');

			# code...
	}
	}

	echo "<p class='bg-success' style='padding: 10px'>Confirmed Successfully</p>";
}

public function processextconfirm()
{
		
	$user = $_GET['user'];
	$cast = $_GET['cast'];
	$vals = $_GET['val'];


	$val = '';
    foreach ($user as $key => $value) {
	foreach ($value as $use) {
		$val .= $use;

		}
	}

	$pieces = explode($vals, $val);

	foreach ($pieces as $key => $users) {
		if (!empty($users)) {
			# code...
		casttable::where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('castStatus' => 'confirmed'));

		$getaccptcast = DB::table('modelsaccptaftcast')->where('cast_id', '=', $cast)->where('user_id', '=', $users)->get();

		if ($getaccptcast) {
			# code...
			modelsaccptaftcast::where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('status' => 'no'));

			$insaccptaftcast = new modelsaccptaftcast;
			$insaccptaftcast->user_id = $users;
			$insaccptaftcast->cast_id = $cast;
			$insaccptaftcast->status = 'yes';
			$insaccptaftcast->save();
		}else{
			$insaccptaftcast = new modelsaccptaftcast;
			$insaccptaftcast->user_id = $users;
			$insaccptaftcast->cast_id = $cast;
			$insaccptaftcast->status = 'yes';
			$insaccptaftcast->save();
		}

		$dates = date('d-m-Y');
		$times = date('g:i A');

$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $users;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast;
		$upcoming->user_id = $users;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

		$dates = date('d-m-Y');

			# code...
	}
	}

echo "<p class='bg-success' style='padding: 10px'>Confirmed Successfully</p>";
}

public function checkout()
{
	# code...
	$no = 0;
	$view = '';
	$id = $_GET['cast'];
	$getcast = DB::table('casting')->where('id', '=', $id)->first();
	$getuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
	$getcount = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();

	$Amount = $getcast->payDesc * $getcount;

	$view .= "<div class='modal-body'>
      		<div class='well'>
      			<div class='row'>";

if ($getcast->payType == 'paid') {
	# code...
		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$getcast->castTitle."</h4>
				<p>Number of models for the cast: <strong>$getcount</strong></p>
				<p>Total Amount: <strong>$Amount</strong></p>";

		$footer = "<div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			        <a type='button' target='_' class='btn-primary Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px' href=/others/payofflinecast/$id>Pay Offline</a>
			        <form action='/pay/cast' method='post'>
			        <input type='hidden' name='cast_id' value=$id>
			        <button class='btn-success Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px'><i class='fa fa-money'></i> Pay Online</button>
			        </form>
			        <button class='btn btn-primary proceedpay' ><i class='fa fa-money'></i> Proceed to Payment</button>
			      </div>";
}else{
		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$getcast->castTitle."</h4>
				<p>Number of models for the cast: <strong>$getcount</strong></p>";
		$footer = "<div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			        <a type='button' class='btn btn-primary' href=/others/paycheckout/$id><i class='fa fa-shopping-cart'></i> Proceed to Checkout</a>
			      </div>";
}

	$view .=	"<br>
					<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody>";
						foreach ($getuser as $key) {
							# code...
							$no += 1;
							$user = User::find($key->user_id);
						$view .= "<tr>
									<td>$no</td>
									<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";
						}
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";
     	 $view .= $footer;

			echo $view;
}

public function checkoutjob()
{
	# code...
	$no = 0;
	$view = '';
	$id = $_GET['cast'];
	$getcast = DB::table('job')->where('id', '=', $id)->first();
	$getuser = DB::table('jobtable')->where('job_id', '=', $id)->where('jobStatus', '=', 'confirmed')->get();
	$getcount = DB::table('jobtable')->where('job_id', '=', $id)->where('jobStatus', '=', 'confirmed')->count();

	$Amount = $getcast->amount;

	$view .= "<div class='modal-body'>
      		<div class='well'>
      			<div class='row'>";
	# code...
		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$getcast->title."</h4>
				<p>Number of models for the cast: <strong>$getcount</strong></p>
				<p>Total Amount: <strong>$Amount</strong></p>";

		$footer = "<div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			        <input type='hidden' class='jobid' value=$id>
			        <a type='button' target='_' class='btn-primary Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px' href=/others/payofflinejob/$id>Pay Offline</a>
			        <form action='/pay/job' method='post'>
			        <input type='hidden' name='job_id' value=$id>
			        <button class='btn-success Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px'><i class='fa fa-money'></i> Pay Online</button>
			        </form>
			        <button class='btn btn-primary proceedpay' ><i class='fa fa-money'></i> Proceed to Payment</button>
			      </div>";


	$view .=	"<br>
					<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody>";
						foreach ($getuser as $key) {
							# code...
							$no += 1;
							$user = User::find($key->user_id);
						$view .= "<tr>
									<td>$no</td>
									<td>".$user->Others->agentName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";
						}
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";
     	 $view .= $footer;

			echo $view;
}

public function checkoutpost()
{
	# code...
	$no = 0;
	$val = 0;
	$view = '';
	$id = $_GET['cast'];
	$getcast = DB::table('casting')->where('id', '=', $id)->first();
	$getuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
	$getcount = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();
	$getrec = DB::table('castreceipt')->where('cast_id', '=', $id)->get();

	$count = '';
	foreach ($getrec as $key) {
		# code...
		$count += $key->nomodels; 
	}

	$Amount = $getcast->payDesc * $count;

	$view .= "<div class='modal-body'>
      		<div class='well'>
      			<div class='row'>";

if ($getcast->payType == 'paid') {
	# code...

		$getprevious = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('status', 'active')->count();

		$preval = $getcast->payDesc * $getprevious;

		$newamount = $Amount - $preval;

		foreach ($getuser as $key) {
							$getpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->first();
							if ($getpayment) {
								# code...
								if ($getpayment->status == 'inactive') {
									# code...
									$val += 1;
								}
							}else{

								$val += 1;
							}
							# code...
						}

		$totqty = $getprevious + $val;

		$totalamt = $getcast->payDesc * $totqty;

		if ($totalamt > $Amount) {
			# code...
			$newamount = $totalamt-$Amount;
			$footer = "<div class='modal-footer'>
				        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				        			        <a type='button' target='_' class='btn-primary Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px' href=/others/payofflinecast2/$id>Pay Offline</a>
				   <form action='pay/cast' method='post'>
			        <input type='hidden' name='cast_id' value=$id>
			        <button class='btn-success Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px'><i class='fa fa-money'></i> Pay Online</button>
			        </form>
			        <button class='btn btn-primary proceedpay' ><i class='fa fa-money'></i> Proceed to Payment</button>
				      </div>";
		}elseif ($totalamt == $Amount) {
			# code...
			$newamount = '';
			$footer = "<div class='modal-footer'>
				        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				        <a type='button' class='btn btn-primary' href=/others/paycheckoutpost/$id><i class='fa fa-shopping-cart'></i> Proceed to Checkout</a>
				      </div>";
		}elseif ($totalamt < $Amount) {
			# code...
			$newamount = $totalamt-$Amount;
			$footer = "<div class='modal-footer'>
				        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				        <a type='button' class='btn btn-primary' href=/others/paycheckoutpost/$id><i class='fa fa-shopping-cart'></i> Proceed to Checkout</a>
				      </div>";
		}


		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$getcast->castTitle."</h4>
				<p>Number of models for the cast: <strong>$getcount</strong></p>
				<p>Newly Added models: <strong>$val</strong></p>
				<p>Total Amount Paid: <strong>$Amount</strong></p>
				<p>New Amount: <strong>$newamount</strong></p>";


}else{
		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$getcast->castTitle."</h4>
				<p>Number of models for the cast: <strong>$getcount</strong></p>";
		$footer = "<div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			        <a type='button' class='btn btn-primary' href=/others/paycheckoutpost/$id><i class='fa fa-shopping-cart'></i> Proceed to Checkout</a>
			      </div>";
}

	$view .=	"<br>
					<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody>";
						foreach ($getuser as $key) {
							$getpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->first();
							if ($getpayment) {
								# code...
								if ($getpayment->status == 'inactive') {
									# code...
									$no += 1; 
									$user = User::find($key->user_id);
							$view .= "<tr>
										<td>$no</td>
										<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
									</tr>";
								}
							}else{

								$user = User::find($key->user_id);
								$no += 1;
							$view .= "<tr>
									<td>$no</td>
										<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
									<tr>";
							}
							# code...
						}
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";
     	 $view .= $footer;

			echo $view;
}

public function paycheckoutpost($id)
{
	$id = $id;
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
			# code...
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
	return $this->manage($id);
}

public function paycheckout($id)
{
	# code...
	$id = $id;
	$cast = $id;
	$user = Auth::user()->id;
	$getpaymentmethod = DB::table('casting')->where('id', '=', $id)->first();
	$updatecast = DB::table('casting')->where('id', '=', $id)->update(array('status' => 'finished'));
	$getcount = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();

		$getuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
		foreach ($getuser as $key) {
			# code...
			$modelacknolodgement = new modelacknolodgement;
			$modelacknolodgement->cast_id = $id;
			$modelacknolodgement->user_id = $key->user_id;
			$modelacknolodgement->status = 'active';
			$modelacknolodgement->save();
		}
	
	$amount = $getpaymentmethod->payDesc * $getcount;

	if ($getpaymentmethod->payType == 'paid') {
		$paidcast = new paidcast;
		$paidcast->cast_id = $id;
		$paidcast->user_id = Auth::user()->id;
		$paidcast->Amount = $amount;
		$paidcast->save();

		$checkout = new castcheckout;
		$checkout->cast_id = $id;
		$checkout->user_id = Auth::user()->id;
		$checkout->paidstatus = 'paid';
		$checkout->save();

		$castreceipt = new castreceipt;
		$castreceipt->cast_id = $id;
		$castreceipt->nomodels = $getcount;
		$castreceipt->amount = $amount;
		$castreceipt->save();
		$rec_id = $castreceipt->id;

		foreach ($getuser as $key) {

			$modelscastpayment = new modelscastpayment;
			$modelscastpayment->cast_id = $id;
			$modelscastpayment->user_id = $key->user_id;
			$modelscastpayment->rec_id = $rec_id;
			$modelscastpayment->amount = $getpaymentmethod->payDesc;
			$modelscastpayment->status = 'active';
			$modelscastpayment->save();

		}

	}else{
		$unpaidcast = new unpaidcast;
		$unpaidcast->cast_id = $id;
		$unpaidcast->user_id = Auth::user()->id;
		$unpaidcast->Amount = 'none';
		$unpaidcast->save();

		$checkout = new castcheckout;
		$checkout->cast_id = $id;
		$checkout->user_id = Auth::user()->id;
		$checkout->paidstatus = 'none';
		$checkout->save();
	}
	return $this->manage($id);
}

public function discardextform()
{
		
	$user = $_GET['user'];
	$cast = $_GET['cast'];
	$vals = $_GET['val'];

	$getcast = DB::table('casting')->where('id', '=', $cast)->first();

	$val = '';
    foreach ($user as $key => $value) {
	foreach ($value as $use) {
		$val .= $use;

		}
	}

	$pieces = explode($vals, $val);

	foreach ($pieces as $key => $users) {
		if (!empty($users)) {
		casttable::where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('castStatus' => 'discarded'));

		if ($getcast->payType == 'paid') {
			# code...
		
		if ($val = 'userscon') {
			# code...
			$getmodelcast = DB::table('modelscastpayment')->where('cast_id', '=', $cast)->where('user_id', '=', $users)->get();
			if ($getmodelcast) {
				# code...
			$uptmodelcast = DB::table('modelscastpayment')->where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('status' =>'inactive'));
			$updacknoledge = DB::table('modelacknolodgement')->where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('status'=> 'inactive'));
			}
		}

			# code...
		$getaccptcast = DB::table('modelsdeclinedaftcast')->where('cast_id', '=', $cast)->where('user_id', '=', $users)->get();

		if ($getaccptcast) {
		modelsdeclinedaftcast::where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('status' => 'no'));

			$insdeclinedaftcast = new modelsdeclinedaftcast;
			$insdeclinedaftcast->user_id = $users;
			$insdeclinedaftcast->cast_id = $cast;
			$insdeclinedaftcast->status = 'yes';
			$insdeclinedaftcast->save();
		}else{
			$insdeclinedaftcast = new modelsdeclinedaftcast;
			$insdeclinedaftcast->user_id = $users;
			$insdeclinedaftcast->cast_id = $cast;
			$insdeclinedaftcast->status = 'yes';
			$insdeclinedaftcast->save();
		}

				$dates = date('d-m-Y');
		$times = date('g:i A');

$notify = DB::table('notification')->where('name', '=', 'declinedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $users;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast;
		$upcoming->user_id = $users;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();


		}
		}
	}

	echo "<p class='bg-success' style='padding: 10px'>Discarded Successfully</p>";
}

public function discardform()
{
		
	$user = $_GET['user'];
	$cast = $_GET['cast'];
	$vals = $_GET['val'];

	$val = '';
    foreach ($user as $key => $value) {
	foreach ($value as $use) {
		$val .= $use;

		}
	}

	$pieces = explode($vals, $val);

	foreach ($pieces as $key => $users) {
		if (!empty($users)) {
		casttable::where('cast_id', '=', $cast)->where('user_id', '=', $users)->update(array('castStatus' => 'discarded'));

			# code...
				$dates = date('d-m-Y');
		$times = date('g:i A');

$notify = DB::table('notification')->where('name', '=', 'declinedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $users;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast;
		$upcoming->user_id = $users;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();


		
		}
	}

	echo "<p class='bg-success' style='padding: 10px'>Discarded Successfully</p>";
}

public function discardform2()
{
		$user = $_GET['user'];
	$cast = $_GET['cast'];
	$vals = $_GET['val'];
			if (!empty($user)) {
		jobtable::where('job_id', '=', $cast)->where('user_id', '=', $user)->update(array('jobStatus' => 'discarded'));
	}


	echo "<p class='bg-success' style='padding: 10px'>Discarded Successfully</p>";
}

public function getall()
{
	$id = $_GET['cast'];
	$getAllconfirm = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $id)->where('casttable.castStatus', '=', 'confirmed')->orderBy('casttable.id', 'DESC')->get();
$value = '';
if ($getAllconfirm) {
	# code...
	$getNum = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();
	if ($getNum > 8) {
		# code...
	foreach($getAllconfirm as $userdatacon){
	    							
	    						$value .= "<li><div class='well'>
	    								<div class='row'>
	    									<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
	    									<Input type='checkbox' name='users' value=".$userdatacon->user_id. ">
	    									
	    									</div>
	    									<div class='col-lg-7 col-sm-7 col-xs-11'>
	    										<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
	    										<div class='text-left'>
	    										<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->displayName."</a></p>
	    										<p>Height: ".$userdatacon->Height." / cm</p>
	    										<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
	    										</div>
	    									</div>
	    									<div class='col-lg-4'>
	    										
	    									</div>
	    								</div>
	    							</div></li>";
}
$num = $getNum/8;
$val = ceil($num);
$value = "<ul class='paginate' style='list-style-type:none'>
			$value
		  </ul>
		  <script type='text/javascript'>
	    $('.paginate').paginathing({
	    perPage: 8,
	    limitPagination: $val
		})
</script>";	
	}else{
		foreach($getAllconfirm as $userdatacon){
	    							
		$value .= "<div class='well'>
				<div class='row'>
					<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
					<Input type='checkbox' name='users' value=".$userdatacon->user_id. ">
					
					</div>
					<div class='col-lg-7 col-sm-7 col-xs-11'>
						<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
						<div class='text-left'>
						<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->displayName."</a></p>
						<p>Height: ".$userdatacon->Height." / cm</p>
						<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
						</div>
					</div>
					<div class='col-lg-4'>
						
					</div>
				</div>
			</div>";
}
	}
	

}else{
$value = '';
}
echo $value;
}

public function getall2()
{
	$id = $_GET['cast'];
	$getAllconfirm = DB::table('jobtable')->Join('photoupload', 'jobtable.user_id', '=', 'photoupload.user_id')->Join('others', 'jobtable.user_id', '=', 'others.user_id')->where('jobtable.job_id', '=', $id)->where('jobtable.jobStatus', '=', 'confirmed')->orderBy('jobtable.id', 'DESC')->get();
$value = '';
if ($getAllconfirm) {
	# code...
		foreach($getAllconfirm as $userdatacon){
	    							
		$value .= "<div class='well'>
				<div class='row'>
					<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
					<Input type='radio' name='users' value=".$userdatacon->user_id. ">
					
					</div>
					<div class='col-lg-7 col-sm-7 col-xs-11'>
						<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left img-responsive'>
						<div class='text-left'>
						<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->agentName."</a></p>
						<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
						</div>
					</div>
					<div class='col-lg-4'>
						
					</div>
				</div>
			</div>";
}
	
	

}else{
$value = '';
}
echo $value;
}

public function getdisc2()
{
	$id = $_GET['cast'];
	$getAlldiscarded = DB::table('jobtable')->Join('photoupload', 'jobtable.user_id', '=', 'photoupload.user_id')->Join('others', 'jobtable.user_id', '=', 'others.user_id')->where('jobtable.job_id', '=', $id)->where('jobtable.jobStatus', '=', 'discarded')->orderBy('jobtable.id', 'DESC')->get();
$value = '';
if ($getAlldiscarded) {
	# code...
	foreach($getAlldiscarded as $userdatacon){
	    							
	    						$value .= "<div class='well'>
	    								<div class='row'>
	    									<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
	    									<Input type='radio' name='users' value=".$userdatacon->user_id. ">
	    									
	    									</div>
	    									<div class='col-lg-7 col-sm-7 col-xs-11'>
	    										<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
	    										<div class='text-left'>
	    										<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->agentName."</a></p>
	    										<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
	    										</div>
	    									</div>
	    									<div class='col-lg-4'>
	    										
	    									</div>
	    								</div>
	    							</div>";
}
	
	

}else{
$value = '';
}
echo $value;
}

public function getdisc()
{
	$id = $_GET['cast'];
	$getAlldiscarded = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $id)->where('casttable.castStatus', '=', 'discarded')->orderBy('casttable.id', 'DESC')->get();
$value = '';
if ($getAlldiscarded) {
	# code...
	$getNum = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'discarded')->count();
	if ($getNum > 8) {
		# code...
	foreach($getAlldiscarded as $userdatacon){
	    							
	    						$value .= "<li><div class='well'>
	    								<div class='row'>
	    									<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
	    									<Input type='checkbox' name='users' value=".$userdatacon->user_id. ">
	    									
	    									</div>
	    									<div class='col-lg-7 col-sm-7 col-xs-11'>
	    										<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
	    										<div class='text-left'>
	    										<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->displayName."</a></p>
	    										<p>Height: ".$userdatacon->Height." / cm</p>
	    										<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
	    										</div>
	    									</div>
	    									<div class='col-lg-4'>
	    										
	    									</div>
	    								</div>
	    							</div></li>";
}
$num = $getNum/8;
$val = ceil($num);
$value = "<ul class='paginate' style='list-style-type:none'>
			$value
		  </ul>
		  <script type='text/javascript'>
	    $('.paginate').paginathing({
	    perPage: 8,
	    limitPagination: $val
		})
</script>";	
	}else{
		foreach($getAlldiscarded as $userdatacon){
	    							
		$value .= "<div class='well'>
				<div class='row'>
					<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
					<Input type='checkbox' name='users' value=".$userdatacon->user_id. ">
					
					</div>
					<div class='col-lg-7 col-sm-7 col-xs-11'>
						<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
						<div class='text-left'>
						<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->displayName."</a></p>
						<p>Height: ".$userdatacon->Height." / cm</p>
						<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
						</div>
					</div>
					<div class='col-lg-4'>
						
					</div>
				</div>
			</div>";
}
	}
	

}else{
$value = '';
}
echo $value;
}

public function getapplicant()
{
	# code...
	$cast = $_GET['cast'];
	$getAllUser = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $cast)->where('casttable.castStatus', '=', '')->where('casttable.castRequest', '=', 'request')->get();

		$value = '';
if ($getAllUser) {
	# code...
	$getNum = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'discarded')->count();
	if ($getNum > 8) {
		# code...
	foreach($getAllUser as $userdatacon){
	    							
	    						$value .= "<li><div class='well'>
	    								<div class='row'>
	    									<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
	    									<Input type='checkbox' name='users' value=".$userdatacon->user_id. ">
	    									
	    									</div>
	    									<div class='col-lg-7 col-sm-7 col-xs-11'>
	    										<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
	    										<div class='text-left'>
	    										<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->displayName."</a></p>
	    										<p>Height: ".$userdatacon->Height." / cm</p>
	    										<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
	    										</div>
	    									</div>
	    									<div class='col-lg-4'>
	    										
	    									</div>
	    								</div>
	    							</div></li>";
}
$num = $getNum/8;
$val = ceil($num);
$value = "<ul class='paginate' style='list-style-type:none'>
			$value
		  </ul><script type='text/javascript>
	    $('.paginate').paginathing({
	    perPage: 5,
	    limitPagination: $val
		})
</script>";	
	}else{
		foreach($getAllUser as $userdatacon){
	    							
		$value .= "<div class='well'>
				<div class='row'>
					<div class='col-lg-1 col-sm-1 col-xs-1' style='background-color:'>
					<Input type='checkbox' name='users' value=".$userdatacon->user_id. ">
					
					</div>
					<div class='col-lg-7 col-sm-7 col-xs-11'>
						<img src=/".$userdatacon->imagename." width='130px' Height='160px' class='img-left'>
						<div class='text-left'>
						<p><a href=/models/profile/$userdatacon->user_id>".$userdatacon->displayName."</a></p>
						<p>Height: ".$userdatacon->Height." / cm</p>
						<p><strong><span class='glyphicon glyphicon-map-marker'></span></strong> ".$userdatacon->location."</p>
						</div>
					</div>
					<div class='col-lg-4'>
						
					</div>
				</div>
			</div>";
}
	}
	

}else{
$value = '';
}
echo $value;

}

public function showprofile($id)
{
	$btnfols = '';
	$user = User::find($id);
	$user_type = $user->user_type;
	switch ($user_type) {
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
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

$images = DB::table('imagegallery')->where('user_id', '=', $id)->get();
$viewimg = '';


if(isset($images)){

	if (isset(Auth::user()->id)) {
	# code...
		$getnotifyunseen = $this->getunseen();
		$user = User::find(Auth::user()->id);

	$user_id = Auth::user()->id;
		$checkplan = $this->checkplan($user_id);
$getmymodels = DB::table('mymodel')->where(function($query) use ($id, $user_id){
			$query
			->where('agent_id', '=', $id)
    		->where('model_id', '=', $user_id);				
			})->where(function($query1){
			$query1
			->where('status', '=', 'pending')
    		->orwhere('status', '=', 'active');				
			})->count();

			$btnfol = castfollowers::where('follower', '=', $user_id)->where('following', '=', $id)->count();

	if ($btnfol < 1) {
		$btnfols = '2';
	}else{
		$btnfols = '1';
	}


	foreach($images as $image){
$getimg = DB::table('imagelike')->where('imageid', '=', $image->id)->where('sender_id', '=', Auth::user()->id)->get();
$imgcount = DB::table('imagelike')->where('imageid', '=', $image->id)->count();
if ($getimg) {
	# code...
$viewimg .= "<div id='caption$image->id' style='display:none'>
				<div id=pix$image->id><button class='btn btn-xs btn-primary unlikepix' id=$image->id><i class='fa fa-check'></i>($imgcount) Liked</bottun></div>
			  </div>";
		# code...
	}else{
$viewimg .= "<div id='caption$image->id' style='display:none'>
				<div id=pix$image->id><button id=$image->id class='btn btn-xs btn-primary likepix'><i class='fa fa-check'></i>($imgcount) Like image</bottun></div>
			  </div>";
		# code...
	}
}

$viewimg  .="<div class='demo-gallery' style='width: auto; position: relative'>
            <div id='captions' class='list-unstyled row grid'>";
			foreach($images as $image){
$viewimg  .= "<div class='grid-item' data-responsive=/$image->imagename data-src=/$image->imagename data-sub-html=#caption$image->id >
                    <a href>
                        <img src=/$image->imagename width=185px>
                    </a>
                	</div>";
			}
$viewimg   .=  "</div>
            </div>";
}else{
	$viewimg  .="<div class='demo-gallery' style='width: auto; position: relative'>
            <div id='captions' class='list-unstyled row grid'>";
			foreach($images as $image){
$viewimg  .= "<div class='grid-item' data-responsive=/$image->imagename data-src=/$image->imagename data-sub-html=#caption$image->id style='margin-bottom: 5px'>
                    <a href>
                        <img src=/$image->imagename width=185px>
                    </a>
                	</div>";
			}
$viewimg   .=  "</div>
            </div>";
}
}
		
		$id = $id;
		
		$user = User::find($id);
		$getgallery = DB::table('imagegallery')->where('user_id', '=', $id)->get();

		$userDtl = DB::table('users')->where('users.id', '=', $id)->Join('others', 'users.id', '=', 'others.user_id')->get();
		$gallery = DB::table('photoupload')->where('photoupload.user_id',  '=', $id)->get();
		$profileimg = DB::table('photoupload')->where('user_id', '=', $id)->where('image_type', '=', 'profileImage')->get();
	$getprofession = DB::table('industryprofessional')->get();
		
		return View::make('others/showprofile')->with(compact('user', 'btnfols', 'getnotifyunseen', 'userDtl', 'profileimg', 'user_type_spec', 'getgallery', 'gallery', 'id', 'getmymodels', 'checkplan', 'viewimg', 'id', 'getprofession'));
}
public function showcastdetail($id)
{
	$id = $id;
	$castdtl = DB::table('casting')->where('id', '=', $id)->get();
	$btn = '';

	foreach($castdtl as $cast){
	$daycast = $cast->Daycast;
	$monthcast = $cast->Monthcast;
	$yearcast = $cast->Yearcast;
	$day = $cast->DayExp;
	$month = $cast->MonthExp;
	$year = $cast->YearExp;
	$castcat = $cast->castCat;
	}

	$getcat = DB::table('disciplines')->where('id', '=', $castcat)->first();

	$date1 = strtotime("$yearcast-$monthcast-$daycast");	
	$datecast = date('l, j F Y', $date1);

	$date = strtotime("$year-$month-$day");
	$closedate = date('l, j F Y', $date);

	if (isset(Auth::user()->id)) {
		# code...
	$getapply = DB::table('casttable')->where('cast_id', '=', $id)->where('user_id', '=', Auth::user()->id)->get();
	if(Auth::user()->user_type == 'proModel' || Auth::user()->user_type == 'newFace'){

		$years = date('Y');
		$months = date('m');
		$days = date('d');
		$daycasts = $day;
		$monthcasts = $month;
		$yearcasts = $year;

		if ($years == $yearcasts){
			if ($months == $monthcasts) {
				if ($days > $daycasts){
					$btn = '';
				}else{

        $btn = $this->applyverify($id);

				}
			}
			elseif ($months < $monthcasts) {
				

        $btn = $this->applyverify($id);

			}

		}elseif($yearcasts > $years) {

        $btn = $this->applyverify($id);
		}else{
			$btn = '';
		}

	}else{
		$btn = '';
	}
	}else{
		$btn = "<a href='/signup' class='btn btn-primary btn-md'>signin or signup to apply</a>";		
	}

	if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

			$cast = DB::table('casting')->where('id', '=', $id)->first();
			$user = Others::where('user_id', '=', $cast->user_id)->first();

	return View::make('others/showcastdetail')->with(compact('castdtl', 'closedate', 'getcat', 'getnotifyunseen', 'btn', 'user', 'id', 'datecast', 'getbtn'));
}

public function updatedetails()
{
	$user = User::find(Auth::user()->id);

	parse_str($_GET['user'], $formdata);
	$agentName = $formdata['agentName'];
	$CAC = $formdata['CAC'];
	$Website = $formdata['Website'];
	$address = $formdata['address'];
	$telephone = $formdata['telephone'];
	$landline = $formdata['landline'];
	$chairmanname = $formdata['chairmanname'];
	$chairmantel = $formdata['chairmantel'];
	$chairmanemail = $formdata['chairmanemail'];
	$aboutus = $formdata['aboutus'];

	$others = Others::where('user_id', '=', $user->id)->update(array('agentName' => $agentName,
		'CAC' => $CAC,
		'Website' => $Website,
		'address' => $address,
		'telephone' => $telephone,
		'landline' => $landline,
		'chairmanname' => $chairmanname,
		'chairmantel' => $chairmantel,
		'chairmanemail' => $chairmanemail,
		'aboutus' => $aboutus		
		));	

	echo "Profile Updated successfully";
}

public function editcast()
{
	$user = User::find(Auth::user()->id);

	$cast = $_GET['cast'];
	parse_str($_GET['user'], $formdata);
	$selType = $formdata['selType'];
	$selCat = $formdata['selCat'];

		# code...

		$selectdistable = DB::table('castdisciplines')->where('castId', '=', $cast)->count();
		if ($selectdistable > 0) {
			# code...
			$selectdis = DB::table('castdisciplines')->where('castId', '=', $cast)->update(array('discId' => $selCat));
		}else{
			$castdisciplines = new castdisciplines;
			$castdisciplines->castId = $cast;
			$castdisciplines->discId = $selCat;
			$castdisciplines->save();
		}
		# code...
		$cats = $_GET['cats'];

		$selectdistable = DB::table('castingtype')->where('castId', '=', $cast)->count();
		if ($selectdistable > 0) {
			# code...
			$selectdis = DB::table('castingtype')->where('castId', '=', $cast)->update(array('castType' => $selType));
		}else{
			$castingtype = new castingtype;
			$castingtype->castId = $cast;
			$castingtype->castType = $selType;
			$castingtype->save();
		}

	
	$gender = $formdata['gender'];
	$heightFrom = $formdata['heightFrom'];
	$heightTo = $formdata['heightTo'];
	$bust_min = $formdata['chestbustFrom'];
	$bust_max = $formdata['chestbustTo'];
	$waist_min = $formdata['waistFrom'];
	$waist_max = $formdata['waistTo'];
	$hips_min = $formdata['hipsFrom'];
	$hips_max = $formdata['hipsTo'];
	$dress_min = $formdata['dressFrom'];
	$dress_max = $formdata['dressTo'];
	$jacket_min = $formdata['jacketFrom'];
	$jacket_max = $formdata['jacketTo'];
	$trousers_min = $formdata['trousersFrom'];
	$trousers_max = $formdata['trousersTo'];
	$collar_min = $formdata['collarFrom'];
	$collar_max = $formdata['collarTo'];
	$shoes_min = $formdata['shoesFrom'];
	$shoes_max = $formdata['shoesTo'];
	$eyes = $formdata['eyes'];
	$ageTo = $formdata['ageTo'];
	$ageFrom = $formdata['ageFrom'];
	$hair_color = $formdata['hair_color'];
	$ethnicity = $formdata['ethnicity'];
	$languages = $formdata['languages'];
	$complexion = $formdata['complexion'];
	$butt = $formdata['butt'];
	$hairtype = $formdata['hair_type'];
	$qualification = $formdata['qualification'];

	$preferences = DB::table('preferences')->get();

	$cstupdt = DB::table('casting')->where('id', '=', $cast)->update(array('gender' => $gender));

	$selectCast = DB::table('castpreference')->where('castId', '=', $cast)->count();
	if ($selectCast > 0) {
		# code...
		$inputCast = DB::table('castpreference')->where('castId', '=', $cast)->update(array('chestbustFrom' => $bust_min, 'chestbustTo' => $bust_max, 
			'waistFrom' => $waist_min, 'waistTo' => $waist_max, 'hipsFrom' => $hips_min, 'hipsTo' => $hips_max, 'dressFrom' => $dress_min, 'dressTo' => $dress_max, 'jacketFrom' => $jacket_min, 'jacketTo' => $jacket_max, 'trousersFrom' => $trousers_min, 'trousersTo' => $trousers_max, 'collarFrom' => $collar_min, 'collarTo' => $collar_max, 'shoesFrom' => $shoes_min, 'shoesTo' => $shoes_max, 'heightFrom' => $heightFrom, 'heightTo' => $heightTo, 'ageTo' => $ageTo, 'ageFrom' => $ageFrom, 'eyes' => $eyes, 'hair_color' => $hair_color, 'ethnicity' => $ethnicity, 'languages' => $languages, 'complexion' => $complexion, 'butt' => $butt, 'hair_type' => $hairtype, 'qualification' => $qualification));
	}else{

		$castprefsave = new castpreference;
			$castprefsave->prefId = '1';
			$castprefsave->castId = $cast;
			$castprefsave->chestbustFrom = $bust_min;
			$castprefsave->chestbustTo = $bust_max;
			$castprefsave->waistFrom = $waist_min;
			$castprefsave->waistTo = $waist_max;
			$castprefsave->hipsFrom = $hips_min;
			$castprefsave->hipsTo = $hips_max;
			$castprefsave->dressFrom = $dress_min;
			$castprefsave->dressTo = $dress_max;
			$castprefsave->jacketFrom = $jacket_min;
			$castprefsave->jacketTo = $jacket_max;
			$castprefsave->trousersFrom = $trousers_min;
			$castprefsave->trousersTo = $trousers_max;
			$castprefsave->collarFrom = $collar_min;
			$castprefsave->collarTo = $collar_max;
			$castprefsave->shoesFrom = $shoes_min;
			$castprefsave->shoesTo = $shoes_max;
			$castprefsave->heightFrom = $heightFrom;
			$castprefsave->heightTo = $heightTo;
			$castprefsave->ageFrom = $ageFrom;
			$castprefsave->ageTo = $ageTo;
			$castprefsave->eyes = $eyes;
			$castprefsave->hair_color = $hair_color;
			$castprefsave->ethnicity = $ethnicity;
			$castprefsave->languages = $languages;
			$castprefsave->complexion = $complexion;
			$castprefsave->butt = $butt;
			$castprefsave->hair_type = $hairtype;
			$castprefsave->qualification = $qualification;
			$castprefsave->save();

	}
	
	echo "it worked";

}

public function plan()
{
	return View::make('others/plan');
}

public function category()
{
	$Discipline = DB::table('disciplines')->get();
	$getnotifyunseen = $this->getunseen();
	return View::make('others/category')->with(compact('Discipline', 'getnotifyunseen'));
}
public function insertcategory()
{
	$catlist = Input::get('cat');
	$user = Auth::user()->id;

	for ($i = 0; $i < count($catlist); ++$i) {


		$add = distable::create(array('user_id' => $user, 'dis_id' => $catlist[$i] ));		
    }
}

public function mymodels()
{
	# code...
	$user_id = Auth::user()->id;
	$user = User::find(Auth::user()->id);
	$getmymodels = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('status', '=', 'active')->get();
	$getmodelpending = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('status', '=', 'pending')->get();

//to get pending models
	$view = "<div class='row'><br>";
	foreach ($getmodelpending as $key) {
		# code...
	$user = User::find($key->model_id);
$view .="<div class='col-lg-3 col-xs-12 col-sm-3 thumbnail style='height: 180px; margin-right: 10px' id=acpt".$key->model_id.">
			<div class='row'>
			<div class='col-lg-5 col-sm-12 col-xs-5 text-right'>";
				if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('class' => 'img img-responsive', 'width' => '80px', 'height' => '80px'));
							        }
				        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('class' => 'img img-responsive', 'width' => '50px', 'height' => '80px'));
						}
$view	.=	"</div>
				<div class='col-lg-7 col-sm-12 col-xs-5 text-left'>
				<a href=/models/profile/".$key->model_id." ><strong>".$user->NewModel->displayName."</strong></a>";
$view .="<button class='btn btn-success btn-xs acceptuser' id=".$key->model_id.">Accept</button>
			<button class='btn btn-danger btn-xs declineuser' id=".$key->model_id.">Decline</button>	
		 </div>
		 </div>
		 </div>";
	}
$view .= "</div><br>";

//to get models
$views = '';
$views = "<div class='row' ><br>";
	foreach ($getmymodels as $key) {
		# code...
	$user = User::find($key->model_id);
$views .="<div class='col-lg-3 col-xs-12 col-sm-3 thumbnail' style='height: 180px; margin-right: 10px' id=acpt".$key->model_id.">
			<div class='row'>
			<div class='col-lg-5 col-sm-12 col-xs-5 text-right'>";
				if(!empty($user->photoupload->imagename)){
							 $views .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('class' => 'img img-responsive', 'width' => '70px', 'height' => '70px'));
							        }
				        else{
							$views .= $image = HTML::image('img/photo.jpg', 'profile picture', array('class' => 'img img-responsive', 'width' => '50px', 'height' => '80px'));
						}
$views	.=	"</div>
				<div class='col-lg-7 col-sm-12 col-xs-5 text-left'>
				<a href=/models/profile/".$key->model_id." ><strong>".$user->NewModel->displayName."</strong></a><br>";
$views .="<button class='btn btn-primary btn-xs bookmodel' data-toggle='modal' data-target='#exampleModal3' id=".$key->model_id.">
				Book model
			</button>
			<button class='btn btn-primary btn-xs exist' data-toggle='modal' data-target='#exampleModal' id=$key->model_id>
							link existing cast
						</button>
			<button class='btn btn-danger btn-xs declineopt' id=".$key->model_id.">Decline</button>	
		 </div>
		 </div>
		 </div>";
	}
$views .= "</div>
			<br>";

	$user = User::find(Auth::user()->id);
	$getnotifyunseen = $this->getunseen();
	return View::make('others.mymodel')->with(compact('user', 'getnotifyunseen', 'getmymodels', 'view', 'views'));
}

public function checkplan($id)
{
	# code...
	$user_id = Auth::user()->id;
	$value = '';
	$getplan = DB::table('usersplan')->where('user_id', '=', $user_id)->where('status', '=', 'active')->first();
	if ($getplan) {
		# code...
		if ($getplan->plan_id == 2) {
			# code...
			$value = 'true';
		}elseif ($getplan->plan_id == 3) {
			# code...
			$value = 'true';
		}else{
			$value = '';
		}
	}else{
		$value = '';
	}
	return $value;
}

public function contactothers()
{
	# code...
	$id = $_GET['id'];
	$user_id = Auth::user()->id;

	$getmymodels = DB::table('mymodel')->where('agent_id', '=', $id)->where('model_id', '=', $user_id)->where(function($query1){
			$query1
			->where('status', '=', 'pending')
    		->orwhere('status', '=', 'active');				
			})->get();

	if ($getmymodels) {
		# code...

	}else{
	$mymodel = new mymodel;
	$mymodel->agent_id = $id;
	$mymodel->model_id = $user_id;
	$mymodel->status = 'pending';
	$mymodel->save();
	}

	echo "<li>Contacted <span class='text-right glyphicon glyphicon-play'></span></li>";
}
public function mymodelaccept()
{
	# code...
	$id = $_GET['id'];
	$user_id = $user_id = Auth::user()->id;

	$update = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('model_id', '=', $id)->get();
	if ($update) {
		# code...
			$update = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('model_id', '=', $id)->update(array('status' => 'active'));
	}
}
public function mymodeldecline()
{
	# code...
	$id = $_GET['id'];
	$user_id = $user_id = Auth::user()->id;

	$update = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('model_id', '=', $id)->get();
	if ($update) {
		# code...
			$update = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('model_id', '=', $id)->delete();
	}	
}

public function mymodelbook()
{
	# code...
	$user_id = $_GET['id'];

	$value = '';
echo "<input type='hidden' name='modelid' id='modelid' value=".$user_id.">";
}

public function sendcast()
{
	$modelid = $_GET['modelid'];
	parse_str($_GET['cast'], $formdata);
	$title = $formdata['title'];
	$casting = $formdata['casting'];
	$paymethod = $formdata['paymethod'];
	$paydetail = $formdata['paydetail'];
	$country = $formdata['country'];
	$location = $formdata['location'];
	$city = $formdata['town'];
	$Daycast = $formdata['Daycast'];
	$Monthcast = $formdata['Monthcast'];
	$Yearcast = $formdata['Yearcast'];
	$Dayend = $formdata['Dayend'];
	$Monthend = $formdata['Monthend'];
	$Yearend = $formdata['Yearend'];
	# code...

	$others = new Casting;
		$others->user_id = $modelid;
		$others->castTitle = $title;		
		$others->castDescription = $casting;
		$others->payType = $paymethod;
		$others->payDesc = $paydetail;
		$others->country = $country;
		$others->location = $location;
		$others->area = $city;
		$others->Daycast = $Daycast;
		$others->Monthcast = $Monthcast;
		$others->Yearcast = $Yearcast;
		$others->Dayend = $Dayend;
		$others->Monthend = $Monthend;
		$others->Yearend = $Yearend;
		$others->status = 'pending';
		$others->visibility = 'none';
		$others->save();

		$cast_id = $others->id;

		$affectedRows = new casttable;
    	$affectedRows->cast_id = $cast_id;
    	$affectedRows->user_id = $modelid;
    	$affectedRows->castMethod = 'invited';
    	$affectedRows->save();

}

public function getdatainvite()
{
	# code...
	$val = $_GET['val'];
	$user_id = Auth::user()->id;
	$view = '';

	if ($val == 'contacted') {
		# code...
		$getinvite = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('status', '=', 'active')->get();
		
		foreach ($getinvite as $key) {
		# code...
	$view .=	"<div id='invchck'>
    					<div class='col-lg-2 col-sm-3 col-md-3 thumbnail-image' style='margin-bottom: 5px'>
    						<div class='checkbx'>
    						<input type = 'checkbox' name='invite' value=".$key->model_id."></div>";
    						$user = User::find($key->model_id);
    						if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px'));
									}
    	$view	.=		"</div>
    					</div>";
    }

	}elseif ($val == 'favorite') {
		# code...
		$getinvite = DB::table('castfollowers')->where('follower', '=', $user_id)->get();
		foreach ($getinvite as $key) {
		# code...
	$uses = User::find($key->following);
	$view .=	"<div id='invchck'>
    					<div class='col-lg-2 col-sm-3 col-md-3 thumbnail-image' style='margin-bottom: 5px'>
    						<div class='checkbx'>
    						<input type = 'checkbox' name='invite' value=".$key->following."></div>";
    						$user = User::find($key->following);
    						if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px'));
									}
    	$view	.=		"</div>
    					</div>";
    }
	}elseif ($val == 'all') {
		# code...

		$getinvite = DB::table('mymodel')->where('agent_id', '=', $user_id)->where('status', '=', 'active')->get();

		$getinvite2 = DB::table('castfollowers')->where('follower', '=', $user_id)->get();
		
		foreach ($getinvite as $key) {
		# code...
	$view .=	"<div id='invchck'>
    					<div class='col-lg-2 col-sm-3 col-md-3 thumbnail-image' style='margin-bottom: 5px'>
    						<div class='checkbx'>
    						<input type = 'checkbox' name='invite' value=".$key->model_id."></div>";
    						$user = User::find($key->model_id);
    						if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px'));
									}
    	$view	.=		"</div>
    					</div>";
    }

    foreach ($getinvite2 as $key) {
		# code...
	$view .=	"<div id='invchck'>
    					<div class='col-lg-2 col-sm-3 col-md-3 thumbnail-image' style='margin-bottom: 5px'>
    						<div class='checkbx'>
    						<input type = 'checkbox' name='invite' value=".$key->following."></div>";
    						$user = User::find($key->following);
    						if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px'));
									}
    	$view	.=		"</div>
    					</div>";
    }

	}

	echo $view;


}

public function sendinvitation()
{
		$catlist = $_GET['invite'];
		$cast_id = $_GET['cast_ids'];

		$val = '';
		$val2 = '';
			foreach ($catlist as $key => $value) {
		foreach ($value as $cat ) {
		
		$val .= $cat;

		}
	}

	$pieces = explode("invite", $val);
		$vals = $pieces;
			# code...
		foreach ($pieces as $keys => $value) {

			$val2 = $value;

		$castmethod = "invited";
		$getval = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $val2)->where('castRequest','=', 'request')->get();

		if (!empty($val2)) {

			$chckinv = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $val2)->where('castMethod', '=', $castmethod)->count();
			if ($chckinv < 1) {
				# code...
				if ($getval) {
			# code...
			$insertVal = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $val2)->where('castRequest','=', 'request')->update(array('castStatus' => 'confirmed'));
			$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $val2;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast_id;
		$upcoming->user_id = $val2;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

		$dates = date('d-m-Y');
		}else{
		$add = casttable::create(array('cast_id' => $cast_id, 'user_id' => $val2, 'castMethod' => $castmethod ));

		$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'castinvitation')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $val2;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $cast_id;
		$upcoming->user_id = $val2;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

		$dates = date('d-m-Y');
		}
			}
		
		}
	}

	

	echo "<div class='col-lg-2 col-xs-12'>
    		<h5 class='bg-primary' style='padding: 7px'>models invited</h5>					
    	</div>";

}

public function servicemktplace()
{
	$user = User::find(Auth::user()->id);
	$getservice = DB::table('otherprofessional')->get();

	$getmarketplace = DB::table('servicemarketplace')->where('user_id', '=', Auth::user()->id)->get();
	$getnotifyunseen = $this->getunseen();
	$verification = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();

	return View::make('others.servicemktplace')->with(compact('user', 'getnotifyunseen', 'getmarketplace', 'getservice', 'verification'));
}

public function createservice()
{
	$data = Input::all();
	$user = User::find(Auth::user()->id);

		$validator = Validator::make($data, servicemarketplace::$others_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

	if(Input::hasFile('image')){		
		$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/serviceimage/' . $filename);
			Image::make($image->getRealPath())->save($path);
			$imageName = 'img/serviceimage/'.$filename;
		}else{
			$imageName = ""; 
		}

		$user_id = Auth::user()->id;
		$date = Input::get('Year')."-".Input::get('Month')."-".Input::get('Day');

		$servicemarketplace = new servicemarketplace;
		$servicemarketplace->user_id = $user_id;
		$servicemarketplace->name = Input::get('title');
		$servicemarketplace->description = Input::get('description');
		$servicemarketplace->duration = Input::get('duration');
		$servicemarketplace->date = $date;
		$servicemarketplace->country = Input::get('country');
		$servicemarketplace->location = Input::get('location');
		$servicemarketplace->city = Input::get('town');
		$servicemarketplace->image = $imageName;
		$servicemarketplace->price = Input::get('price');
		$servicemarketplace->discount = Input::get('discount');
		$servicemarketplace->service = Input::get('service');
		$servicemarketplace->status = 'pending';
		$servicemarketplace->save();


		return Redirect::to('others/servicesadded');
}

public function servicesadded()
{
	$user = User::find(Auth::user()->id);
		$getnotifyunseen = $this->getunseen();
	return View::make('others/servicesadded')->with(compact('user', 'getnotifyunseen'));
}

public function userType($value)
{
	# code...
	$user = User::find($value);
	$user_type = $user->user_type;
	switch ($user_type) {
		case 'proModel':
			$user_type_spec = 'Professional model';
			break;
		case 'newFace':
			$user_type_spec = 'New Face (aspiring model)';
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
		$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', $value)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

	return $user_type_spec;
}

public function getProfile($id)
{
	# code...
	$user = User::find($id);

		switch ($user->user_type) {
				case 'proModel':
					$url = "/models/profile/".$id;
					break;
				case 'newFace':
					$url = "/models/profile/".$id;
					break;
				case 'photo':
					$url = "/others/showprofile/".$id;
					break;
				case 'agent':
					$url = "/others/showprofile/".$id;
					break;
				case 'artist':
					$url = "/others/showprofile/".$id;
					break;
				case 'fashion':
					$url = "/others/showprofile/".$id;
					break;
				case 'tattoo':
					$url = "/others/showprofile/".$id;
					break;
				case 'others':
					$url = "/others/showprofile/".$id;
					break;
			}

	return $url;
}

public function servicemgt($value, $id)
{
	$user = User::find(Auth::user()->id);
	$id = $id;
	$view = '';
	$value = $value;

	if ($value == 'service') {
		$getbooked = DB::table('bookservice')->where('serviceid', '=', $id)->get();

	}elseif ($value == 'Photosession') {
		$getbooked = DB::table('bookphotosession')->where('photoid', '=', $id)->get();
	}elseif ($value == 'courses') {
		$getbooked = DB::table('bookcourse')->where('coursesid', '=', $id)->get();
	}

	
	if ($getbooked) {
		# code...
		foreach ($getbooked as $key) {
		$users = User::find($key->user_id);
		$userType = $this->userType($key->user_id);
		$getProfile = $this->getProfile($key->user_id);
		
		if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
				$location = $users->Others->location;
			}else{
				$name = $users->NewModel->displayName;
				$location = $users->NewModel->location;
			}



	$view .="<div class='col-lg-3 col-sm-3'>";
					if(!empty($users->photoupload->imagename)){
			 $view .=  $image = HTML::image($users->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
			        }
			        else{
			$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px'));
					}
	$view .= "</div>
				<div class='col-lg-4 col-sm-4'>
					<br>
					<p><strong>Name: </strong>".$name."</p>
					<p><strong>User type: </strong>".$userType."</p>
					<p><strong>Location: </strong>".$location."</p>
				</div>
				<div class='col-lg-5 col-sm-5 text-left'>
					<br>
					<br>
					<a class='btn btn-primary' href=".$getProfile.">View Profile</a>
				</div>
			 		<br>";		
		}
	}else{
		$view .= "<br>
				  <br>
					<h2>Non Applied Yet</h2>";
	}
		# code...
		$getnotifyunseen = $this->getunseen();
		return View::make('others.servicemgt')->with(compact('user', 'getnotifyunseen', 'id', 'view'));
	
}
public function getphotosession()
{
	
	$user = User::find(Auth::user()->id);
	$getservice = DB::table('otherprofessional')->get();

	$getmarketplace = DB::table('photosession')->where('user_id', '=', Auth::user()->id)->get();
	$getnotifyunseen = $this->getunseen();

	return View::make('others.getphotosession')->with(compact('user', 'getnotifyunseen', 'getmarketplace', 'getservice'));
}

public function coursespage()
{
	
	$user = User::find(Auth::user()->id);
	$getservice = DB::table('otherprofessional')->get();

	$getmarketplace = DB::table('courses')->where('user_id', '=', Auth::user()->id)->get();
	$getnotifyunseen = $this->getunseen();

	return View::make('others.coursespage')->with(compact('user', 'getnotifyunseen', 'getmarketplace', 'getservice'));
}

public function createphotosession()
{
	$data = Input::all();
	$user = User::find(Auth::user()->id);

		$validator = Validator::make($data, photosession::$others_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

	if(Input::hasFile('image')){		
		$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/serviceimage/' . $filename);
			Image::make($image->getRealPath())->save($path);
			$imageName = 'img/serviceimage/'.$filename;
		}else{
			$imageName = ""; 
		}

		$user_id = Auth::user()->id;

		$date = Input::get('Year')."-".Input::get('Month')."-".Input::get('Day');

		$servicemarketplace = new photosession;
		$servicemarketplace->user_id = $user_id;
		$servicemarketplace->title = Input::get('title');
		$servicemarketplace->description = Input::get('description');
		$servicemarketplace->date = $date;
		$servicemarketplace->country = Input::get('country');
		$servicemarketplace->location = Input::get('location');
		$servicemarketplace->city = Input::get('town');
		$servicemarketplace->image = $imageName;
		$servicemarketplace->price = Input::get('price');
		$servicemarketplace->discount = Input::get('discount');
		$servicemarketplace->duration = Input::get('duration');
		$servicemarketplace->service = Input::get('service');
		$servicemarketplace->venue = Input::get('venue');
		$servicemarketplace->status = 'pending';
		$servicemarketplace->save();


		return Redirect::to('others/photoadded');
}

	public function photoadded()
	{
	$user = User::find(Auth::user()->id);
		$getnotifyunseen = $this->getunseen();
	return View::make('others/photoadded')->with(compact('user', 'getnotifyunseen'));
	}

public function createcourses()
{
	$data = Input::all();
	$user = User::find(Auth::user()->id);

		$validator = Validator::make($data, courses::$others_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

	if(Input::hasFile('image')){		
		$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/serviceimage/' . $filename);
			Image::make($image->getRealPath())->save($path);
			$imageName = 'img/serviceimage/'.$filename;
		}else{
			$imageName = ""; 
		}

		$user_id = Auth::user()->id;

		$date = Input::get('Year')."-".Input::get('Month')."-".Input::get('Day');

		$servicemarketplace = new courses;
		$servicemarketplace->user_id = $user_id;
		$servicemarketplace->title = Input::get('title');
		$servicemarketplace->description = Input::get('description');
		$servicemarketplace->date = $date;
		$servicemarketplace->country = Input::get('country');
		$servicemarketplace->location = Input::get('location');
		$servicemarketplace->city = Input::get('town');
		$servicemarketplace->image = $imageName;
		$servicemarketplace->price = Input::get('price');
		$servicemarketplace->discount = Input::get('discount');
		$servicemarketplace->duration = Input::get('duration');
		$servicemarketplace->service = Input::get('service');
		$servicemarketplace->venue = Input::get('venue');
		$servicemarketplace->status = 'pending';
		$servicemarketplace->save();


		return Redirect::to('others/coursesadded');
}

	public function coursesadded()
	{
	$user = User::find(Auth::user()->id);
		$getnotifyunseen = $this->getunseen();
	return View::make('others/coursesadded')->with(compact('user', 'getnotifyunseen'));
	}

	public function manage($id)
	{
		# code...
		$id = $id;
		$cast_id = $id;
		$getcast = DB::table('casting')->where('id', '=', $id)->first();
	$getuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();

		$getacknolodgement = '';
		$getacknolodgement .= "	<br>
								<br>
								<div class='row'>
								<div class='col-lg-12'>
									<table class='table table-responsive'>
										<thead>
											<tr>
												<th>No</th>
												<th>Models</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>";
										$id = 0;
										foreach ($getuser as $key) {
											# code...
											$id += 1;
										$user = User::find($key->user_id);
										$getcancel = DB::table('castmodelcancel')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->get();
					$getacknolodgement .="<tr>
											<td>$id</td>
											<td>".$user->NewModel->displayName."</td>";
											if ($getcancel) {
												# code...
					$getacknolodgement .= "<td><i class='fa fa-trash-o'></i> Discarded <button class='btn btn-success modelchange' data-toggle='modal' data-target='#mymodal' id=$key->user_id>change model</button></td><td><div class=dis$id></div></td>";						
											}else{
					$getacknolodgement .= "<td><i class='fa fa-check'></i> Confirmed</td>";										
											}
					$getacknolodgement .= "</tr>";
										}
					$getacknolodgement .= "</tbody>
									</table>
								</div>
							  </div>";

$getAllUser = DB::table('casttable')->Join('photoupload', 'casttable.user_id', '=', 'photoupload.user_id')->Join('models', 'casttable.user_id', '=', 'models.user_id')->where('casttable.cast_id', '=', $cast_id)->where('casttable.castStatus', '=', '')->where('casttable.castRequest', '=', 'request')->get();

		$result = $this->getinvite($cast_id);
		$getnotifyunseen = $this->getunseen();

		$getdis = DB::table('disciplines')->where('id', '=', $getcast->castCat)->first();
		return View::make('others.manage')->with(compact('getcast', 'getnotifyunseen', 'getAllUser', 'result', 'cast_id', 'getdis', 'getacknolodgement'));

	}

	public function changemodel()
	{
		# code...
		$id = $_GET['id'];
		$view = '';
		$cast_id = $_GET['cast_id'];

		$get = DB::table('castmodelcancel')->where('cast_id', '=', $cast_id)->where('user_id', '=', $id)->get();

		$getcast = DB::table('casting')->where('id', '=', $cast_id)->first();

		
		$getmodels = DB::table('models')->Join('usersplan', 'models.user_id', '=', 'usersplan.user_id')->where('usersplan.status', '=', 'active')->get();


		foreach ($getmodels as $key) {
			# code...
			$users = User::find($key->user_id);
		$getcastmodels = DB::table('casttable')->where('cast_id', '=', $cast_id)->where('user_id', '=', $key->user_id)->where('castStatus', '=', 'confirmed')->get();
		
		if ($getcastmodels) {
			# code...
		}else{

			$view .=	"<div class='col-lg-2 thumbnail-image'>
    						<div class='checkbx'>
    						<input type = 'checkbox' class='checkbtn'  name='invite' id=".$key->user_id."></div>";
    						$user = User::find($key->user_id);
    						if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'Height' => '130px'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'Height' => '130px'));
									}
    	$view	.=		"<p>".$key->user_id."</p>
    						</div>";

		}
	
		}

		echo $view;
	}

	public function changecastmodel()
	{
		# code...
		$id = $_GET['id'];
		$cast_id = $_GET['cast_id'];
		$view = '';
	
		$affectedRows = new casttable;
    	$affectedRows->cast_id = $cast_id;
    	$affectedRows->user_id = $id;
    	$affectedRows->castMethod = 'invited';
    	$affectedRows->save();	

    	$user = User::find($id);
				if(!empty($user->photoupload->imagename)){
				 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px'));
				        }
				        else{
				$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px'));
						}
				$view .= $user->NewModel->displayName;
		echo $view;
	}

	public function acknoledge($id)
	{
		# code...
		$getcast = DB::table('casting')->where('id', '=', $id)->first();
		$getacknolodge = DB::table('modelacknolodgement')->where('cast_id', '=', $id)->where('status', '=', 'active')->get();

		$view = '';
		$id = 0;
		$view .= "<div class='col-lg-12'>
					<table class='table table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>acknoledge</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>";
						foreach ($getacknolodge as $key) {
							# code...
							$id += 1;
							$user = User::find($key->user_id);
							$user_id = $key->user_id;
							$name = $user->NewModel->displayName;
							$name = "<a href=/models/profile/$user_id>$name</a>";
							$image = $user->photoupload->imagename;

							$getack = DB::table('castackmsg')->where('cast_id', '=', $key->cast_id)->where('user_id', '=', $key->user_id)->first();
							if ($getack) {
								# code...
								$btn = "<input type='checkbox'>";
								$btn2 = "<i class='fa fa-exclamation-circle'></i> Pending";
							}else{
								$btn = "<input type='checkbox' checked name='acknoledge' class='acknoledge' value=$key->user_id>";
								$btn2 = "<i class='fa fa-check'></i> Cleared";
							}

		$view	.=			"<tr>
								<td>$id</td>
								<td>$btn</td>						
								<td>";
		$view   .= 				HTML::image($image ,'profile', array('width' => '50px'));
		$view   .=				$name;
		$view   .=				"</td>
								<td>$btn2</td>
							</tr>";

						}
		$view   .=		"</tbody>
					</table>
				</div>";

		$getdis = DB::table('disciplines')->where('id', '=', $getcast->castCat)->first();
		$getnotifyunseen = $this->getunseen();

		return View::make('others.acknoledge')->with(compact('user', 'getnotifyunseen', 'getcast', 'view', 'getdis'));		
	}

	public function sendack()
	{
		# code...
		$user_id = $_GET['user_id'];
		$cast = $_GET['cast'];
		$ackmsg = $_GET['ackmsg'];

		$castackmsg = new castackmsg;
		$castackmsg->cast_id = $cast;
		$castackmsg->user_id = $user_id;
		$castackmsg->msg = $ackmsg;
		$castackmsg->save();
	}

	public function applyverify($id)
	{
		# code...
		$value = $id;
		$getit = '';

		$castPref = DB::table('castpreference')->where('castId', '=', $value)->first();
	$casting = DB::table('casting')->where('id', '=', $value)->first();
	$catType = DB::table('castingtype')->where('castingtype.castId', '=', $value)->Join('catinput', 'castingtype.castType', '=', 'catinput.cat_id')->first();
	$distable = DB::table('castdisciplines')->where('castdisciplines.castId', '=', $value)->Join('distable', 'castdisciplines.discId', '=', 'distable.dis_id')->first();
	$model = DB::table('models')->leftJoin('catinput', 'models.user_id', '=', 'catinput.user_id')->leftJoin('distable', 'models.user_id', '=', 'distable.user_id')->leftJoin('users', 'models.user_id', '=', 'users.id')->leftJoin('modelpreference', 'models.user_id', '=', 'modelpreference.modelId');
	$view = '';

	$month = date('m');
	$year = date('Y');

	$getapplication = DB::table('castapplication')->where('user_id', '=', Auth::user()->id)->where('month', '=', $month)->where('year', '=', $year)->count();

	$user = User::find(Auth::user()->id);
		$getgender = $user->NewModel->gender;
		$getcatdtl = DB::table('distable')->where('dis_id', '=', $casting->castCat)->where('user_id', '=', Auth::user()->id)->get();
				$getuserplan = DB::table('usersplan')->where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->first();
					$getdistable = DB::table('distable')->where('user_id', '=', Auth::user()->id)->count();

	$getadd = DB::table('casttable')->where('user_id', '=', Auth::user()->id)->where('cast_id', '=', $value)->where('castRequest', '=', 'request')->get();
	$getadd2 = DB::table('casttable')->where('user_id', '=', Auth::user()->id)->where('cast_id', '=', $value)->where('castMethod', '=', 'invited')->where('castStatus', '!=', '')->get();
	$getadd3 = DB::table('casttable')->where('user_id', '=', Auth::user()->id)->where('cast_id', '=', $value)->where('castMethod', '=', 'invited')->where('castStatus', '=', '')->get();

	if ($getadd) {
		# code...
		$btn = "<p class='bg-primary' style='padding: 10px'>user applied already</p>";
	}elseif ($getadd2) {
		# code...
		$btn = "<p class='bg-primary' style='padding: 10px'>user applied already</p>";
	}elseif ($getadd3) {
		$btn = "<button class='btn btn-primary btn-lg applycast2' id=$id>Accept Cast</button>";
	}
	else{

	if ($castPref) {
		# code...

		if (!empty($castPref->ethnicity)) {
			# code...
			$ethnicity = $castPref->ethnicity;
			$getit = $model->where('modelpreference.ethnicity', '=', $ethnicity );
                    
		}
		if (!empty($castPref->hair_type)) {
			# code...
			$Hair_type = $castPref->hair_type;
			$getit = $model->where('modelpreference.Hair_type', '=', $Hair_type );
                    
		}
		if (!empty($castPref->butt)) {
			# code...
			$butt = $castPref->butt;
			$getit = $model->where('modelpreference.butt', '=', $butt );
                    
		}
		if (!empty($castPref->languages)) {
			# code...
			$languages = $castPref->languages;
			$getit = $model->where('modelpreference.languages', '=', $languages );
                    
		}
		if (!empty($castPref->qualification)) {
			# code...
			$qualification = $castPref->qualification;
			$getit = $model->where('modelpreference.qualification', '=', $qualification );
                    
		}
		if (!empty($castPref->shoesFrom)) {
			# code...
			$shoesmin = $castPref->shoesFrom;
			$getit = $model->where('modelpreference.shoes', '>=', $shoesmin );
                    
		}
		if (!empty($castPref->shoesTo)) {
			# code...
			$shoesmax = $castPref->shoesTo;
			$getit = $model->where('modelpreference.shoes', '<=', $shoesmax );
                    
		}
		if (!empty($castPref->jacketFrom)) {
			# code...
			$jacketmin = $castPref->jacketFrom;
			$getit = $model->where('modelpreference.jacket', '>=', $jacketmin );
                   
		}
		if (!empty($castPref->jacketTo)) {
			# code...
			$jacketmax = $castPref->jacketTo;
			$getit = $model->where('modelpreference.jacket', '<=', $jacketmax );
                    
		}
		if (!empty($castPref->waistFrom)) {
			# code...
			$waistmin = $castPref->waistFrom;
			$getit = $model->where('modelpreference.hair_color', '>=', $waistmin );
                    
		}
		if (!empty($castPref->waistTo)) {
			# code...
			$waistmax = $castPref->waistTo;
			$getit = $model->where('modelpreference.waist', '<=', $waistmax );
                    
		}
		if (!empty($castPref->hair_color)) {
			# code...
			$haircolor = $castPref->hair_color;
			$getit = $model->where('modelpreference.hair_color', '=', $haircolor );
                    
		}
		if (!empty($castPref->dressFrom)) {
			# code...
			$dressmin = $castPref->dressFrom;
			$getit = $model->where('modelpreference.dress', '>=', $dressmin );
                    
		}
		if (!empty($castPref->dressTo)) {
			# code...
			$dressmax = $castPref->dressTo;
			$getit = $model->where('modelpreference.dress', '<=', $dressmax );
		}
		if (!empty($castPref->collarFrom)) {
			# code...
			$collarmin = $castPref->collarFrom;
			$getit = $model->where('modelpreference.collar', '>=', $collarmin );
		}
		if (!empty($castPref->collarTo)) {
			# code...
			$collarmax = $castPref->collarTo;
            $getit = $model->where('modelpreference.collar', '<=', $collarmax );
		}
		if (!empty($castPref->heightFrom)) {
			# code...
			$heightmin = $castPref->heightFrom;
			$getit = $model->where('models.Height', '>=', $heightmin);
		}
		if (!empty($castPref->heightTo)) {
			# code...
			$heightmax = $castPref->heightTo;
			$getit = $model->where('models.Height', '<=', $heightmax);
		}
		if (!empty($castPref->trousersFrom)) {
			# code...
			$trousersFrom = $castPref->trousersFrom;
			$getit = $model->where('modelpreference.trousers', '>=', $trousersFrom);
		}
		if (!empty($castPref->trousersTo)) {
			# code...
			$trousersTo = $castPref->trousersTo;
			$getit = $model->where('modelpreference.trousers', '<=', $trousersTo);
		}
		if (!empty($castPref->ageTo)) {
			# code...
			$agemax = $castPref->ageTo;
			$getit = $model->where('models.Age', '<=', $agemax);
		}
		if (!empty($castPref->ageFrom)) {
			# code...
			$agemin = $castPref->ageFrom;
			$getit = $model->where('models.Age', '>=', $agemin);
		}
		if (!empty($catType->cat_id)) {
			# code...
			$catTyp = $catType->cat_id;
			$getit = $model->where('catinput.cat_id', '=', $catTyp);
		}		
		if (!empty($casting->castCat)) {
			# code...
			$distbl = $casting->castCat;
			$getit = $model->where('distable.dis_id', '=', $distbl);
		}
		if (!empty($casting->getstates)) {
			# code...
			$getstates = $casting->getstates;
			$getit = $model->where('location', '=', $getstates);
		}
		if (!empty($casting->getcountry)) {
			# code...
			$getcountry = $casting->getcountry;
			$getit = $model->where('models.country', '=', $getcountry);
		}
		if (!empty($casting->gender)) {
			# code...
			if ($casting->gender == 'both') {
				# code...
			$getit= $model->where('models.gender', '!=', '');	
			}else{
			$gender = $casting->gender;
			$getit= $model->where('models.gender', '=', $gender);
			}
		}
		if (!empty($castPref->eyes)) {
			# code...
			$eyes = $castPref->eyes;
                $getit = $model->where('modelpreference.eyes', '=', $eyes);
		}
		if (!empty($castPref->chestbustFrom)) {
			# code...
			$bustmin = $castPref->chestbustFrom;
                $getit = $model->where('modelpreference.chestbust', '>=', $bustmin);
		}
		if (!empty($castPref->chestbustTo)) {
			# code...
			$bustmax = $castPref->chestbustTo;
                $getit = $model->where('modelpreference.chestbust', '<=', $bustmax);
		}
		if(!empty($castPref->waistFrom)) {
			# code...
			$waistmax = $castPref->waistFrom;
			$getit = $model->where('modelpreference.waist', '>=', $waistmax );
		}
		if(!empty($castPref->waistTo)) {
			# code...
			$waistmin = $castPref->waistTo;
			$getit = $model->where('modelpreference.waist', '<=', $waistmin );
		}


		$result = $getit->select('modelpreference.modelId')->distinct()->get();

		if ($result) {
			# code...
					if ($getuserplan->plan_id == 3) {
					# code...
					$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
				}elseif($getuserplan->plan_id == 2){
					if ($getapplication >= 4) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}elseif($getuserplan->plan_id == 1){
					if ($getapplication >= 2) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}
		}else{
					# code...
					$btn = "<p class='bg-primary' style='padding: 10px'>preference not applicable</p>";
			
			}

	}else{

		if ($casting->gender == 'both') {
			# code...
			if ($getcatdtl) {
				# code...
				if ($getuserplan->plan_id == 3) {
					# code...
					$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
				}elseif($getuserplan->plan_id == 2){
					if ($getapplication >= 4) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}elseif($getuserplan->plan_id == 1){
					if ($getapplication >= 2) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}
			}elseif ($casting->castCat == '') {
				# code...
				if ($getuserplan->plan_id == 3) {
					# code...
					$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
				}elseif($getuserplan->plan_id == 2){
					if ($getapplication >= 4) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}elseif($getuserplan->plan_id == 1){
					if ($getapplication >= 2) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}
			}else{
					$btn = "<p class='bg-primary' style='padding: 10px'>preference not applicable</p>";
			}
		}else{
			if ($getgender == $casting->gender) {
				# code...
				if ($getcatdtl) {
					# code...
					if ($getuserplan->plan_id == 3) {
					# code...
					$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
				}elseif($getuserplan->plan_id == 2){
					if ($getapplication >= 4) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}elseif($getuserplan->plan_id == 1){
					if ($getapplication >= 2) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}
				}elseif ($casting->castCat == '') {
				# code...
				if ($getuserplan->plan_id == 3) {
					# code...
					$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
				}elseif($getuserplan->plan_id == 2){
					if ($getapplication >= 4) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}elseif($getuserplan->plan_id == 1){
					if ($getapplication >= 2) {
						# code...
						$btn = "<p class='bg-primary' style='padding: 10px'>You have exceeded the number of cast application for this month</p>";
					}else{
						$btn = "<button class='btn btn-primary btn-lg applycast' id=$id>Apply Now</button>";
					}
				}
				}
				else{
					# code...
					$btn = "<p class='bg-primary' style='padding: 10px'>preference not applicable</p>";
				

				}
			}else{
				$btn = "<p class='bg-primary' style='padding: 10px'>Gender not applicable</p>";
			}
		}
	}
}
	return $btn;

	}

//get 


public function birthdaynotice($id)
{
	# code...
		$fol = DB::table('castfollowers')->where('follower', '=', $id)->orwhere('following', '=', $id)->get();
	foreach ($fol as $key) {
		# code...
		if ($fol->follower == $id) {
			$bduser = $fol->follower;
		}else{
			$dbuser = $fol->following;
		}

		$dates = date('d-m-Y');

	$selectuser = DB::table('models')->where('user_id', '=', $dbuser)->where('birthdate', '=', $dates)->first();

	if ($selectuser) {
		# code...
		$selectnotify = DB::table('notificationbirthday')->where('celebrant', '=', $dbuser)->count();

		if ($selectnotify < 1) {
			# code...
		$notify = new notificationbirthday;
		$notify->celebrant = $dbuser;
		$notify->date = $dates;
		$notify->save();
		}


	}

	}
}

public function gtunuserBirth($id)
{
	# code...
	$dates = date('d-m-Y');
	$userBirth = DB::table('notifybirthdaystatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if ($userBirth > 0) {
		# code...
		$celebrant = 0;
	}else{

	$selBirth = DB::table('notificationbirthday')->where('NotId', '=', $id)->where('date', '=', $dates)->first();
	$user_id = Auth::user()->id;
	$id = $id;

if ($selBirth) {
	# code...
		$celebrant = 0;
	if ($selBirth->celebrant == $user_id) {
		# code...
		$celebrant = 1;
	}else{

		$celeb = $selBirth->celebrant;

			$getmsg =	DB::table('castfollowers')->orwhere(function($query1) use ($user_id, $celeb){
		$query1
		->where('follower', $celeb)
		->where('following', $user_id);				
		})

    ->orWhere(function($query) use ($user_id, $celeb) {
        $query
            ->where('follower', $user_id)
            ->where('following', $celeb);
    })
    ->first();
    if ($getmsg) {
    	# code...
    	$celebrant = 1;
    }else{
    	$celebrant = 0;
    }
}
}else{
	$celebrant = 0;
}


}
	return $celebrant;

	

}

public function gtuncommentphotos($id)
{
	$val = 0;
	$fol = DB::table('notifycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
	if ($fol) {
		if ($fol->sender_id == Auth::user()->id) {
			$val = 0;
		}else{
			$val = 1;
		}
		# code...
		
	}
	return $val;
}

public function gtunlikephotos($id)
{
	$val = 0;
	$fol = DB::table('notifyimagelike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
	if ($fol) {
		if ($fol->sender_id == Auth::user()->id) {
			$val = 0;
		}else{
			$val = 1;
		}
	}
	return $val;
}

public function gtunfollow($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->where('seen', '=', '')->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtmessage($id)
{
	# code...
		$val = 0;
	$fol = DB::table('notifymessage')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if (empty($fol)) {
		# code...
		$val = 1;
	}
	return $val;

}

public function gtviewprofile($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->where('seen', '=', '')->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtUpcoming($id)
{
	# code...
		$val = 0;
	$fol = DB::table('notifyupcomingstatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();

	if (empty($fol)) {
		# code...

		$getuser = DB::table('notifyupcomingcast')->where('NotId', '=', $id)->get();
		foreach ($getuser as $key) {
			# code...

			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();

			$month = date('m');
			$year = date('Y');
			$day = date('d');

			if ($getcast->Yearend >= $year) {
				if ($month == $getcast->Monthend) {
					if ($getcast->Dayend >= $day) {
						$val = 1;
					}else{
						
					}
				}elseif ($getcast->Monthend > $month) {
					# code...
					$val = 1;
				}
			}

			
		}

		
	}
	return $val;
}

public function gtdeclined($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifystatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if (empty($fol)) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtaccept($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifystatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if (empty($fol)) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtinvitation($id)
{
	# code...
		$val = 0;
	$fol = DB::table('notifystatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if (empty($fol)) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtlike($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->where('user_id', '!=', Auth::user()->id)->where('seen', '=', '')->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtuncommentStatus($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
	if ($fol) {
		if ($fol->sender_id == Auth::user()->id) {
			$val = 0;
		}else{
			$val = 1;
		}
	}
	return $val;	
}

public function gtunreplycomment($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifyreplycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->where('sender_id', '!=', Auth::user()->id)->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;	
}

public function gtunlikeStatus($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifystatuslike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->where('sender_id', '!=', Auth::user()->id)->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtunlikeComment($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifycommentlike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->where('sender_id', '!=', Auth::user()->id)->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtunlikereply($id)
{
	# code...
	$val = 0;
	$fol = DB::table('notifyreplylike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->where('sender_id', '!=', Auth::user()->id)->count();
	if ($fol == 1) {
		# code...
		$val = 1;
	}
	return $val;
}

public function gtuncommentlikeimg($id)
{
	$val = 0;
	$fol = DB::table('notifycommentlikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
	if ($fol) {
		if ($fol->sender_id == Auth::user()->id) {
			$val = 0;
		}else{
			$val = 1;
		}
	}
	return $val;
}

public function gtreplycommentimg($id)
{
	$val = 0;
	$fol = DB::table('notifyreplycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
	if ($fol) {
		if ($fol->sender_id == Auth::user()->id) {
			$val = 0;
		}else{
			$val = 1;
		}
	}
	return $val;
}


public function gtreplylikeimg($id)
{
	$val = 0;
	$fol = DB::table('notifyreplylikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
	if ($fol) {
		if ($fol->sender_id == Auth::user()->id) {
			$val = 0;
		}else{
			$val = 1;
		}
	}
	return $val;
}

public function getmsgunseen()
{
	# code...
	$slNotification = DB::table('modelnofity')->orderBy('id','DESC')->where('status', '=', 'active')->where('user', '=', Auth::user()->id)->get();
	$countVal = 0;

	foreach ($slNotification as $key) {
		# code...
		switch ($key->NotId) {
			case '13':
			$countVal += $this->gtmessage($key->id);
				# code...
				break;
		}
	}
$value = 0;

	if ($countVal != 0) {
		# code...
		$vals = $countVal;
		$value = "<span class='badge text-left' style='background-color: red; color: #fff; fony-weight: bold'>".$vals."</span>";
	}else{
		$value = '';
	}
	return $value;
}


public function getcastunseen()
{
	# code...
	$slNotification = DB::table('modelnofity')->orderBy('id','DESC')->where('status', '=', 'active')->where('user', '=', Auth::user()->id)->orWhere('user', '=', 'all')->get();
	$countVal = 0;

	foreach ($slNotification as $key) {
		# code...
		switch ($key->NotId) {
			case '8':
			$countVal += $this->gtdeclined($key->id);
				# code...
				break;
			case '9':
			$countVal += $this->gtaccept($key->id);
				# code...
				break;
			case '14':
			$countVal += $this->gtinvitation($key->id);
				# code...
				break;
		}
	}
$value = 0;

	if ($countVal != 0) {
		# code...
		$vals = $countVal;
		$value = "<span class='badge text-left' style='background-color: red; color: #fff; fony-weight: bold'>".$vals."</span>";
	}else{
		$value = '';
	}
	return $value;
}

public  function getunseen()
{
	# code...
	$slNotification = DB::table('modelnofity')->orderBy('id','DESC')->where('status', '=', 'active')->get();
	
	$countVal = 0;

	foreach ($slNotification as $key) {
		# code...
		if (Auth::user()->user_type == 'newFace' || Auth::user()->user_type == 'proModel') {
		switch ($key->NotId) {
			case '1':
			$countVal += $this->gtunuserBirth($key->id);
				# code...
				break;
			case '2':
				# code...
			$countVal += $this->gtunlikephotos($key->id);
				break;
			case '3':
				# code...
			$countVal += $this->gtuncommentphotos($key->id);
				break;
			case '4':
				# code...
			$countVal += $this->gtuncommentStatus($key->id);
				break;
			case '5':
				# code...
			$countVal += $this->gtunfollow($key->id);
				break;
			case '6':
				# code...
			$countVal += $this->gtviewprofile($key->id);
				break;
			case '7':
			$countVal += $this->gtUpcoming($key->id);
				# code...
				break;
			case '10':
			$countVal += $this->gtlike($key->id);
				# code...
				break;
			case '16':
			$countVal += $this->gtunreplycomment($key->id);
				# code...
				break;
			case '17':
			$countVal += $this->gtunlikeStatus($key->id);
				# code...
				break;
			case '18':
			$countVal += $this->gtunlikeComment($key->id);
				# code...
				break;
			case '19':
			$countVal += $this->gtunlikereply($key->id);
				# code...
				break;
			case '21':
			$countVal += $this->gtuncommentlikeimg($key->id);
				# code...
				break;
			case '22':
			$countVal += $this->gtreplycommentimg($key->id);
				# code...
				break;
			case '23':
			$countVal += $this->gtreplylikeimg($key->id);
				# code...
				break;
		}
	}else{
		switch ($key->NotId) {
			case '1':
			$countVal += $this->gtunuserBirth($key->id);
				# code...
				break;
			case '2':
				# code...
			$countVal += $this->gtunlikephotos($key->id);
				break;
			case '3':
				# code...
			$countVal += $this->gtuncommentphotos($key->id);
				break;
			case '4':
				# code...
			$countVal += $this->gtuncommentStatus($key->id);
				break;
			case '5':
				# code...
			$countVal += $this->gtunfollow($key->id);
				break;
			case '6':
				# code...
			$countVal += $this->gtviewprofile($key->id);
				break;
				# code...
				break;
			case '10':
			$countVal += $this->gtlike($key->id);
				# code...
				break;
			case '16':
			$countVal += $this->gtunreplycomment($key->id);
				# code...
				break;
			case '17':
			$countVal += $this->gtunlikeStatus($key->id);
				# code...
				break;
			case '18':
			$countVal += $this->gtunlikeComment($key->id);
				# code...
				break;
			case '19':
			$countVal += $this->gtunlikereply($key->id);
				# code...
				break;
			case '21':
			$countVal += $this->gtuncommentlikeimg($key->id);
				# code...
				break;
			case '22':
			$countVal += $this->gtreplycommentimg($key->id);
				# code...
				break;
			case '23':
			$countVal += $this->gtreplylikeimg($key->id);
				# code...
				break;
		}
		}
	}
$value = 0;

	if ($countVal != 0) {
		# code...
		$vals = $countVal;
		$value = "<span class='badge mdbadge' style='margin-top: -30px; margin-left: -7px'>".$vals."</span>";
	}else{
		$value = '';
	}
	return $value;

}


public function gtBirth($id)
{
	# code...

	$selBirth = DB::table('notificationbirthday')->where('NotId', '=', $id)->first();
	$user_id = Auth::user()->id;
	$id = $id;


	if ($selBirth->celebrant == $user_id) {
		# code...
		$celebrant = $user_id;
	}else{
		$celeb = $selBirth->celebrant;
			$getmsg =	DB::table('castfollowers')->orwhere(function($query1) use ($user_id, $celeb){
		$query1
		->where('follower', $celeb)
		->where('following', $user_id);				
		})

    ->orWhere(function($query) use ($user_id, $celeb) {
        $query
            ->where('follower', $user_id)
            ->where('following', $celeb);
    })
    ->first();

    if ($getmsg) {
    	# code...
		if ($getmsg->follower == $user_id) {
			# code...
			$celebrant = $getmsg->following;
		}else{
			$celebrant = $getmsg->follower;
		}
    }else{
    	$celebrant = 0;
    }

	}

if ($celebrant < 1) {
	# code...
	$user = '';
}else{

	$selDate = DB::table('notifybirthdaystatus')->where('NotId', '=', $id)->where('user_id', '=', $user_id)->count();
	if ($selDate < 1) {
		# code...
	$addseen = new notifybirthdaystatus;
	$addseen->NotId = $id;
	$addseen->Birthid = $selBirth->id;
	$addseen->user_id = $user_id;
	$addseen->date = $selBirth->date;
	$addseen->save();
	}

		# code...
		$user = '';
		# code...
		$getModel = DB::table('models')->where('user_id', '=', $celebrant)->first();
		$key = $getModel;
			# code...
			
			$getfoto = DB::table('photoupload')->where('user_id', '=', $key->user_id)->first();
			$user = "<a href=/models/profile/".$key->user_id.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$getModel->firstName." ".$getModel->lastName."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-gift' style='color:orange'></span> Bithday!!! </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$selBirth->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
	}

	$val = $user;
	return $val;

}

public function gtfollow($id)
{
	# code...
	$user = '';
	$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->count();
	if ($fol == 1) {
		# code...
		$gtfollow = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->first();
		if ($gtfollow->notify_id == '12') {
			# code...
			$user = '';
		}else{
			$user = '';

			$selDate = DB::table('notificationtable')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notificationtable')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}
			$users = '';
			$users = User::find($gtfollow->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->user_id)->first();

			$url = $this->getProfile($gtfollow->user_id);

			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-plus' style='color:orange'></span> Started following You </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";	
		}
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtprofile($id)
{
	# code...
	$user = '';
	$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->count();
	if ($fol == 1) {
		# code...
		$selDate = DB::table('notificationtable')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notificationtable')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->user_id)->first();
			$url = $this->getProfile($gtfollow->user_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12 col-xs-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-eye-open' style='color:orange'></span> Viewed Your Profile </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtlikedphotos($id)
{
	$user = '';
	$getimagelike = DB::table('notifyimagelike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
	if ($getimagelike) {
		# code...

		if ($getimagelike->sender_id == Auth::user()->id) {
			# code...
			$user = '';
		}else{

		$users = '';
		$users = User::find($getimagelike->sender_id);
		if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
		}else{
			$name = $users->NewModel->displayName;
		}

		$getinsert = DB::table('notifyimagelike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
			if ($getinsert) {
				$getinsert = DB::table('notifyimagelike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->update(array('seen' => 'seen'));
			}else{

			}
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					$id = "-$getimagelike->imageid-$getimagelike->sender_id";
			$user = "<a href='#imageview' id=$id>
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12 col-xs-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-ok' style='color:orange'></span> Liked your photo </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$getimagelike->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
						}

	}else{
		$user = '';
	}
	$val = $user;
	return $val;

}

public function gtUpcomingcast($id)
{
	# code...
		# code...
		$user = '';
		$dates = date('d-m-Y');
	$slNotBirth = DB::table('notifyupcomingcast')->where('NotId', '=', $id)->count();
	if ($slNotBirth == 1) {
		# code...

		$caststatus = DB::table('notifyupcomingstatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
		$getuser = DB::table('notifyupcomingcast')->where('NotId', '=', $id)->get();
		foreach ($getuser as $key) {
			# code...
				# code...
			if (empty($caststatus)) {
				# code...
			$notifyupcomingstatus = new notifyupcomingstatus;
		$notifyupcomingstatus->NotId = $id;
		$notifyupcomingstatus->upcomingId = $key->id;
		$notifyupcomingstatus->user_id = Auth::user()->id;
		$notifyupcomingstatus->date = $dates;
		$notifyupcomingstatus->save();	
			}
			

			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();

			$month = date('m');
			$year = date('Y');
			$day = date('d');

			if ($getcast->Yearend >= $year) {
				if ($month == $getcast->Monthend) {
					if ($getcast->Dayend >= $day) {
						$user = "<a href=/others/showcastdetail/".$getcast->id.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getcast->castImage)){
							 $user .=  $image = HTML::image($getcast->castImage ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getcast->castImage)){
							 $user .=  $image = HTML::image($getcast->castImage ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='font-size: 12px; color: #333; font-weight: bold'>".str_limit($getcast->castTitle, $limit = 15, $end = '...')."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> Location : ".$getcast->location."</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$key->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
					}else{
						
					}
				}elseif ($getcast->Monthend > $month) {
					# code...
					$user = "<a href=/others/showcastdetail/".$getcast->id.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getcast->castImage)){
							 $user .=  $image = HTML::image($getcast->castImage ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getcast->castImage)){
							 $user .=  $image = HTML::image($getcast->castImage ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='font-size: 12px; color: #333; font-weight: bold'>".str_limit($getcast->castTitle, $limit = 15, $end = '...')."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> Location : ".$getcast->location."</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$key->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
				}
			}
		}
	}
	$val = $user;
	return $val;


}

public function gtdeclinedcast($id)
{
	# code...
	$user = '';
	$slNotBirth = DB::table('notifystatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if (!is_null($slNotBirth)) {
		# code...
		$getuser = DB::table('notifycaststatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->get();
		foreach ($getuser as $key) {
			# code...
			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$user = "<a href=/others/showcast/".$getcast->cast_id.">
						  <div class='row'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-4'>";
									if(!empty($getcast->castImage)){
							    $user .= $image = HTML::image($getcast->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
								$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
								$user .= "</div>
									<div class='col-lg-8 text-left'>
										<h5>Cast Declined</h5>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
		}
	}
	$val = $user;
	return $val;


}

public function gtacceptcast($id)
{
	# code...
	$user = '';
	$slNotBirth = DB::table('notifystatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if (!is_null($slNotBirth)) {
		# code...
		$getuser = DB::table('notifycaststatus')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->get();
		foreach ($getuser as $key) {
			# code...
			$getcast = DB::table('casting')->where('id', '=', $key->cast_id)->first();
			$user = "<a href=/others/showcast/".$getcast->id.">
						  <div class='row'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-4'>";
									if(!empty($getcast->castImage)){
							    $user .= $image = HTML::image($getcast->castImage ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
								$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
									"</div>
									<div class='col-lg-8 text-left'>
										<h5>Cast Accepted</h5>
									</div>
								</div>
							</div>
						  </div>
						  </a><hr>";
		}
	}
	$val = $user;
	return $val;


}

public function gtlikeuser($id)
{
	# code...
		$user = '';

	$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->count();
	if ($fol > 0) {
		# code...
		$selDate = DB::table('notificationtable')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notificationtable')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->user_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->user_id)->first();
			$url = $this->getProfile($gtfollow->user_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-ok' style='color:orange'></span> Liked Your Profile </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";;	
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtcommentStatus($id)
{
	# code...
		$user = '';

	$fol = DB::table('notifycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if ($fol > 0) {
		# code...
		$selDate = DB::table('notifycomment')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notifycomment')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notifycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->sender_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->sender_id)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Commented on Your Status</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";;	
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtreplycomment($id)
{
	# code...
		$user = '';

	$fol = DB::table('notifyreplycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if ($fol > 0) {
		# code...
		$selDate = DB::table('notifyreplycomment')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notifyreplycomment')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notifyreplycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->sender_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->sender_id)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Replied your Comment</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";;	
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtlikestatus($id)
{
	# code...
		$user = '';

	$fol = DB::table('notifystatuslike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if ($fol > 0) {
		# code...
		$selDate = DB::table('notifystatuslike')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notifystatuslike')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notifystatuslike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->sender_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->sender_id)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-heart' style='color:orange'></span> Liked Your Status </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";;	
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtlikecomment($id)
{
	# code...
		$user = '';

	$fol = DB::table('notifycommentlike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if ($fol > 0) {
		# code...
		$selDate = DB::table('notifycommentlike')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notifycommentlike')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notifycommentlike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->sender_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->sender_id)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-heart' style='color:orange'></span> Liked your Comment</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";;	
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtcommentPhotos($id)
{
	# code...
		$user = '';
	$getimagelike = DB::table('notifycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
	if ($getimagelike) {
		# code...

		if ($getimagelike->sender_id == Auth::user()->id) {
			# code...
			$user = '';
		}else{

		$users = '';
		$users = User::find($getimagelike->sender_id);
		if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
		}else{
			$name = $users->NewModel->displayName;
		}

		$getinsert = DB::table('notifycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
			if ($getinsert) {
				$getinsert = DB::table('notifycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->update(array('seen' => 'seen'));
			}else{

			}

					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					
			$user = "<a href='#imageview' >
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12 col-xs-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Commented on your image</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$getimagelike->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
						}

	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtreplycommentPhotos($id)
{
	$user = '';
	$getimagelike = DB::table('notifyreplycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
	if ($getimagelike) {
		# code...

		if ($getimagelike->sender_id == Auth::user()->id) {
			# code...
			$user = '';
		}else{

		$users = '';
		$users = User::find($getimagelike->sender_id);
		if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
		}else{
			$name = $users->NewModel->displayName;
		}

		$getinsert = DB::table('notifyreplycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
			if ($getinsert) {
				$getinsert = DB::table('notifyreplycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->update(array('seen' => 'seen'));
			}else{

			}

					$getimagecomment = DB::table('replycommentimg')->where('id', '=', $getimagelike->replyId)->first();
					$getimagelink = DB::table('imagecomment')->where('id', '=', $getimagecomment->commentId)->first();
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					$id = $getimagelink->imageid;
			$user = "<a href=/users/imagecomment/$id>
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12 col-xs-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Replied your comment image</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$getimagelike->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
						}

	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtlikePhotoscomment($id)
{
	# code...
	$user = '';
	$getimagelike = DB::table('notifycommentlikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
	if ($getimagelike) {
		# code...

		if ($getimagelike->sender_id == Auth::user()->id) {
			# code...
			$user = '';
		}else{

		$users = '';
		$users = User::find($getimagelike->sender_id);
		if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
		}else{
			$name = $users->NewModel->displayName;
		}

			$getinsert = DB::table('notifycommentlikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
			if ($getinsert) {
				$getinsert = DB::table('notifycommentlikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->update(array('seen' => 'seen'));
			}else{

			}
					$getimagecomment = DB::table('imagecomment')->where('id', '=', $getimagelike->commentId)->first();
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					$id = $getimagecomment->imageid;
			$user = "<a href=/users/imagecomment/$id>
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12 col-xs-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Commented on your image</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$getimagelike->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
						}

	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtlikereplyPhotos($id)
{
	# code...
	$user = '';
	$getimagelike = DB::table('notifyreplylikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
	if ($getimagelike) {
		# code...

		if ($getimagelike->sender_id == Auth::user()->id) {
			# code...
			$user = '';
		}else{

			$getinsert = DB::table('notifyreplylikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->first();
			if ($getinsert) {
				$getinsert = DB::table('notifyreplylikeimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->update(array('seen' => 'seen'));
			}else{

			}

		$users = '';
		$users = User::find($getimagelike->sender_id);
		if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
		}else{
			$name = $users->NewModel->displayName;
		}

					$getimagecomment = DB::table('replylikeimg')->where('id', '=', $getimagelike->replyId)->first();
					$getimagelink = DB::table('replycommentimg')->where('id', '=', $getimagecomment->replyId)->first();
					$getimagelink2 = DB::table('imagecomment')->where('id', '=', $getimagelink->commentId)->first();
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					$id = $getimagelink2->imageid;
			$user = "<a href=/users/imagecomment/$id>
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12 col-xs-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Liked your reply</p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$getimagelike->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";
						}

	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtlikereply($id)
{
	# code...
		$user = '';

	$fol = DB::table('notifyreplylike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
	if ($fol > 0) {
		# code...
		$selDate = DB::table('notifyreplylike')->where('NotId', '=', $id)->where('seen', '=', '')->count();
			if (!is_null($selDate)) {
				# code...
			$addseen = DB::table('notifyreplylike')->where('NotId', '=', $id)->update(array('seen' => 'seen'));
			}

		$gtfollow = DB::table('notifyreplylike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
			$user = '';
			$users = '';
			$users = User::find($gtfollow->sender_id);
			if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->sender_id)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=".$url.">
						  <div class='row' style='padding: 7px'>
							<div class='col-lg-12'>
								<div class='row'>
									<div class='col-lg-2 hidden-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$user .= "</div>
							<div class='col-xs-2 hidden-lg visible-xs'>";
									if(!empty($getfoto->imagename)){
							 $user .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '30px', 'Height' => '30px'));
							        }
							        else{
							$user .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
									}
							$user .= "</div>
									<div class='col-lg-6 col-xs-6 text-left' style='padding-left: 25px; margin-top: -7px'>
										<h6 style='color: #333; font-weight: bold'><span class='glyphicon glyphicon-user' style='color:orange'></span> ".$name."</h6>
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-heart' style='color:orange'></span> Liked Your Reply </p>
									</div>
									<div class='col-lg-4 col-xs-4 text-right'>
										<br>
										<br>
										<p style='font-size: 10px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-calendar' style='color:orange'></span> ".$gtfollow->date."</p>
									</div>
								</div>
							</div>
						  </div>
						  </a>";;	
	}else{
		$user = '';
	}
	$val = $user;
	return $val;
}

public function gtnotifystatus($id)
{
	# code...
	$view = '';
	$getnews = DB::table('notifynews')->where('NotId', '=', $id)->first();
	$user = $getnews->user_id;

	$following = Auth::user()->id;

		$getStatus = DB::table('status')->where('id', $getnews->statusId)->first();

		$getfol = DB::table('castfollowers')->orwhere(function($query1) use ($user, $following){
		$query1
		->where('follower', $following)
		->where('following', $user);				
		})->get();

		if ($getfol || $getnews->user_id == Auth::user()->id) {
			# code...
			$users = User::find($getnews->user_id);
			if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$view .= "<div class='col-lg-12'>
								<a href=/users/comment/$getStatus->id>
									<div class='row dash-thumb'>
									<div class='col-lg-2 text-left'>";
							if(!empty($users->photoupload->imagename)){
							 $view .=  $image = HTML::image($users->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px', 'class'=>'img-responsive'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}
							$view	.=	"</div>
										<div class='col-lg-10'>
										<div class='img-cont'>
											<p class='dash-title'>".str_limit($getStatus->status, 20, $end = '...')."</p>
											<br>
											<p><span class='dash-name'>".$name."</span> <span class='dash-date'>Posted: ".$getStatus->date."</span></p>
										</div>
										</div>
									</div>
								</a>
								<hr>
								</div>";
		}

		return $view;

}

public function gtuploadphoto($id)
{
	# code...
	$view = '';
	$getupload = DB::table('notifyuploadphoto')->where('NotId', '=', $id)->first();
	$user = $getupload->user_id;

	$following = Auth::user()->id;

		$imagegallery = DB::table('imagegallery')->where('id', $getupload->img_id)->first();

		$getfol = DB::table('castfollowers')->orwhere(function($query1) use ($user, $following){
		$query1
		->where('follower', $following)
		->where('following', $user);				
		})->get();

		if ($getfol || $getupload->user_id == Auth::user()->id) {
			# code...
			$users = User::find($getupload->user_id);
			if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
			$view .= "<div class='col-lg-12'>
								<a href=/users/imagecomment/$getupload->img_id>
									<div class='row dash-thumb'>
									<div class='col-lg-2 text-left'>";
							if(!empty($users->photoupload->imagename)){
							 $view .=  $image = HTML::image($users->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px', 'class'=>'img-responsive'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}
							$view	.=	"</div>
										<div class='col-lg-10'>
										<div class='img-cont'>";
							$view .=  $image = HTML::image($imagegallery->imagename ,'profile', array('width' => '50px', 'height' => '50px', 'class'=>'img-responsive'));
							$view .=	"<br>
											<p><span class='dash-name'>".$name."</span></p>
										</div>
										</div>
									</div>
								</a>
								<hr>
								</div>";
		}

		return $view;
}

public function getnotice()
{	
	# code...
		$slNotification = DB::table('modelnofity')->orderBy('id','DESC')->where('status', '=', 'active')->get();
	
	$countVal = '';

	foreach ($slNotification as $key) {
		# code...
		switch ($key->NotId) {
			case '1':
			$countVal .= $this->gtBirth($key->id);
				# code...
				break;
			case '2':
			$countVal .= $this->gtlikedphotos($key->id);
				# code...
				break;
			case '3':
			$countVal .= $this->gtcommentPhotos($key->id);
				# code...
				break;
			case '4':
			$countVal .= $this->gtcommentStatus($key->id);
				# code...
				break;	
			case '5':
				# code...
			$countVal .= $this->gtfollow($key->id);
				break;
			case '6':
				# code...
			$countVal .= $this->gtprofile($key->id);
				break;
			case '10':
			$countVal .= $this->gtlikeuser($key->id);
				# code...
				break;
			case '16':
			$countVal .= $this->gtreplycomment($key->id);
				# code...
				break;
			case '17':
			$countVal .= $this->gtlikestatus($key->id);
				# code...
				break;
			case '18':
			$countVal .= $this->gtlikecomment($key->id);
				# code...
				break;
			case '19':
			$countVal .= $this->gtlikereply($key->id);
				# code...
				break;
			case '21':
			$countVal .= $this->gtlikePhotoscomment($key->id);
				# code...
				break;
			case '22':
			$countVal .= $this->gtreplycommentPhotos($key->id);
				# code...
				break;
			case '23':
			$countVal .= $this->gtlikereplyPhotos($key->id);
				# code...
				break;
		}
	}
$value = 0;

	if (!is_null($countVal)) {
		# code...
		$vals = $countVal;
		$value = $vals;
	}else{
		$value = '';
	}
	return $value;

}

public function getfollowersupdate()
{	
	# code...
		$slNotification = DB::table('modelnofity')->take(3)->orderBy('id','DESC')->where('status', '=', 'active')->where(function($query1) {
		$query1
		->where('NotId', '15')
		->orwhere('NotId', '20');				
		})->get();
	
	$countVal = '';

	foreach ($slNotification as $key) {
		# code...
		switch ($key->NotId) {
			case '15':
			$countVal .= $this->gtnotifystatus($key->id);
				# code...
				break;
			case '20':
			$countVal .= $this->gtuploadphoto($key->id);
				# code...
				break;
		}
	}
$value = 0;

	if (!is_null($countVal)) {
		# code...
		$vals = $countVal;
		$value = $vals;
	}else{
		$value = '';
	}
	return $value;

}

public function declineopt()
{
	$view = '';
	$modelid = $_GET['modelid'];
$view .= "<div class='row'>
				<div class='col-lg-12'>
				<h5>Are you sure you want to decline this model</h5>
				</div>
			  </div>
			<div class='row'>
				<div class='col-lg-6 col-xs-12'>
					<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-primary declineusers' id=$modelid data-dismiss='modal'>Yes</button>
				</div>
				<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
				</div>
				</div>
			</div>
			</div>";
echo $view;
}

public function followings()
{
	$view = '';
	$modelid = $_GET['modelid'];
$view .= "<div class='row'>
				<div class='col-lg-12'>
				<h5>Are you sure you want to unfollow this model</h5>
				</div>
			  </div>
			<div class='row'>
				<div class='col-lg-6 col-xs-12'>
					<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-primary following' id=$modelid data-dismiss='modal'>Yes</button>
				</div>
				<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
				</div>
				</div>
			</div>
			</div>";
echo $view;
}

public function linktojob()
{
	# code...
	$getuser = $_GET['user_id'];
	$getData = DB::table('job')->where('user_id', '=', Auth::user()->id)->where('status', '=', 'activated')->get();
	$value = "<div class='well'>";
	$value .= "<input type='hidden' id=proid value=$getuser>";
	foreach ($getData as $key) {
		$checkuser = DB::table('jobtable')->where('job_id', '=', $key->id)->where('user_id', '=', $getuser)->first();
		if ($checkuser) {
			$btn = "<button class='btn btn-default'>Invited</button>";
		}else{
			$btn = "<button class='btn btn-primary invitepro' id=$key->id>Invite</button>";
		}
	$value .= "<div class='row'>
				<div class='col-lg-6'>
					<h4>$key->title</h4>
				</div>
				<div class='col-lg-6'>
					$btn
				</div>
			  </div>";
	}
	$value .= "</div>";

	echo $value;
}

public function invitepro()
{

	$val = $_GET['val'];
    $proid = $_GET['proid'];
    $getjob = DB::table('jobtable')->where('job_id', '=', $val)->where('user_id', '=', $proid)->get();
    if ($getjob) {
    	
    }else{
    $jobtable = new jobtable;
    $jobtable->job_id = $val;
    $jobtable->user_id = $proid;
    $jobtable->jobMethod = 'invited';
    $jobtable->save();

    $dates = date('d-m-Y');

		$notify = DB::table('notification')->where('name', '=', 'jobInvitation')->first();

    	$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $proid;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifyjob;
		$upcoming->NotId = $ModelNotId;
		$upcoming->job_id = $val;
		$upcoming->user_id = $proid;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->save();
		}
}

public function creatjob()
{
	sleep(3);
	$user_id = $_GET['user_id'];

	parse_str($_GET['form'], $formdata);
	$title = $formdata['title'];
	$job_description = $formdata['job_description'];
	$job_task = $formdata['job_task'];
	$amount = $formdata['amount'];
	$country = $formdata['country'];
	$location = $formdata['location'];
	$city = $formdata['town'];
	$venue = $formdata['venue'];
	$jobDay = $formdata['jobDay'];
	$jobMonth = $formdata['jobMonth'];
	$jobYear = $formdata['jobYear'];
	$Dayend = $formdata['Dayend'];
	$Monthend = $formdata['Monthend'];
	$Yearend = $formdata['Yearend'];
	$user_spec = $formdata['user_spec'];

	$addjob = new job;
	$addjob->user_id = Auth::user()->id;
	$addjob->title = $title;
	$addjob->job_description = $job_description;
	$addjob->job_task = $job_task;
	$addjob->amount = $amount;
	$addjob->country = $country;
	$addjob->location = $location;
	$addjob->area = $city;
	$addjob->venue = $venue;
	$addjob->jobDay = $jobDay;
	$addjob->jobMonth = $jobMonth;
	$addjob->jobYear = $jobYear;
	$addjob->Yearend = $Yearend;
	$addjob->Monthend = $Monthend;
	$addjob->Dayend = $Dayend;
	$addjob->status = 'pending';
	$addjob->visibility = 'none';
	$addjob->user_spec = $user_spec;
	$addjob->save();

	$jobtable = new jobtable;
    $jobtable->job_id = $addjob->id;
    $jobtable->user_id = $user_id;
    $jobtable->jobMethod = 'invited';
    $jobtable->save();

			$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'upcomingJob')->first();

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = Auth::user()->id;
	$modeldata->status = 'active';
	$modeldata->date = $dates;
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$upcoming = new notifyupcomingjob;
	$upcoming->NotId = $notify->id;
	$upcoming->job_id = $addjob->id;
	$upcoming->date = $dates;
	$upcoming->save();


		$notify = DB::table('notification')->where('name', '=', 'jobInvitation')->first();
		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $user_id;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifyjob;
		$upcoming->NotId = $ModelNotId;
		$upcoming->job_id = $addjob->id;
		$upcoming->user_id = $user_id;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->save();
}

public function jobInvitation()
{
	$user = User::find(Auth::user()->id);
	$user_id = Auth::user()->id;
	$view = '';

	$jobnew = DB::table('jobtable')->where('jobtable.user_id', '=', $user_id)->where('jobtable.jobMethod', '=', 'invited')->where(function($query1){
		$query1
		->where('jobtable.jobStatus', '=', 'confirmed')
		->orwhere('jobtable.jobStatus','=', '');				
		})->Join('job', 'jobtable.job_id', '=', 'job.id')->orderBy('jobtable.id','DESC')->get();

	$getjob = DB::table('jobtable')->where('jobtable.jobMethod', '=', '')->where('jobtable.user_id', '=', $user_id)->where(function($query1){
		$query1
		->orwhere('jobtable.jobStatus', '=', 'confirmed')
		->orwhere('job.status', '=', 'finished')
		->orwhere('jobtable.jobStatus','=', '');				
		})->LeftJoin('jobcheckout', 'jobtable.job_id', '=', 'jobcheckout.job_id')->Join('job', 'jobtable.job_id', '=', 'job.id')->orderBy('jobtable.id','DESC')->groupBy('jobcheckout.job_id')->get();

	$jobprevious = DB::table('jobtable')->where('jobtable.user_id', '=', $user_id)->where('jobStatus', '=', 'confirmed')->Join('job', 'jobtable.job_id', '=', 'job.id')->where('job.status', '=', 'finished')->get();

		$jobdeclined = DB::table('jobtable')->where('jobtable.user_id', '=', $user_id)->where('jobtable.jobStatus', '=', 'declined')->Join('job', 'jobtable.job_id', '=', 'job.id')->get();

	foreach($getjob as $applied){

		$getcancel = DB::table('jobcancel')->where('job_id', '=', $applied->id)->get();

    		$view .= "<div class='row casting-bg' id=cast".$applied->id.">
	    				<div class='col-lg-2'>";
					$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
							
               $view .= "</div>
                        <div class='col-lg-7' style='padding-top: 20px; padding-left: 50px;'>
                            <a href=/others/showcastdetail/$applied->job_id>$applied->title</a>
                            <h5>Location: $applied->location</h5>
                            <h5>Amount: $applied->amount </h5>
                            <h5>Contract Status: ";
                            if($getcancel){
                           $view .= "DISCARDED";
                        	}
                            else{
                           $view .= strtoupper($applied->jobStatus);
                        	}
                           $view .= "</h5>
                            <br>
                            <br>
                        </div>
                        <div class='col-lg-3'>
                        <br>
                        <br>
                        <br>
                        	<button data-toggle='modal' data-target='#myModal' class='btn btn-default viewjobs' style='background-color: #54d7e3; color: #fff;' id=$applied->id>VIEW CONTRACT</button>
                        </div>
	    			</div>
	    			<br>
	    			<br>";
    			}

    			$getnotifyunseen = $this->getunseen();

	return View::make('others.jobinvitation')->with(compact('user', 'view', 'jobdeclined', 'jobnew', 'jobprevious', 'getnotifyunseen'));
}

public function jobview()
{
	# code...
	
	$val = $_GET['val'];
	$cast = DB::table('job')->where('job.id', '=', $val)->Join('jobtable', 'job.id', '=', 'jobtable.job_id')->orderBy('job.id','DESC')->get();
	foreach ($cast as $key) {
		$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));

	$value = "<div class='modal-header'>
				        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				        <h4 class='modal-title' id='myModalLabel'>".$key->title."</h4>
				      </div>
		<div class='modal-body'>
		<div class='row'>
		<div class='col-md-5'>
		<p>Location: ".$key->location."</p>
		<p>Contract Duration: ".$key->jobDay."/".$key->jobMonth."/".$key->jobYear." - ".$key->Dayend."/".$key->Monthend."/".$key->Yearend."</p>
		<p>Cast Expires: ".$key->Dayexp."/".$key->monthexp."/".$key->yearexp."</p>
		</div>
		<div class='col-md-4'>
		<p>Professional: ".$key->user_spec."</p>
		<p>Location: ".$key->location."</p>
		<p>Location: ".$key->area."</p>
		</div>
		
		<div class='col-md-3'>
		".$image."
		</div>
		</div>
		
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Contract Description</h5>
		<p>".$key->job_description."</p>
		
		</div>
		</div>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Contract Task</h5>
		<p>".$key->job_task."</p>
		
		</div>
		</div>
		<div class='row'>
					<div class='col-lg-12'>";
		if(empty($key->jobStatus)){
        $value .= "<button class='btn btn-default applyjob' data-dismiss='modal' id=".$key->id." style='background-color: #54d7e3; color: #fff;'>Apply</button>";
        }else{
        $value .= "<h5>Status: Confirmed</h5>";
        }
		$value	.= "</div>
				</div>
		</div>
		";

	
echo $value;
	}
}

public function jobviews()
{
	# code...
	
	$val = $_GET['val'];
	$cast = DB::table('job')->where('id', '=', $val)->orderBy('id','DESC')->get();
	foreach ($cast as $key) {
		$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));

	$value = "<div class='modal-header'>
				        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				        <h4 class='modal-title' id='myModalLabel'>".$key->title."</h4>
				      </div>
		<div class='modal-body'>
		<div class='row'>
		<div class='col-md-5'>
		<p>Location: ".$key->location."</p>
		<p>Contract Duration: ".$key->jobDay."/".$key->jobMonth."/".$key->jobYear." - ".$key->Dayend."/".$key->Monthend."/".$key->Yearend."</p>
		<p>Contract Expires: ".$key->Dayexp."/".$key->monthexp."/".$key->yearexp."</p>
		</div>
		<div class='col-md-4'>
		<p>Professional: ".$key->user_spec."</p>
		<p>Location: ".$key->location."</p>
		<p>Location: ".$key->area."</p>
		</div>
		
		<div class='col-md-3'>
		".$image."
		</div>
		</div>
		
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Contact Description</h5>
		<p>".$key->job_description."</p>
		
		</div>
		</div>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Contract Task</h5>
		<p>".$key->job_task."</p>
		
		</div>
		</div>
		</div>
		";

	
echo $value;
	}
}


public function jobapplyProcess()
{
	# code...
		$month = date('m');
	$year = date('Y');
	$val = $_GET['val'];
	$user_id = Auth::user()->id;
	$getapply = DB::table('jobtable')->where('job_id', '=', $val)->where('user_id', '=', $user_id)->where('jobStatus', '=', 'confirmed')->get();
	if ($getapply) {
		echo "<div class='row'>
				<div class='col-lg-4 bg-primary' style='padding: 5px;'>
		Cast applied
				</div>
			</div>";
	}else{
	$castApplication = new jobapplication;
	$castApplication->user_id = $user_id;
	$castApplication->job_id = $val;
	$castApplication->month = $month;
	$castApplication->year = $year;
	$castApplication->save();

	$castUpdate = jobtable::where('job_id', '=', $val)->where('user_id', '=', $user_id)->update(array('jobStatus' => 'confirmed'));
	echo "<div class='row'>
				<div class='col-lg-4 bg-primary' style='padding: 5px;'>
		Cast applied
				</div>
			</div>";	
	}
}

public function payofflinejob($id)
{

		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/JB/".$rand."/".$csdate;
		$user = Others::find(Auth::user()->id);

		$offlinepayoutjob = new offlinepayoutjob;
		$offlinepayoutjob->job_id = $id;
		$offlinepayoutjob->refid = $code;
		$offlinepayoutjob->save();

		$getjob = DB::table('job')->where('id', '=', $id)->where('id', '=', $id)->first();
		$getuser = DB::table('jobtable')->where('job_id','=', $id)->where('jobStatus', '=', 'confirmed')->first();

		$getusername = Others::find($getuser->user_id);

		return View::make('others/payofflinejobreciept')->with(compact('code', 'getjob', 'user', 'getusername'));
}

public function payofflinecast($id)
{

		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/CSOFL/".$rand."/".$csdate;
		$user = Others::find(Auth::user()->id);
		$view = '';
		$no = '';

		$getcast = DB::table('casting')->where('id', '=', $id)->first();
		$getmodels = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
	$getcount = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();

	$Amount = $getcast->payDesc * $getcount;

		foreach ($getmodels as $key) {
			
		$offlinepayoutjob = new offlinepayoutcast;
		$offlinepayoutjob->cast_id = $id;
		$offlinepayoutjob->model_id = $key->user_id;
		$offlinepayoutjob->ref_id = $code;
		$offlinepayoutjob->save();			

		}


		$view .= "<div class='col-lg-6'>
				<img src='/img/afrodiasy.png' class='img-responsive'>
				</div>
		<div class='col-lg-12'>
				
				<div class='col-lg-6'>
				<p>Bank: Guarantee Trust Bank (Gtb)<p>
				<p>Account name: Kajandi Limited</p>
				<p>Account number : 0229313812
				</div>
				<div class='col-lg-6'>
				<h4>Payment for ".$getcast->castTitle."</h4>
				<p>Number of models for the cast: <strong>$getcount</strong></p>
				<p>Total Amount: <strong>$Amount</strong></p>
				<p>Sender name: <strong>$code</strong></p>
				</div>

			<div class='row'>
				<div class='col-lg-6'>
					<p><b>Note: you must include your name and sender name code on the space provided in your bank slip</b></p>
				</div>
			</div>";
			$view .=	"<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody>";
						foreach ($getmodels as $key) {
							# code...
							$no += 1;
							$user = User::find($key->user_id);
						$view .= "<tr>
									<td>$no</td>
									<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";
						}
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";

		return View::make('others/offlinepayoutcast')->with(compact('view', 'user'));
}
public function payofflinecast2($id)
{

		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/CSOFL/".$rand."/".$csdate;
		$user = Others::find(Auth::user()->id);
		$view = '';
		$val = '';
		$view2 = '';
		$no = '';

		$getcast = DB::table('casting')->where('id', '=', $id)->first();

	$getuser = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();

		foreach ($getuser as $key) {
		# code...
		$getcastpayment = DB::table('modelscastpayment')->where('cast_id', '=', $id)->where('user_id', '=', $key->user_id)->first();
		if ($getcastpayment) {
			# code...
		}else{
				# code...
			$val += 1;

			$no += 1;
							$user = User::find($key->user_id);
						$view2 .= "<tr>
									<td>$no</td>
									<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";

			$offlinepayoutjob = new offlinepayoutcast;
		$offlinepayoutjob->cast_id = $id;
		$offlinepayoutjob->model_id = $key->user_id;
		$offlinepayoutjob->ref_id = $code;
		$offlinepayoutjob->save();
			

		}
	}
	$amount = $getcast->payDesc * $val;


		$view .= "<div class='col-lg-4'>
				<img src='/img/afrodiasy.png' class='img-responsive'>
				</div>
		<div class='col-lg-12'>
				<div class='col-lg-6'>
				<p>Bank: Guarantee Trust Bank (Gtb)<p>
				<p>Account name: Kajandi Limited</p>
				<p>Account number : 0229313812
				</div>
				<div class='col-lg-6'>
				<h4>Payment for ".$getcast->castTitle."</h4>
				<p>Number of models for the cast: <strong>$val</strong></p>
				<p>Total Amount: <strong>$amount</strong></p>
				<p>Sender name: <strong>$code</strong></p>
				</div>
				<div class='row'>
				<div class='col-lg-6'>
					<p><b>Note: you must include your name and sender name code on the space provided in your bank slip</b></p>
				</div>
			</div>";
			$view .=	"<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody>";
			$view .= $view2;
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";

		return View::make('others/offlinepayoutcast')->with(compact('view', 'user'));
}
public function offlinepayoutphotosession($id)
{
		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/PHOFL/".$rand."/".$csdate;
		$user = Others::find(Auth::user()->id);
		$view = '';
		$no = '';

	$getphotosession = DB::table('photosession')->where('id', '=', $id)->first();

	$offlinepay = new offlinepayoutphotosession;
	$offlinepay->photosession_id = $id;
	$offlinepay->amount = $getphotosession->price;
	$offlinepay->user_id = Auth::user()->id;
	$offlinepay->ref_id = $code;
	$offlinepay->save();

	$view .= "<div class='col-lg-6'>
				<img src='/img/afrodiasy.png' class='img-responsive'>
				</div>
			<div class='col-lg-12'>
				<div class='col-lg-6'>
				<p>Bank: Guarantee Trust Bank (Gtb)<p>
				<p>Account name: Kajandi Limited</p>
				<p>Account number : 0229313812
				</div>
				<div class='col-lg-6'>
				<h4>Payment for ".$getphotosession->title."</h4>
				<p>Total Amount: <strong>".number_format($getphotosession->price)."</strong></p>
				<p>Sender name: <strong>$code</strong></p>
				</div>
				<div class='row'>
				<div class='col-lg-6'>
					<p><b>Note: you must include your name and sender name code on the space provided in your bank slip</b></p>
				</div>
			</div>";
			$view .=	"<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Photosession</th>
								<th>Duration</th>
								<th>Location</th>
							</tr>
						</thead>
						
						<tbody>";
							# code...
							$no += 1;
						$view .= "<tr>
									<td>$no</td>
									<td>".$getphotosession->title."</td>
									<td>".$getphotosession->duration."</td>
									<td>".$getphotosession->location."</td>
								</tr>";
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";

		return View::make('others/offlinepayoutphotosession')->with(compact('view', 'user'));

}

public function offlinepayoutcourses($id)
{
		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/CSOFL/".$rand."/".$csdate;
		$user = Others::find(Auth::user()->id);
		$view = '';
		$no = '';

	$getphotosession = DB::table('courses')->where('id', '=', $id)->first();

	$offlinepay = new offlinepayoutcourses;
	$offlinepay->course_id = $id;
	$offlinepay->amount = $getphotosession->price;
	$offlinepay->user_id = Auth::user()->id;
	$offlinepay->ref_id = $code;
	$offlinepay->save();

	$view .= "<div class='col-lg-6'>
				<img src='/img/afrodiasy.png' class='img-responsive'>
				</div>
				<div class='col-lg-12'>
				
				<div class='col-lg-6'>
				<p>Bank: Guarantee Trust Bank (Gtb)<p>
				<p>Account name: Kajandi Limited</p>
				<p>Account number : 0229313812
				</div>
				<div class='col-lg-6'>
				<br>
				<br>
				<h4>Payment for ".$getphotosession->title."</h4>
				<p>Total Amount: <strong>".number_format($getphotosession->price)."</strong></p>
				<p>Sender name: <strong>$code</strong></p>
				</div>
				<div class='row'>
				<div class='col-lg-6'>
					<p><b>Note: you must include your name and sender name code on the space provided in your bank slip</b></p>
				</div>
			</div>";
			$view .=	"<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Photosession</th>
								<th>Duration</th>
								<th>Location</th>
							</tr>
						</thead>
						
						<tbody>";
							# code...
							$no += 1;
						$view .= "<tr>
									<td>$no</td>
									<td>".$getphotosession->title."</td>
									<td>".$getphotosession->duration."</td>
									<td>".$getphotosession->location."</td>
								</tr>";
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";

		return View::make('others/offlinepayoutcourses')->with(compact('view', 'user'));

}

public function offlinepayoutservices($id)
{
		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/SVOFL/".$rand."/".$csdate;
		$user = Others::find(Auth::user()->id);
		$view = '';
		$no = '';

	$getphotosession = DB::table('servicemarketplace')->where('id', '=', $id)->first();

	$offlinepay = new offlinepayoutservices;
	$offlinepay->service_id = $id;
	$offlinepay->amount = $getphotosession->price;
	$offlinepay->user_id = Auth::user()->id;
	$offlinepay->ref_id = $code;
	$offlinepay->save();

	$view .= "<div class='col-lg-6'>
				<img src='/img/afrodiasy.png' class='img-responsive'>
				</div>
				<div class='col-lg-12'>
				
				<div class='col-lg-6'>
				<p>Bank: Guarantee Trust Bank (Gtb)<p>
				<p>Account name: Kajandi Limited</p>
				<p>Account number : 0229313812
				</div>
				<div class='col-lg-6'>
				<br>
				<br>
				<h4>Payment for ".$getphotosession->name."</h4>
				<p>Total Amount: <strong>".number_format($getphotosession->price)."</strong></p>
				<p>Sender name: <strong>$code</strong></p>
				</div>
				<div class='row'>
				<div class='col-lg-6'>
					<p><b>Note: you must include your name and sender name code on the space provided in your bank slip</b></p>
				</div>
			</div>";
			$view .=	"<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Photosession</th>
								<th>Duration</th>
								<th>Location</th>
							</tr>
						</thead>
						
						<tbody>";
							# code...
							$no += 1;
						$view .= "<tr>
									<td>$no</td>
									<td>".$getphotosession->name."</td>
									<td>".$getphotosession->duration."</td>
									<td>".$getphotosession->location."</td>
								</tr>";
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";

		return View::make('others/offlinepayoutcourses')->with(compact('view', 'user'));

}

public function job()
{
	$getjob = DB::table('job')->where('status', '=', 'activated')->where('visibility', '!=', 'none')->orderBy('job.id','DESC')->get();
	$getjobcount = DB::table('job')->where('status', '=', 'activated')->where('visibility', '!=', 'none')->count();
	$view = '';
	
		$num = $getjobcount/6;
	$val = ceil($num);
	$view .= "<ul class='paginate' style='list-style-type:none'>";
	foreach ($getjob as $key) {
		$users = User::find($key->user_id);
		
     $view .= "<li>
     			<div class='row'>
                <div class='col-lg-12'>
                    <div class='row casting-bg'>
                        <div class='col-lg-4'>";
                        	
		    		$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '150px', 'Height' => '100px', 'class' => 'img-responsive'));
		    						    				
              $view .= "</div>
                        <div class='col-lg-5 photo-bg' style='padding-top: 20px; padding-left: 20px;'>
                            <a href=''><h5>".$key->title."</h5></a>
                            <h5>Professional Required:<span class='photo-div'> ".$key->user_spec."</span></h5>
                            <h5>Posted by: <a href=/others/showprofile/".$users->Others->user_id.">".$users->Others->agentName."</a></h5>
                            <h5>Location: <span class='photo-div'>".$key->location."</span></h5>
                        </div>
                        <div class='col-lg-3'>
                        <br>
                            <h3 style='color: #333'><img src='/img/nigeria-naira-currency-symbol.png' class='img-responsive' style='width: 11%; float: left;'> ".number_format($key->amount)."</h3>
                            <a href=jobdetails/".$key->id." class='btn btn-default btn-xs' style='background-color: #54d7e3; color: #fff;'>MORE DETAILS</a>
                        </div>
                    </div>
                </div>
                </div><br><br>
                <li>";
               }
    	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 10,
		    limitPagination: $val
			})
			</script>";

			if (!empty(Auth::user()->id)) {
				# code...
				$getnotifyunseen = $this->getunseen();
				$userAuth = Auth::user()->id;
			}else{
			$getnotifyunseen = '';
			$userAuth = '';	
			}
	

	return View::make('layouts/job')->with(compact('view', 'getnotifyunseen'));
}

public function jobdetails($id)
{
	$id = $id;
	$castdtl = DB::table('job')->where('id', '=', $id)->get();

	foreach($castdtl as $cast){
	$daycast = $cast->jobDay;
	$monthcast = $cast->jobMonth;
	$yearcast = $cast->jobYear;
	$day = $cast->Dayexp;
	$month = $cast->monthexp;
	$year = $cast->yearexp;
	}


	$date1 = strtotime("$yearcast-$monthcast-$daycast");	
	$datecast = date('l, j F Y', $date1);

	$date = strtotime("$year-$month-$day");
	$closedate = date('l, j F Y', $date);

	if (isset(Auth::user()->id)) {
		# code...

	$user = User::find(Auth::user()->id);
	$user_type = $user->user_type;
	$user_type_spec = '';
	switch ($user_type) {
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
		$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

	$getapply = DB::table('jobtable')->where('job_id', '=', $id)->where('user_id', '=', Auth::user()->id)->get();
	if (is_null($user_type_spec)) {
		$btn = "";
	}elseif($getapply) {
		# code...

		$btn = "<button class='btn btn-primary'>Applied Already</button>";
	}else{
		$btn = $this->invitebtn($id);
	}
	}else{
		$btn = "<a href='/signup' class='btn btn-primary btn-md'>signin or signup to apply</a>";		
	}

	if (!empty(Auth::user()->id)) {
				# code...
				$getnotifyunseen = $this->getunseen();
				$userAuth = Auth::user()->id;
			}else{
			$getnotifyunseen = '';
			$userAuth = '';	
			}

	return View::make('layouts/jobdetails')->with(compact('castdtl', 'closedate', 'btn', 'id', 'datecast', 'getnotifyunseen'));

}

public function invitebtn($id)
{
	$btn = "";

	$user = User::find(Auth::user()->id);
	$user_type = $user->user_type;
	$user_type_spec = '';

	switch ($user_type) {
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
		$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

	$getjobcreator = DB::table('job')->where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->get();
	$getjob = DB::table('job')->where('id', '=', $id)->first();
	if ($getjobcreator) {
		$btn = "";
	}else{
		if ($getjob->user_spec == 'all' && $user_type != 'proModel' && $user_type != 'newFace') {
			$btn = "<button class='btn btn-primary jobapply' id=$id>Apply for Job</button>";
		}elseif($getjob->user_spec == $user_type_spec){
			$btn = "<button class='btn btn-primary jobapply' id=$id>Apply for Job</button>";
		}else{
			$btn = "<button class='btn btn-primary'>Unable to Apply</button>";
		}
	}
	return $btn;
}

public function applyjob()
{
	sleep(2);
	$id = $_GET['val'];
	$cast = $id;
	$addcast = '';
	$casttable = new jobtable;
	$casttable->job_id = $cast;
	$casttable->user_id = Auth::user()->id;
	$casttable->jobRequest = 'request';
	$casttable->save();
	echo "<p class='bg-primary' style='padding: 10px'>User Applied</p>";

}

public function sendmsg()
{

	$msg = $_GET['msg'];
	$user_id = Auth::user()->id;

	$user = $_GET['user'];
	$vals = $_GET['val'];

	$val = '';
    foreach ($user as $key => $value) {
	foreach ($value as $use) {
		$val .= $use;

		}
	}

	$pieces = explode($vals, $val);

	foreach ($pieces as $key => $users){
		if (!empty($users)) {
			# code...
		$castmessage = new castmessage;
	$castmessage->sender = $user_id;
	$castmessage->reciever = $users;
	$castmessage->message = $msg;
	$castmessage->msgdate = date('Y-m-d');
	$castmessage->save();
	

	$notify = DB::table('notification')->where('name', '=', 'message')->first();

		  $modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $users;
	$modeldata->status = 'active';
	$modeldata->date = date('Y-m-d');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

			# code...
	}
	}

	echo "<p class='bg-success' style='padding: 10px'>Message Sent Successfully</p>";
}



}