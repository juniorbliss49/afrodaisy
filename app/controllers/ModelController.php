<?php

use Illuminate\Support\Facades\Input;


use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

class ModelController extends BaseController{


public function welcome()
{
	$models = 'granted';
	Session::set('models', $models);
	$dis = DB::table('categories')->get();
	$getnotifyunseen = '';
	return View::make('models/welcome')->with(compact('models', 'dis', 'getnotifyunseen'));
}

public function create()
{ 


	$data = Input::all();

		$validator = Validator::make($data,  NewModel::$model_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

		$user_id = Auth::user()->id;
		$catlist = Input::get('cat');

		$category = new Catid;

		$day = Input::get('DayofBirth');
		$month = Input::get('MonthofBirth');
		$year = Input::get('YearofBirth');

		$birthdate = $year."-".$month."-".$day;

	$model = DB::table('models')->where('user_id', '=', Auth::user()->id)->first();

  //get age from date or birthdate
  if(date("md", date("U", mktime(0, 0, 0, @$day, @$month, @$year))) > date("md"))
    {
      $age = ((date("Y") - @$year) - 1);
    }
    else{
      $age = (date("Y") - @$year);
}


		$model = new NewModel;
		$model->user_id = $user_id;
		$model->firstName = Input::get('firstName');
		$model->lastName = Input::get('lastName');
		$model->displayName = Input::get('displayName');
		$model->gender = Input::get('gender');
		$model->country = Input::get('country');
		$model->phone = Input::get('phone');
		$model->altPhone = Input::get('altPhone');
		$model->Age = $age;
		$model->Height = Input::get('Height');
		$model->about = Input::get('about');
		$model->birthdate = $birthdate;
		$model->DayofBirth = $day;
		$model->MonthOfBirth = $month;
		$model->YearofBirth = $year;
		$model->location = Input::get('location');
		$model->town = Input::get('town');
		$model->save();

     	 $csdate = date('Y');
   		 $rand = mt_rand(1000000,9999999);

   		 $emailverification = new emailverification;
   		 $emailverification->user_id = $user_id;
   		 $emailverification->code = $rand.$csdate;
   		 $emailverification->save();

   		 $code = $rand.$csdate;
   		 $url=Auth::user()->id."/".$code;

   		 Mail::send('emails.welcome', array('url' => $url, 'user' => Input::get('displayName')), function($message)
		{
			$message->from('info@Afrodaisy.com', 'Afrodaisy');
		    $message->to(Auth::user()->email)->subject('Welcome!');
		    
		});

		for ($i = 0; $i < count($catlist); ++$i) {


		$add = Catid::create(array('user_id' => $user_id, 'cat_id' => $catlist[$i] ));		
    }

		$access = 'granted';
		$user = NewModel::find(Auth::user()->id);
		return Redirect::to('models/changesubscription');


	# code...
}
public function changesubscription()
	{
		# code...
		Session::forget('otherspage');
		Session::forget('modelspage'); 
		Session::forget('models');
		Session::forget('others');
		Session::forget('category');
		$subscribe = 'granted';
		Session::set('subscribe', $subscribe);
		$user = User::find(Auth::user()->id);
		$getnotifyunseen = '';
		return View::make('models.changesubscription')->with(compact('user', 'getnotifyunseen'));
	}
public function changeplan($id)
	{
		# code...
		$user_id = Auth::user()->id;
    	$status = 'active';
    	$startdate = time();

    	$dateFrom = $startdate;
    	$month = date('m', $startdate);
	  $day = date('d', $startdate);
	  $year = date('Y', $startdate);

    	$dateplan = $this->calculate_next_year($startdate);

    	$date = time($dateplan);
		$Expyear = date('Y', $dateplan);
		$Expmonth = date('m', $dateplan);
		$Expday = date('d', $dateplan);

		$dateplans = $dateplan;

		$startdates = strtotime("$year-$month-$day");

$getUserPlan = DB::table('usersplan')->where('user_id', '=', $user_id)->get();
if ($getUserPlan) {
	# code...
}else{
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
return Redirect::to('models/photoupload');
	}

public function uploadphoto()
{
	Session::forget('models');
	$users = User::find(Auth::user()->id);
	$Discipline = DB::table('disciplines')->get();
	$userplan = DB::table('usersplan')->where('usersplan.user_id', '=', Auth::user()->id)->Join('limitation', 'usersplan.plan_id', '=', 'limitation.plan_id')->get();
		foreach ($userplan as $key) {
			$plan = $key->cat_select;
		}
		Session::forget('otherspage');
		Session::forget('modelspage'); 
		Session::forget('models');
		Session::forget('others');
		Session::forget('subscribe');
		$photoupload = 'granted';
		Session::set('photoupload', $photoupload);
	$user = $users->NewModel->displayName;
	$getnotifyunseen = '';
	return View::make('models/photoupload', compact('user', 'Discipline', 'plan', 'getnotifyunseen'));
}
public function uploadImage()
{

	$data = Input::all();
	$catlist = Input::get('category');

		$validator = Validator::make($data,  photoupload::$rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

			$user_id = Auth::user()->id;
			if(Input::hasFile('image')){

				$getuser = DB::table('photoupload')->where('user_id', '=', $user_id)->get();
				if ($getuser) {
					# code...
				}else{

			$imageclass = new photoupload;
			$image = Input::file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('img/profile/' . $filename);
			Image::make($image->getRealPath())->save($path);
			$imageclass->user_id = $user_id;
			$imageclass->image_type = Input::get('image_type');
			$imageclass->imagename = 'img/profile/'.$filename;
			$imageclass->image_desc = 'profileImage';;
			$imageclass->save();

			 $imagegallery = new imagegallery;
		     $imagegallery->user_id = Auth::user()->id;
		     $imagegallery->imagename = 'img/profile/'.$filename;
		     $imagegallery->save();
		     $img_id = $imagegallery->id;
		     }
}

			$userplan = DB::table('usersplan')->where('usersplan.user_id', '=', Auth::user()->id)->where('status', '=', 'active')->Join('limitation', 'usersplan.plan_id', '=', 'limitation.plan_id')->first();
			
			if ($userplan) {
				# code...
				$plan = $userplan->cat_select;
			}else{
				$plan = 4;
					
			}

			for ($i = 0; $i < $plan; ++$i) {
				$selectcat = distable::where('user_id', '=', $user_id)->where('dis_id', '=', $catlist[$i])->count();
				if ($selectcat > 0) {
				distable::where('user_id', '=', $user_id)->where('dis_id', '=', $catlist[$i])->update(array('dis_id' => $catlist[$i]));	
				}else{
					$add = distable::create(array('user_id' => $user_id, 'dis_id' => $catlist[$i]));			
				}		
		    }

		    $modelspage = 'modelspage';
			Session::set('modelspage', $modelspage);
			$user = User::find(Auth::user()->id);
			return Redirect::to('models/dashboard');	
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
			$countVal = '';
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
			
		$url = $this->getProfile($key->user_id);

			$getfoto = DB::table('photoupload')->where('user_id', '=', $key->user_id)->first();
			$user = "<a href=$url>
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
			$user = "<a id=$id href=/users/imagecomment/$getimagelike->imageid>
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
										<h6 style='font-size: 12px; color: #333; font-weight: bold'>Cast: ".str_limit($getcast->castTitle, $limit = 15, $end = '...')."</h6>
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
			$user = "<a href=/others/showcastdetail/".$getcast->cast_id.">
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

		$fol = DB::table('notificationtable')->where('NotId', '=', $id)->where('rcv_id', '=', Auth::user()->id)->first();
		if ($fol->user_id == Auth::user()->id) {
			$user = '';
		}else{

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
						  </a>";
	}
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

	$getcomm = DB::table('notifycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();

		if ($getcomm->sender_id == Auth::user()->id) {
			# code...
			$user = '';
		}else{

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
			$getdata = DB::table('statuscomment')->where('id', '=', $gtfollow->commId)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=/users/comment/$getdata->statusId >
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
						  </a>";
	}
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

	$fol = DB::table('notifyreplycomment')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('sender_id', '!=', Auth::user()->id)->count();
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
			$getcomm = DB::table('replycomment')->where('id', '=', $gtfollow->replyId)->first();
			$getdata = DB::table('statuscomment')->where('id', '=', $getcomm->commentId)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=/users/comment/$getdata->statusId>
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

	$fol = DB::table('notifystatuslike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('sender_id', '!=', Auth::user()->id)->count();
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
			$getlike = DB::table('statuslike')->where('id', '=', $gtfollow->statusId)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=/users/comment/$getlike->statusId>
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

	$fol = DB::table('notifycommentlike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('sender_id', '!=', Auth::user()->id)->count();
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
			$getlike = DB::table('commentlike')->where('id', '=', $gtfollow->commentId)->first();
			$getdata = DB::table('statuscomment')->where('id', '=', $getlike->commId)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=/users/comment/$getdata->statusId>
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
				$getinsert2 = DB::table('notifycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('seen', '=', '')->update(array('seen' => 'seen'));
			}else{

			}
		$getinsert3 = DB::table('notifycommentimg')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
		$gtimglink = DB::table('imagecomment')->where('id', '=', $getinsert3->commId)->first();
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					
			$user = "<a href=/users/imagecomment/$gtimglink->imageid>
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
					$getimagelink2 = DB::table('imagecomment')->where('id', '=', $getimagecomment->commentId)->first();
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					$id = $getimagelink2->imageid;
			$user = "<a href=/users/imagecomment/$getimagelink2->imageid>
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
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span> Replied your comment</p>
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
					$getimagecomment = DB::table('imagecommentlike')->where('id', '=', $getimagelike->commentId)->first();
					$getfoto = DB::table('photoupload')->where('user_id', '=', $getimagelike->sender_id)->first();
					$getdata = DB::table('imagecomment')->where('id', '=', $getimagecomment->commId)->first();
					
			$user = "<a href=/users/imagecomment/$getdata->imageid>
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
										<p style='font-size: 12px; color: #333; font-weight: bold'><span class='glyphicon glyphicon-comment' style='color:orange'></span>Liked your Comment</p>
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
			$user = "<a href=/users/imagecomment/$getimagelink2->imageid>
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

	$fol = DB::table('notifyreplylike')->where('NotId', '=', $id)->where('user_id', '=', Auth::user()->id)->where('sender_id', '!=', Auth::user()->id)->count();
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

	$getcommdtl = DB::table('replylike')->where('id', $gtfollow->replyId)->first();
	$getcommdtl2 = DB::table('replycomment')->where('id', $getcommdtl->replyId)->first();

			$getfoto = DB::table('photoupload')->where('user_id', '=', $gtfollow->sender_id)->first();
			$url = $this->getProfile($gtfollow->sender_id);
			$user = "<a href=/users/comment/$getcommdtl2->commentId>
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
											<p><span class='dash-name'>Posted By :".str_limit($name, $limit = 10, $end = '...')."</span></p>
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

			if (Auth::user()->user_type == 'newFace' || Auth::user()->user_type == 'proModel') {
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
			case '7':
			$countVal .= $this->gtUpcomingcast($key->id);
				# code...
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
			}else{
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

public function dashboard()
{
	# code...

	Session::forget('otherspage');
		Session::forget('photoupload'); 
		Session::forget('models');
		Session::forget('others');
		Session::forget('subscribe');
		Session::forget('category');
	$modelspage = 'modelspage';
	Session::set('modelspage', $modelspage);
	$values = '';

	$model = DB::table('models')->where('user_id', '=', Auth::user()->id)->first();

	$getStatus = DB::table('status')->orderBy('id','DESC')->take(3)->get();
	$view = '';
	foreach ($getStatus as $key) {

		$following = $key->user_id;
		$user = Auth::user()->id;
		$getfol = DB::table('castfollowers')->orwhere(function($query1) use ($user, $following){
		$query1
		->where('follower', $user)
		->where('following', $following);				
		})->get();
		if ($getfol || $key->user_id == Auth::user()->id) {
			# code...
		

		$user = User::find($key->user_id);
		if (empty($user->NewModel->displayName)) {
			# code...
			$name = $user->Others->agentName;
		}else{
			$name = $user->NewModel->displayName;
		}
		$view .= "<div class='col-lg-12'>
								<a href=/users/comment/$key->id>
									<div class='row dash-thumb'>
									<div class='col-lg-2 text-left'>";
							if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px', 'class'=>'img-responsive'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
									}
							$view	.=	"</div>
										<div class='col-lg-10'>
										<div class='img-cont'>
											<p class='dash-title'>".str_limit($key->status, 20, $end = '...')."</p>
											<br>
											<p><span class='dash-name'>".$name."</span> <span class='dash-date'>Posted: ".$key->date."</span></p>
										</div>
										</div>
									</div>
								</a>
								</div>";
		}else{
			$view .= '';
		}

	}

	$status = $this->getfollowersupdate();

	//get marketplace
	$marketplace = "<div class='col-lg-12'>
						<h4>Next Marketplace sessions</h4>
						<hr>
						<table class='table table-striped dash-table'>";
	$getservice = DB::table('servicemarketplace')->where('status', '=', 'active')->orderBy('id', 'DESC')->take(2)->get();
	foreach ($getservice as $key) {
		# code...

			$marketplace .=	"<tr>
					<td><a class='dash-lnk' href=/services/details/$key->id>".str_limit($key->description, 20, $end = '...')."</a></td>
					<td>$key->location, $key->country</td>
					<td><a class='dash-lnk' href=/services/details/$key->id>View</a></td>
				</tr>";
								
	}

		$getcourse = DB::table('courses')->where('status', '=', 'active')->orderBy('id', 'DESC')->take(2)->get();
	foreach ($getcourse as $key) {
		# code...

			$marketplace .=	"<tr>
					<td><a class='dash-lnk' href=/courses/details/$key->id>".str_limit($key->title, 20, $end = '...')."</a></td>
					<td>$key->location, $key->country</td>
					<td><a class='dash-lnk' href=/courses/details/$key->id>View</a></td>
				</tr>";
								
	}

		$getphoto = DB::table('photosession')->where('status', '=', 'active')->orderBy('id', 'DESC')->take(2)->get();
	foreach ($getphoto as $key) {
		# code...

			$marketplace .=	"<tr>
					<td><a class='dash-lnk' href=/photosession/course/$key->id>".str_limit($key->title, 20, $end = '...')."</a></td>
					<td>$key->location, $key->country</td>
					<td><a class='dash-lnk' href=/photosession/course/$key->id>View</a></td>
				</tr>";
								
	}

	$marketplace .= "</table>
						</div>";


  //get age from date or birthdate
  if(date("md", date("U", mktime(0, 0, 0, @$model->DayofBirth, @$model->MonthOfBirth, @$model->YearofBirth))) > date("md"))
    {
      $age = ((date("Y") - @$model->YearofBirth) - 1);
    }
    else{
      $age = (date("Y") - @$model->YearofBirth);
}

	$models = DB::table('models')->where('user_id', '=', Auth::user()->id)->update(array('Age' => $age));

	#to fetch models
	$models = DB::table('models')->where('models.user_id', '!=', Auth::user()->id)->orderBy('models.id','DESC')->Join('verificationtable', 'models.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', 'yes')->Join('users', 'models.user_id', '=', 'users.id')->where('users.user_type', '=', 'proModel')->orwhere('users.user_type', '=', 'newFace')->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->where('photoupload.image_type', '=', 'profileImage')->take(4)->get();
	#to fetch cast
	$castget = DB::table('casting')->orderBy('id','DESC')->where('status', 'activated')->take(5)->get();

	if ($castget) {
		foreach ($castget as $key) {

        $values        .=   "<tr>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>$key->castTitle </a></td>
										<td>$key->location</td>
										<td><a class='dash-lnk' href=/others/showcastdetail/$key->id>View</a></td>
									</tr>";

			
		}
	}


	$user = User::find(Auth::user()->id);
	$userAuth = Auth::user()->id;
	$verification = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();
	$getnotifyunseen = $this->getunseen();
	$getcastunseen = $this->getcastunseen(); 
	$getmsgunseen = $this->getmsgunseen();
	return View::make('models.dashboard')->with(compact('status', 'marketplace', 'user', 'models', 'values', 'verification', 'getnotifyunseen', 'userAuth', 'getcastunseen', 'getmsgunseen'));



}

public function profile($id)
{

	$user = User::find($id);
	$user_type = $user->user_type;
	switch ($user_type) {
		case 'proModel':
			$user_type_spec = 'Profession model';
			break;
		case 'newFace':
			$user_type_spec = 'New Face (aspiring model)';
			break;
		default:
			# code...
			break;
	}

		$model = DB::table('models')->where('user_id', '=', $id)->first();

  //get age from date or birthdate
  if(date("md", date("U", mktime(0, 0, 0, @$model->DayofBirth, @$model->MonthOfBirth, @$model->YearofBirth))) > date("md"))
    {
      $age = ((date("Y") - @$model->YearofBirth) - 1);
    }
    else{
      $age = (date("Y") - @$model->YearofBirth);
}

	$models = DB::table('models')->where('user_id', '=', $id)->update(array('Age' => $age));



	$id = $id;
	if (isset(Auth::user()->id)) {
		# code...
	$user_id = Auth::user()->id;
	$btn = castlikes::where('likessender', '=', $user_id)->where('likesreciever', '=', $id)->count();

	if ($btn < 1) {
		$btns = '2';
	}else{
		$btns = '1';
	}

	$btnfol = castfollowers::where('follower', '=', $user_id)->where('following', '=', $id)->count();

	if ($btnfol < 1) {
		$btnfols = '2';
	}else{
		$btnfols = '1';
	}

	if ($id != $user) {

		# code...
	$dates = date('d-m-Y');
	$times = date('g:i A');

  	$date = $dates;

	$notify = DB::table('notification')->where('name', '=', 'viewedProfile')->first();
	$notifyId = $notify->id;

$selectData = DB::table('notificationtable')->where('rcv_id', '=', $id)->where('user_id', '=', Auth::user()->id)->where('date', '=', $date)->count();

if ($id != Auth::user()->id) {

	if ($selectData < 1) {
		# code...
	
	# code...

  	//to save it in Model Notification table

  		# code...

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $id;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;
//
	$notificationtable = new notificationtable;
	$notificationtable->notify_id = $notify->id;
	$notificationtable->NotId = $ModelNotId;
	$notificationtable->user_id = Auth::user()->id;
	$notificationtable->rcv_id = $id;
	$notificationtable->date = $date;
	$notificationtable->time = $times;
	$notificationtable->save();

	}
	}
}
$getnotifyunseen = $this->getunseen();
}
//get images
$images = DB::table('imagegallery')->where('user_id', '=', $id)->get();
$viewimg = '';


if(isset($images)){

	if (isset(Auth::user()->id)) {
	# code...


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
            <ul id='captions' class='list-unstyled row grid'>";
			foreach($images as $image){
$viewimg  .= "<li class='grid-item' data-responsive=/$image->imagename data-src=/$image->imagename data-sub-html=#caption$image->id>
					<a href>
                        <img src=/$image->imagename width=185px>
                    </a>
                	</li>";
			}
$viewimg   .=  "</ul>
            </div>";
}else{
	$viewimg  .="<div class='demo-gallery' style='width: auto; position: relative'>
            <ul id='captions' class='list-unstyled row grid'>";
			foreach($images as $image){
$viewimg  .= "<li class='grid-item' data-responsive=/$image->imagename data-src=/$image->imagename data-sub-html=#caption$image->id >
                    <a href>
                        <img src=/$image->imagename width=180px>
                    </a>
                	</li>";
			}
$viewimg   .=  "</ul>
            </div>";
}
}
	$getlike = castlikes::where('likesreciever', '=', $id)->get();
	$usershow = '';
	foreach ($getlike as $key) {
		$userlike = User::find($key->likessender);
		if (!empty($userlike->NewModel->displayName)) {
			$usershow .= $userlike->NewModel->displayName.", ";
		}else{
			$usershow .= $userlike->Others->agentName.", ";
		}
	}


	$like = castlikes::where('likesreciever', '=', $id)->count();	
	$fol = castfollowers::where('following', '=', $id)->count();
	$dis = distable::where('user_id', '=', $id)->JOIN('disciplines', 'distable.dis_id', '=', 'disciplines.id')->get();
	$cat = Catid::where('user_id', '=', $id)->JOIN('categories', 'catinput.cat_id', '=', 'categories.id')->get();
	$follower = castfollowers::where('follower', '=', $id)->count();
	$verify = DB::table('verificationtable')->where('user_id', '=', $id)->first();
	return View::make('models.profile')->with(compact('user', 'user_type_spec', 'id','btns', 'btnfols', 'like', 'fol', 'dis', 'cat', 'getnotifyunseen', 'follower', 'verify', 'images', 'viewimg', 'usershow'));
	
}



public function edit()
{
	$user = User::find(Auth::user()->id);
	$Models = NewModel::where('user_id','=', Auth::user()->id)->first();

	$bankdetails = DB::table('bankdetails')->where('user_id', '=', Auth::user()->id)->first();

	$Discipline = DB::table('disciplines')->get();
		$userplan = DB::table('usersplan')->where('usersplan.user_id', '=', Auth::user()->id)->where('status', '=', 'active')->Join('limitation', 'usersplan.plan_id', '=', 'limitation.plan_id')->first();
			
			if ($userplan) {
				# code...
				$plan = $userplan->cat_select;
			}else{
				$plan = '4';
					
			}


	$getCategory = DB::table('distable')->where('user_id', '=', Auth::user()->id)->get();
	$modelpreferenceid = DB::table('modelpreference')->where('modelId', '=', Auth::user()->id)->first();
	if ($modelpreferenceid) {
		# code...
		$modelpreference = $modelpreferenceid;
	}else{
		$modelpreferenceid = new modelpreference;
		$modelpreferenceid->prefId = 1;
		$modelpreferenceid->modelId = Auth::user()->id;
		$modelpreferenceid->save();
		$prefId = $modelpreferenceid->id;

		$getpref = DB::table('modelpreference')->where('id', $prefId)->first();
		$modelpreference = $getpref;
	}

	$getgallery = DB::table('imagegallery')->where('user_id', '=', Auth::user()->id)->get();
	$selecat = DB::table('disciplines')->get();
	$viewimg = '';
	if ($getgallery) {
		foreach($getgallery as $image){

	# code...
$viewimg .= "<div id='caption$image->id' style='display:none'>
				<button class='btn btn-xs btn-warning delpix' id=$image->id><i class='fa fa-trash-o'></i> Delete</bottun><button class='btn btn-xs btn-primary setprofile' id=$image->id><i class='fa fa-user'></i> Set as Profile Picture</button>
				<select style='color: #000; padding: 4px; margin-top: 5px' class='selcat' id=$image->id>";
	$viewimg .= "<option value=''>Select image category</option>";
				foreach ($selecat as $key) {
					$getimg = DB::table('imagecategory')->where('user_id', '=', Auth::user()->id)->where('imageid', '=', $image->id)->where('disid', '=', $key->id)->get();
				if ($getimg) {
	$viewimg .= "<option value=$key->id selected=selected>$key->name</option>";
				}else{
	$viewimg .= "<option value=$key->id>$key->name</option>";
			}
				}
					
	$viewimg .=	"</select>
				<span style='display:none; background-color: green' class='badge showbg$image->id'><i class='fa fa-check'></i> </span>
			  </div>";
		# code...
	
}

	# code...
$viewimg  .="<div class='demo-gallery' style='width: auto; position: relative'>
            <ul id='captions' class='list-unstyled row'>";
			foreach($getgallery as $image){
$viewimg  .= "<li class='grid-item col-sm-3' style='cursor: pointer; width: 180px;' data-responsive=/$image->imagename data-src=/$image->imagename data-sub-html=#caption$image->id id=pix$image->id>
					<a href>
                        <img src=/$image->imagename class='img-responsive' style='width: 180px; height: 180px'>
                    </a>
                	</li>";
			}
$viewimg   .=  "</ul>
            </div>";
		# code...
	
	}

	$getDiscipline = DB::table('categories')->get();
	$getDisVal = DB::table('catinput')->where('user_id', '=',  Auth::user()->id)->get();
	$getnotifyunseen = $this->getunseen();
	$userAuth = Auth::user()->id;
	$getcastunseen = $this->getcastunseen();
	$getmsgunseen = $this->getmsgunseen();
	$getverify = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();
	return View::make('models.edit')->with(compact('user', 'bankdetails', 'Models', 'Discipline', 'getcastunseen', 'getmsgunseen', 'plan', 'modelpreference','getCategory', 'getDiscipline', 'getnotifyunseen', 'getDisVal', 'userAuth', 'viewimg', 'getverify'));
}

public function setcategory()
{
	$pix_id = $_GET['pix_id'];
	$val = $_GET['val'];
	$insertuser = DB::table('imagecategory')->where('user_id', '=', Auth::user()->id)->where('disid', '=', $val)->get();
	if ($insertuser) {
		# code...
		$insertuser = DB::table('imagecategory')->where('user_id', '=', Auth::user()->id)->where('disid', '=', $val)->delete();
			$imagecategory  = new imagecategory;
		$imagecategory->user_id = Auth::user()->id;
		$imagecategory->imageid = $pix_id;
		$imagecategory->disid = $val;
		$imagecategory->save();
	}else{
		# code...
		$imagecategory  = new imagecategory;
		$imagecategory->user_id = Auth::user()->id;
		$imagecategory->imageid = $pix_id;
		$imagecategory->disid = $val;
		$imagecategory->save();
	}
}

public function edituser()
{
	# code...
	$user_id = Auth::user()->id;
	$data = Input::all();

		$validator = Validator::make($data,  NewModel::$editusers);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

	$getdata = NewModel::where('user_id', '=', Auth::user()->id)->first();

	if ($getdata->phone == Input::get('phone')) {
		
	}else{
		$update = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->update(array('mobile' => ''));
	}

	$affectedRows = NewModel::where('user_id', '=', $user_id)->update(array('firstName' => Input::get('firstName'),
					'lastName' => Input::get('lastName'),
					'displayName' => Input::get('displayName'),			
					'phone' => Input::get('phone'),		
					'country' => Input::get('country'),	
					'location' => Input::get('location'),
					'town' => Input::get('town'),
					'about' => Input::get('about'),
					'gender' => Input::get('gender'),
					'Height' => Input::get('Height')
					));
	$updated = "Personal updated successfully";

	return Redirect::back();

}

public function getlikedphots()
{
	# code...
	$user_id = Auth::user()->id;
	$getfollowers = DB::table('notification')->where('name', '=', 'likedPhotos')->first();
	$getnumber = '';

}

public function likeuser()
{
	$user = $_GET['user'];
	$user_id = Auth::user()->id;

	$castlikes = new castlikes;

	$dates = date('d-m-Y');
		  $times = date('g:i A');

  $date = $dates;
	$castlikes->likessender = $user_id;
	$castlikes->likesreciever = $user;
	$castlikes->month = date('m');
	$castlikes->year = date('Y');
	$castlikes->save();



$notify = DB::table('notification')->where('name', '=', 'likeUser')->first();

$selectLike = DB::table('notificationtable')->where('notify_id', '=', $notify->id)->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->count();

if ($selectLike > 0) {
	# code...
	$notification = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->first();

	$selLikeUsr = DB::table('modelnofity')->where('user','=', $user)->where('id', '=', $notification->NotId)->update(array('status' => 'active'));
}else{
//to save it in Model Notification table
$modeldata = new ModelNotify;
$modeldata->NotId = $notify->id;
$modeldata->user = $user;
$modeldata->status = 'active';
$modeldata->date = $dates;
$modeldata->save();
$ModelNotId = $modeldata->id;
//

//to save notification of liked users
	$notifyId = $notify->id;
	$notificationtable = new notificationtable;
	$notificationtable->notify_id = $notify->id;
	$notificationtable->NotId = $ModelNotId;
	$notificationtable->user_id = $user_id;
	$notificationtable->rcv_id = $user;
	$notificationtable->date = $date;
	$notificationtable->time = $times;
	$notificationtable->save();
//
}
}

public function dislikeuser()
{
	$user = $_GET['user'];
	$user_id = Auth::user()->id;


$dates = date('d-m-Y');
$times = date('g:i A');

$notify = DB::table('notification')->where('name', '=', 'DislikedUsers')->first();

$selectLike = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->count();

if ($selectLike > 0) {

	$notify = DB::table('notification')->where('name', '=', 'likeUser')->first();
	$notification = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->first();

//to make the like user inactive
	$notificationtable = new notificationtable;
	$selLikeUsr = DB::table('modelnofity')->where('user','=', $user)->where('id', '=', $notification->NotId)->update(array('status' => 'inactive'));
//
}else{
		$notify = DB::table('notification')->where('name', '=', 'likeUser')->first();
	$notification = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->first();

//to make the like user inactive
	$notificationtable = new notificationtable;
	$selLikeUsr = DB::table('modelnofity')->where('user','=', $user)->where('id', '=', $notification->NotId)->update(array('status' => 'inactive'));
//

//to save notification of liked users
	$notify = DB::table('notification')->where('name', '=', 'DislikedUsers')->first();
	$notificationtable = new notificationtable;
	$notificationtable->notify_id = $notify->id;
	$notificationtable->NotId = $notification->NotId;
	$notificationtable->user_id = $user_id;
	$notificationtable->rcv_id = $user;
	$notificationtable->date = $dates;
	$notificationtable->time = $times;
	$notificationtable->save();
//
}


	$castlikes = castlikes::where('likessender', '=', $user_id)->where('likesreciever', '=', $user)->delete();


}

public function following()
{
	$user = $_GET['user'];
	$user_id = Auth::user()->id;

	$dates = date('d-m-Y');
		  $times = date('g:i A');

  $date = $dates;

$notify = DB::table('notification')->where('name', '=', 'following')->first();

$selectLike = DB::table('notificationtable')->where('notify_id', '=', $notify->id)->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->count();

if ($selectLike > 0) {
	# code...
	$notification = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->first();

	$selLikeUsr = DB::table('modelnofity')->where('user','=', $user)->where('id', '=', $notification->NotId)->update(array('status' => 'active'));
}else{

  $modeldata = new ModelNotify;
$modeldata->NotId = $notify->id;
$modeldata->user = $user;
$modeldata->status = 'active';
$modeldata->date = $dates;
$modeldata->save();
$ModelNotId = $modeldata->id;



	$notify = DB::table('notification')->where('name', '=', 'following')->first();
	$notifyId = $notify->id;
	$notificationtable = new notificationtable;
	$notificationtable->notify_id = $notify->id;
	$notificationtable->NotId = $ModelNotId;
	$notificationtable->user_id = $user_id;
	$notificationtable->rcv_id = $user;
	$notificationtable->date = $date;
	$notificationtable->time = $times;
	$notificationtable->save();
}
	$castlikes = new castfollowers;

	$castlikes->follower = $user_id;
	$castlikes->following = $user;
	$castlikes->save();
}

public function unfollow()
{
	$user = $_GET['user'];
	$user_id = Auth::user()->id;

$notify = DB::table('notification')->where('name', '=', 'following')->first();

$selectLike = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->count();

if ($selectLike > 0) {

	$notify = DB::table('notification')->where('name', '=', 'following')->first();
	$notification = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->first();

//to make the like user inactive
	$selLikeUsr = DB::table('modelnofity')->where('user','=', $user)->where('id', '=', $notification->NotId)->update(array('status' => 'inactive'));
//
}else{

			$notify = DB::table('notification')->where('name', '=', 'unfollow')->first();
	$notification = DB::table('notificationtable')->where('user_id', '=', $user_id)->where('rcv_id', '=', $user)->where('notify_id', '=', $notify->id)->first();

//to make the like user inactive
	$notificationtable = new notificationtable;
	$selLikeUsr = DB::table('modelnofity')->where('user','=', $user)->where('id', '=', $notification->NotId)->update(array('status' => 'inactive'));

	$notify = DB::table('notification')->where('name', '=', 'unfollow')->first();
	$notificationtable = new notificationtable;
	$notificationtable->notify_id = $notify->id;
	$notificationtable->NotId = $notification->NotId;
	$notificationtable->user_id = $user_id;
	$notificationtable->rcv_id = $user;
	$notificationtable->date = $date;
	$notificationtable->time = $times;
	$notificationtable->save();
}

	$castlikes = castfollowers::where('follower', '=', $user_id)->where('following', '=', $user)->delete();

}

public function processcaststatus()
{
	# code...
	$getStatus = DB::table('modelnofity')->where('user', '=', Auth::user()->id)->where(function($query1){
			$query1
			->where('NotId', 8)
    		->orwhere('NotId', 9)
    		->orwhere('NotId', 14);				
			})->get();
	if ($getStatus) {
		# code...
		foreach ($getStatus as $key => $value) {
			# code...
			$gtstatus = DB::table('notifystatus')->where('user_id', '=', Auth::user()->id)->where('NotId', '=', $value->id)->count();
			if ($gtstatus < 1) {
				# code...
				$gtnot = DB::table('notifycaststatus')->where('user_id', '=', Auth::user()->id)->where('NotId', '=', $value->id)->first();

		$notifystatus = new notifystatus;
		$notifystatus->NotId = $value->id;
		$notifystatus->statusId = $gtnot->id;
		$notifystatus->user_id = Auth::user()->id;
		$notifystatus->date = date('Y-m-d');
		$notifystatus->save();
			}
		}
	}
}

public function message()
{
	$user = $_GET['user'];
	$msg = $_GET['msg'];
	$user_id = Auth::user()->id;

	$castmessage = new castmessage;
	$castmessage->sender = $user_id;
	$castmessage->reciever = $user;
	$castmessage->message = $msg;
	$castmessage->msgdate = date('Y-m-d');
	$castmessage->save();
	echo "message sent";

	$notify = DB::table('notification')->where('name', '=', 'message')->first();

		  $modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $user;
	$modeldata->status = 'active';
	$modeldata->date = date('Y-m-d');
	$modeldata->save();
	$ModelNotId = $modeldata->id;
}

public function getUserPlan($val)
{
	$month = date('m');
	$year = date('Y');
	$user_id = Auth::user()->id;
	$btn = '';
	$userplanval = '';
	$userplan = DB::table('usersplan')->where('usersplan.user_id', '=', $user_id)->Join('limitation', 'usersplan.plan_id', '=', 'limitation.plan_id')->get();
	$getcastApplication = DB::table('castapplication')->where('user_id', '=', $user_id)->where('month', '=', $month)->where('year', '=', $year)->count();

	foreach ($userplan as $key) {
		$userplanval = $key->cast_apply;
	}
	if ($userplanval == 'all') {
		$access = 'granted';
		$btn = "<button class='btn btn-default applyCast' data-dismiss='modal' id=".$val." style='background-color: #54d7e3; color: #fff;'>Apply</button>";
	}elseif (empty($userplanval)) {
		if ($getcastApplication) {
			if ($getcastApplication > 4) {
				$btn = "<a href='/users/changesubscription' class='btn btn-sm' style='color: red'>You have exhausted your cast for the month. Click to subscribe</a>";
			}else{
				$btn	= "<button class='btn btn-default applyCast' data-dismiss='modal' id=".$val." style='background-color: #54d7e3; color: #fff;'>Apply</button>";
			}
		}else{
			$btn	= "<button class='btn btn-default applyCast' data-dismiss='modal' id=".$val." style='background-color: #54d7e3; color: #fff;'>Apply</button>";
		}
	}
	else{
		if ($getcastApplication == $userplanval) {
			$access = 'notgranted';
		$btn = "<a href='/users/changesubscription' class='btn btn-sm' style='color: red'>You have exhausted your cast for the month click to subscribe</a>";
		}else{
		$btn	= "<button class='btn btn-default applyCast' data-dismiss='modal' id=".$val." style='background-color: #54d7e3; color: #fff;'>Apply</button>";
		}
	}
	return $btn;

}

public function castapplication() 
{
	$user_id = Auth::user()->id;
$view = '';
	
	//to get cast invitation
	$castnew = DB::table('casttable')->where('casttable.user_id', '=', $user_id)->where('casttable.castMethod', '=', 'invited')->where(function($query1){
		$query1
		->where('casttable.castStatus', '=', 'confirmed')
		->orwhere('casttable.castStatus', '=', '');				
		})->Join('casting', 'casttable.cast_id', '=', 'casting.id')->orderBy('casttable.id','DESC')->get();

	//get cast application
	$getcast = DB::table('casttable')->where('casttable.user_id', '=', $user_id)->where('casttable.castMethod', '=', '')->where('casting.status', '!=', 'declined')->where(function($query1){
		$query1
		->orwhere('casttable.castStatus', '=', 'confirmed')
		->orwhere('casting.status', '=', 'finished')
		->orwhere('casttable.castStatus', '=', '');				
		})->LeftJoin('castcheckout', 'casttable.cast_id', '=', 'castcheckout.cast_id')->Join('casting', 'casttable.cast_id', '=', 'casting.id')->orderBy('casttable.id','DESC')->groupBy('casttable.cast_id')->select('casttable.cast_id', 'casting.payDesc', 'casting.castImage', 'casting.castTitle', 'casting.location', 'casting.Yearend', 'casting.Monthend', 'casting.Dayend', 'casttable.castStatus', 'castcheckout.paidstatus' )->get();

	//to get cast application
	$castapply = DB::table('casttable')->where('casttable.user_id', '=', $user_id)->where('casttable.castRequest', '=', 'request')->Join('casting', 'casttable.cast_id', '=', 'casting.id')->get();

	//to get declined cast
	$castdeclined = DB::table('casttable')->where('casttable.user_id', '=', $user_id)->where('casttable.castStatus', '=', 'discarded')->Join('casting', 'casttable.cast_id', '=', 'casting.id')->get();
	//to get previous cast
	$castprevious = DB::table('casttable')->where('casttable.user_id', '=', $user_id)->where('castStatus', '=', 'confirmed')->Join('casting', 'casttable.cast_id', '=', 'casting.id')->where('casting.status', '=', 'finished')->get();

	$models = DB::table('models')->orderBy('models.id','DESC')->Join('users', 'models.user_id', '=', 'users.id')->where('users.user_type', '=', 'proModel')->orwhere('users.user_type', '=', 'newFace')->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->where('photoupload.image_type', '=', 'profileImage')->take(6)->get();

	//display getapply

$month = date('m');
$year = date('Y');
$day = date('d');

	foreach($getcast as $applied){

		if ($applied->Yearend >= $year) {
			if ($applied->Yearend == $year) {
				if ($applied->Monthend > $month) {
						#show
					if ($applied->castStatus == 'confirmed') {
			if ($applied->paidstatus) {
                        	# code...
            $btn = "<button data-toggle='modal' data-target='#myModal' class='btn btn-default viewcasts' style='background-color: #54d7e3; color: #fff;' id=$applied->cast_id>VIEW CAST</button>";
            }else{
            $btn = "<button class='btn btn-sm btn-warning'>Awaiting Payment</button>";	
            }
		}else{
			$btn = "<button class='btn btn-sm btn-danger'>Awaiting Approval</button>";
		}
		 
                        

		$getcancel = DB::table('castmodelcancel')->where('cast_id', '=', $applied->cast_id)->get();
		$amt = number_format($applied->payDesc);

    		$view .= "<div class='row casting-bg' id=cast".$applied->cast_id.">
	    				<div class='col-lg-2 col-sm-2'>";
	    					if(!empty($applied->castImage))
	    					{
                   $view .= HTML::image($applied->castImage ,'cast picture', array('width' => '130px'));
                        	}
                        	else{
					$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
							}
               $view .= "</div>
                        <div class='col-lg-7 col-sm-7' style='padding-top: 20px; padding-left: 50px;'>
                            <a href=/others/showcastdetail/$applied->cast_id>$applied->castTitle</a>
                            <h5>Location: $applied->location</h5>
                            <h5>Amount: $amt </h5>
                            <h5>Request Status: ";
                            if($getcancel){
                           $view .= "DISCARDED";
                        	}
                            else{
                           $view .= strtoupper($applied->castStatus);
                        	}
                           $view .= "</h5>
                            <br>
                            <br>
                        </div>
                        <div class='col-lg-3 col-sm-3'>
                        <br>
                        <br>
                        <br>$btn</div>
                   
	    			</div>
	    			<br>
	    			<br>";
				}elseif ($applied->Monthend == $month) {
					if ($applied->Dayend > $day) {
						#show
						if ($applied->castStatus == 'confirmed') {
			if ($applied->paidstatus) {
                        	# code...
            $btn = "<button data-toggle='modal' data-target='#myModal' class='btn btn-default viewcasts' style='background-color: #54d7e3; color: #fff;' id=$applied->cast_id>VIEW CAST</button>";
            }else{
            $btn = "<button class='btn btn-sm btn-warning'>Awaiting Payment</button>";	
            }
		}else{
			$btn = "<button class='btn btn-sm btn-danger'>Pending</button>";
		}
		 
                        

		$getcancel = DB::table('castmodelcancel')->where('cast_id', '=', $applied->cast_id)->get();
		$amt = number_format($applied->payDesc);

    		$view .= "<div class='row casting-bg' id=cast".$applied->cast_id.">
	    				<div class='col-lg-2 col-sm-2'>";
	    					if(!empty($applied->castImage))
	    					{
                   $view .= HTML::image($applied->castImage ,'cast picture', array('width' => '130px'));
                        	}
                        	else{
					$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
							}
               $view .= "</div>
                        <div class='col-lg-7 col-sm-7' style='padding-top: 20px; padding-left: 50px;'>
                            <a href=/others/showcastdetail/$applied->cast_id>$applied->castTitle</a>
                            <h5>Location: $applied->location</h5>
                            <h5>Amount: $amt </h5>
                            <h5>Request Status: ";
                            if($getcancel){
                           $view .= "DISCARDED";
                        	}
                            else{
                           $view .= strtoupper($applied->castStatus);
                        	} 
                           $view .= "</h5>
                            <br>
                            <br>
                        </div>
                        <div class='col-lg-3 col-sm-3'>
                        <br>
                        <br>
                        <br>$btn</div>
                   
	    			</div>
	    			<br>
	    			<br>";
					}
				}
			}else{
						#show
				if ($applied->castStatus == 'confirmed') {
			if ($applied->paidstatus) {
                        	# code...
            $btn = "<button data-toggle='modal' data-target='#myModal' class='btn btn-default viewcasts' style='background-color: #54d7e3; color: #fff;' id=$applied->cast_id>VIEW CAST</button>";
            }else{
            $btn = "<button class='btn btn-sm btn-warning'>Awaiting Payment</button>";	
            }
		}else{
			$btn = "<button class='btn btn-sm btn-danger'>Pending</button>";
		}
		 
                        

		$getcancel = DB::table('castmodelcancel')->where('cast_id', '=', $applied->cast_id)->get();
		$amt = number_format($applied->payDesc);

    		$view .= "<div class='row casting-bg' id=cast".$applied->cast_id.">
	    				<div class='col-lg-2 col-sm-2'>";
	    					if(!empty($applied->castImage))
	    					{
                   $view .= HTML::image($applied->castImage ,'cast picture', array('width' => '130px'));
                        	}
                        	else{
					$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
							}
               $view .= "</div>
                        <div class='col-lg-7 col-sm-7' style='padding-top: 20px; padding-left: 50px;'>
                            <a href=/others/showcastdetail/$applied->cast_id>$applied->castTitle</a>
                            <h5>Location: $applied->location</h5>
                            <h5>Amount: $amt </h5>
                            <h5>Request Status: ";
                            if($getcancel){
                           $view .= "DISCARDED";
                        	}
                            else{
                           $view .= strtoupper($applied->castStatus);
                        	}
                           $view .= "</h5>
                            <br>
                            <br>
                        </div>
                        <div class='col-lg-3 col-sm-3'>
                        <br>
                        <br>
                        <br>$btn</div>
                   
	    			</div>
	    			<br>
	    			<br>";

			}
		}

		
    			}


	$this->processcaststatus();
	$user = User::find(Auth::user()->id);
	$getnotifyunseen = $this->getunseen();

	$getcastunseen = $this->getcastunseen();
	$getmsgunseen = $this->getmsgunseen();
	
	return View::make('models/castapplication')->with(compact('user', 'getcastunseen', 'getmsgunseen', 'view', 'getcast', 'getnotifyunseen', 'models', 'castnew','castdeclined', 'castprevious', 'castapply'));
}

public function castview2()
{
	# code...
	sleep(3);
	$val = $_GET['val'];
	$presentYear = date('Y');
	$presentMonth = date('m');
	$presentDay = date('d');
	$cast = DB::table('casting')->where('id', '=', $val)->get();
	$getcast = DB::table('casttable')->where('cast_id', '=', $val)->where('castStatus', '=', 'discarded')->where('user_id', '=', Auth::user()->id)->first();
	$getcancel = DB::table('castmodelcancel')->where('cast_id', '=', $val)->where('user_id', '=', Auth::user()->id)->get();
	foreach ($cast as $key) {
		$month = $key->Monthend;
		$year = $key->Yearend;
		$day = $key->Dayend;
		if(!empty($key->castImage)){
        $image = HTML::image($key->castImage ,'cast picture', array('width' => '130px'));
        }
        else{
		$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
		}

		$date1 = strtotime("$key->Yearcast-$key->Monthcast-$key->Daycast");	
		$datecast = date('l, j F Y', $date1);

		$date2  = strtotime("$key->Yearend-$key->Monthend-$key->Dayend");
		$dateend = date('l, j F Y', $date2);

		$date3  = strtotime("$key->YearExp-$key->MonthExp-$key->DayExp");
		$dateexp = date('l, j F Y', $date3);

	$value = "<div class='modal-header'>
				        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				        <h4 class='modal-title' id='myModalLabel'>".$key->castTitle."</h4>
				      </div>
		<div class='modal-body'>
		<div class='row'>
		<div class='col-md-5'>
		<p>Location: ".$key->location."</p>
		<p>Cast Duration: ".$datecast." - ".$dateend."</p>
		<p>Cast Expires: ".$dateexp."</p>
		<p>Venue: ".$key->venue."</p>
		</div>
		<div class='col-md-4'>
		<p>Gender: ".$key->gender."</p>
		<p>Location: ".$key->location."</p>
		<p>City: ".$key->area."</p>
		</div>
		
		<div class='col-md-3'>
		".$image."
		</div>
		</div>
		
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Cast Description</h5>
		<p>".$key->castDescription."</p>
		
		</div>
		</div>
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Cast Requirement</h5>
		<p>".$key->castRequirement."</p>
		
		</div>
		</div>";
	if (!$getcast) {
			if (!$getcancel) {
				# code...
			# code...
			if ($year >= $presentYear) {
			# code...
			if ($month < $presentMonth) {
				# code...
				if ($year > $presentYear) {
					# code...
	$value	.=	"<div class='row'>
					<div class='col-lg-12'>
						<button class='btn btn-danger discast' id=".$val.">Discard cast</button>
					</div>
				</div>";
				}
			}elseif ($month > $presentMonth) {
				# code...
$value	.=	"<div class='row'>
				<div class='col-lg-12'>
					<button class='btn btn-danger discast' id=".$val.">Discard cast</button>
				</div>
			</div>";
			}elseif ($month == $presentMonth) {
				# code...
				if ($day > $presentDay) {
					# code...
					$value	.=	"<div class='row'>
					<div class='col-lg-12'>
						<button class='btn btn-danger discast' id=".$val.">Discard cast</button>
					</div>
					</div>";
				}
			}
			}
		}
		}
		"</div>
		";

	
echo $value;
	}
}

public function castview()
{
	# code...
	sleep(3);
	$val = $_GET['val'];
	$cast = DB::table('casting')->where('id', '=', $val)->get();
	foreach ($cast as $key) {
		if(!empty($key->castImage)){
        $image = HTML::image($key->castImage ,'cast picture', array('width' => '130px'));
        }
        else{
		$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
		}

		$date1 = strtotime("$key->Yearcast-$key->Monthcast-$key->Daycast");	
		$datecast = date('l, j F Y', $date1);

		$date2  = strtotime("$key->Yearend-$key->Monthend-$key->Dayend");
		$dateend = date('l, j F Y', $date2);

		$date3  = strtotime("$key->YearExp-$key->MonthExp-$key->DayExp");
		$dateexp = date('l, j F Y', $date3);

	$value = "<div class='modal-header'>
				        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				        <h4 class='modal-title' id='myModalLabel'>".$key->castTitle."</h4>
				      </div>
		<div class='modal-body'>
		<div class='row'>
		<div class='col-md-5'>
		<p>Location: ".$key->location."</p>
		<p>Cast Duration: ".$datecast." - ".$dateend."</p>
		<p>Cast Expires: ".$dateexp."</p>
		<p>Venue: ".$key->venue."</p>
		</div>
		<div class='col-md-4'>
		<p>Gender: ".$key->gender."</p>
		<p>Location: ".$key->location."</p>
		<p>City: ".$key->area."</p>
		</div>
		
		<div class='col-md-3'>
		".$image."
		</div>
		</div>
		
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Cast Description</h5>
		<p>".$key->castDescription."</p>
		
		</div>
		</div>
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Cast Requirement</h5>
		<p>".$key->castRequirement."</p>
		
		</div>
		</div>
		<div class='row'>
					<div class='col-lg-12'>
						".$this->getUserPlan($val)."
					</div>
				</div>
		</div>
		";

	
echo $value;
	}
}

public function castviews()
{
	# code...
	sleep(5);
	$val = $_GET['val'];
	$presentYear = date('Y');
	$presentMonth = date('m');
	$presentDay = date('d');
	$date = $presentYear."-".$presentMonth."-".$presentDay;
	$cast = DB::table('casting')->where('id', '=', $val)->get();
	$getcast = DB::table('casttable')->where('cast_id', '=', $val)->where('castStatus', '=', 'discarded')->where('user_id', '=', Auth::user()->id)->first();
	$getcancel = DB::table('castmodelcancel')->where('cast_id', '=', $val)->where('user_id', '=', Auth::user()->id)->get();

	foreach ($cast as $key) {
		$month = $key->Monthend;
		$year = $key->Yearend;
		$day = $key->Dayend;
		if(!empty($key->castImage)){
        $image = HTML::image($key->castImage ,'cast picture', array('width' => '130px'));
        }
        else{
		$image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px'));
		}

				$date1 = strtotime("$key->Yearcast-$key->Monthcast-$key->Daycast");	
		$datecast = date('l, j F Y', $date1);

		$date2  = strtotime("$key->Yearend-$key->Monthend-$key->Dayend");
		$dateend = date('l, j F Y', $date2);

		$date3  = strtotime("$key->YearExp-$key->MonthExp-$key->DayExp");
		$dateexp = date('l, j F Y', $date3);


	$value = "<div class='modal-header'>
				        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				        <h4 class='modal-title' id='myModalLabel'>".$key->castTitle."</h4>
				      </div>
		<div class='modal-body'>
		<div class='row'>
		<div class='col-md-5'>
		<p>country: ".$key->country."</p>
		<p>Cast Duration: ".$datecast." - ".$dateend."</p>
		<p>Cast Expires: ".$dateexp."</p>
		</div>
		<div class='col-md-4'>
		<p>Gender: ".$key->gender."</p>
		<p>Location: ".$key->location."</p>
		<p>city: ".$key->area."</p>
		</div>
		
		<div class='col-md-3'>
		".$image."
		</div>
		</div>
		
		<br>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Cast Description</h5>
		<p>".$key->castDescription."</p>
		
		</div>
		</div>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Cast Requirement</h5>
		<p>".$key->castRequirement."</p>
		
		</div>
		</div>";
		
		if (!$getcast) {
			if (!$getcancel) {
				# code...
			# code...
			if ($year >= $presentYear) {
			# code...
			if ($month < $presentMonth) {
				# code...
				if ($year > $presentYear) {
					# code...
	$value	.=	"<div class='row'>
					<div class='col-lg-12'>
						<button class='btn btn-danger discast' id=".$val.">Discard cast</button>
					</div>
				</div>";
				}
			}elseif ($month > $presentMonth) {
				# code...
$value	.=	"<div class='row'>
				<div class='col-lg-12'>
					<button class='btn btn-danger discast' id=".$val.">Discard cast</button>
				</div>
			</div>";
			}elseif ($month == $presentMonth) {
				# code...
				if ($day > $presentDay) {
					# code...
					$value	.=	"<div class='row'>
					<div class='col-lg-12'>
						<button class='btn btn-danger discast' id=".$val.">Discard cast</button>
					</div>
					</div>";
				}
			}
			}
		}
		}
		
$value .= "</div>
		";

	
echo $value;
	}
}

public function castdisccheck()
{
	$view = '';
	$id = $_GET['id'];
$view .= "<div class='row'>
				<div class='col-lg-12'>
				<h5>Are you sure you want to discard this cast</h5>
				</div>
			  </div>
			<div class='row'>
				<div class='col-lg-6 col-xs-12'>
					<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-primary discastx' id=$id data-dismiss='modal'>Yes</button>
				</div>
				<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
				</div>
				</div>
			</div>
			</div>";
echo $view;
}

public function castdisc()
{
	# code...
	$id = $_GET['id'];
	$castmodelcancel = new castmodelcancel;
	$castmodelcancel->user_id = Auth::user()->id;
	$castmodelcancel->cast_id = $id;
	$castmodelcancel->save();

	$getpaymentmethod = DB::table('casting')->where('id', '=', $id)->first();

	$getnum = DB::table('models')->where('user_id', '=', Auth::user()->id)->first();
		$agent = User::find($getpaymentmethod->user_id);
		$num = $agent->Others->telephone;
		$displayName = $getnum->displayName;

	$msg = "$displayName: one of your selected models has declined. Log in to make adjustments @ www.afrodaisymodels.com.";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);

}

public function castapplyProcess()
{
	# code...
		$month = date('m');
	$year = date('Y');
	$val = $_GET['val'];
	$user_id = Auth::user()->id;
	$getapply = DB::table('casttable')->where('cast_id', '=', $val)->where('user_id', '=', $user_id)->where('castStatus', '=', 'confirmed')->get();
	if ($getapply) {
		echo "<div class='row'>
				<div class='col-lg-4 bg-primary' style='padding: 5px;'>
		Cast applied
				</div>
			</div>";
	}else{
	$castApplication = new castApplication;
	$castApplication->user_id = $user_id;
	$castApplication->cast_id = $val;
	$castApplication->month = $month;
	$castApplication->year = $year;
	$castApplication->save();

	$castUpdate = casttable::where('cast_id', '=', $val)->where('user_id', '=', $user_id)->update(array('castStatus' => 'confirmed'));
	echo "<div class='row'>
				<div class='col-lg-4 bg-primary' style='padding: 5px;'>
		Cast applied
				</div>
			</div>";	
	}
}

public function castapplybutton()
{
	# code...
		$castApplication = new castApplication;
	$month = date('m');
	$year = date('Y');
	$user_id = Auth::user()->id;
	$val = $_GET['val'];
	$userplanval = '';
	$userplan = DB::table('usersplan')->where('usersplan.user_id', '=', $user_id)->where('usersplan.status', '=', 'active')->Join('limitation', 'usersplan.plan_id', '=', 'limitation.plan_id')->get();
	$getcastApplication = DB::table('castapplication')->where('user_id', '=', $user_id)->where('month', '=', $month)->where('year', '=', $year)->count();

	foreach ($userplan as $key) {
		$userplanval = $key->cast_apply;
	}
	if ($userplanval == 'all') {
		$access = 'granted';
	$castApplication->user_id = $user_id;
	$castApplication->cast_id = $val;
	$castApplication->month = $month;
	$castApplication->year = $year;
	$castApplication->save();

	$castUpdate = casttable::where('cast_id', '=', $val)->where('user_id', '=', $user_id)->update(array('castStatus' => 'confirmed'));
	echo "<p class='bg-success' style='padding: 10px;'>Cast applied</p>";

	}elseif ($userplanval == '4') {
		if ($getcastApplication >= 4) {
			echo "<a href='/users/changesubscription' class='btn btn-sm btn-danger'>You have exhausted your cast for the month click to subscribe</a>";
		}else{
			$castApplication->user_id = $user_id;
			$castApplication->cast_id = $val;
			$castApplication->month = $month;
			$castApplication->year = $year;
			$castApplication->save();
			$castUpdate = casttable::where('cast_id', '=', $val)->where('user_id', '=', $user_id)->update(array('castStatus' => 'confirmed'));
	echo "<p class='bg-success' style='padding: 10px;'>Cast applied</p>";
		}
	}else{
		if ($getcastApplication >= 2) {
		echo "<a href='/users/changesubscription' class='btn btn-sm btn-danger'>You have exhausted your cast for the month click to subscribe</a>";
		}else{
			$castApplication->user_id = $user_id;
	$castApplication->cast_id = $val;
	$castApplication->month = $month;
	$castApplication->year = $year;
	$castApplication->save();

	$castUpdate = casttable::where('cast_id', '=', $val)->where('user_id', '=', $user_id)->update(array('castStatus' => 'confirmed'));
	echo "<p class='bg-success' style='padding: 10px;'>Cast applied</p>";
		}
	}


}

public function editprofile()
{
			parse_str($_GET['datas'], $formdata);
        $bust = $formdata['chestbust'];
        $waist = $formdata['waist'];
        $hips = $formdata['hips'];
        $dress = $formdata['dress'];
        $jacket = $formdata['jacket'];
        $trousers = $formdata['trousers'];
        $collar = $formdata['collar'];
        $shoes = $formdata['shoes'];
        $eyes = $formdata['eyes'];
        $hair = $formdata['hair_color'];
        $language = $formdata['languages'];
        $complexion = $formdata['complexion'];
        $butt = $formdata['butt'];
        $hairtype = $formdata['Hair_type'];
        $ehtnic = $formdata['ethnicity'];
        $qualification = $formdata['qualification'];

	$cat = $_GET['cat'];
        $dis = $_GET['cats'];

	$user_id = Auth::user()->id;
	$selectPreference = DB::table('modelpreference')->where('modelId', '=', $user_id)->count();
	if ($selectPreference > 0) {
		$affectedRows = modelpreference::where('modelId', '=', $user_id)->update(array('chestbust' => $bust,
					'waist' => $waist,
					'hips' => $hips,			
					'dress' => $dress,
					'jacket' => $jacket,
					'trousers' => $trousers,			
					'collar' => $collar,
					'shoes' => $shoes,			
					'eyes' => $eyes,
					'hair_color' => $hair,
					'ethnicity' => $ehtnic,
					'languages' => $language,
					'complexion' => $complexion,
					'butt' => $butt,
					'Hair_type' => $hairtype,
					'qualification' => $qualification
					));
	}else{
		$insertPreference = new modelpreference;
		$insertPreference->prefId = '1';
		$insertPreference->modelId = $user_id;
		$insertPreference->chestbust = $bust;
		$insertPreference->waist = $waist;
		$insertPreference->dress = $dress;
		$insertPreference->jacket = $jacket;
		$insertPreference->trousers = $trousers;
		$insertPreference->collar = $collar;
		$insertPreference->shoes = $shoes;
		$insertPreference->eyes = $eyes;
		$insertPreference->hair_color = $hair;
		$insertPreference->ethnicity = $ehtnic;
		$insertPreference->languages = $language;
		$insertPreference->complexion = $complexion;
		$insertPreference->butt = $butt;
		$insertPreference->Hair_type = $hairtype;
		$insertPreference->qualification = $qualification;
		$insertPreference->save();
	}


   $modelCat = DB::table('distable')->where('user_id', '=', $user_id)->count();
   if (!empty($cat)) {
   	# code...
   
    if ($modelCat > 0) {
    	# code...
    	$val = '';
    foreach ($cat as $key => $value) {
	foreach ($value as $users) {
		$val .= $users;

		}
	}

	$pieces = explode("catry", $val);
		$vals = '';
		foreach ($pieces as $keys => $values) {
			$vals = $values;
			if (!empty($vals)) {
				# code...
				$selectcat = distable::where('user_id', '=', $user_id)->where('dis_id', '=', $vals)->count();
				if ($selectcat > 0) {
				distable::where('user_id', '=', $user_id)->where('dis_id', '=', $vals)->update(array('dis_id' => $vals));	
				}else{
					$add = distable::create(array('user_id' => $user_id, 'dis_id' => $vals));			
				}
			}
	}
	}
   else{
   	$val = '';
   		foreach ($cat as $key => $value) {
	foreach ($value as $users) {
		$val .= $users;

		}
	}

	$userplan = DB::table('usersplan')->where('usersplan.user_id', '=', Auth::user()->id)->where('status', '=', 'active')->Join('limitation', 'usersplan.plan_id', '=', 'limitation.plan_id')->first();
			
			if ($userplan) {
				# code...
				$plan = $userplan->cat_select;
			}else{
				$plan = 4;
					
			}

	$pieces = explode("catry", $val);
		$vals = '';
		$num = 0;
		foreach ($pieces as $keys => $values) {
			$vals = $values;
			if (!empty($vals)) {
				# code...
				$num += 1;
				if ($num >= $plan) {
					# code...
				}else{
				$add = distable::create(array('user_id' => $user_id, 'dis_id' => $vals ));
				}
			}

	}
    }
}
    $modelDis = DB::table('catinput')->where('user_id', '=', $user_id)->count();
    if (!empty($dis)) {
    	# code...
    if ($modelDis > 0) {
    	$val = '';
    	foreach ($dis as $key => $value) {
	foreach ($value as $users) {
		$val .= $users;

		}
	}

	$pieces = explode("cats", $val);
		$displ = '';
		foreach ($pieces as $keys => $values) {
			$displ = $values;
			if (!empty($displ)) {
				# code...
						$selectcat = Catid::where('user_id', '=', $user_id)->where('cat_id', '=', $displ)->count();
						if ($selectcat > 0) {
						Catid::where('user_id', '=', $user_id)->where('cat_id', '=', $displ)->update(array('cat_id' => $displ));	
						}else{
							$add = Catid::create(array('user_id' => $user_id, 'cat_id' => $displ ));			
						}
			}
	}
    }else{
    	$val = '';
	foreach ($dis as $key => $value) {
	foreach ($value as $users) {
		$val .= $users;

		}
	}

	$pieces = explode("cats", $val);
		$displ = '';
		foreach ($pieces as $keys => $values) {
			$displ = $values;
			if (!empty($displ)) {
				# code...
				$add = Catid::create(array('user_id' => $user_id, 'cat_id' => $displ ));
			}
	}

    }


    }
    

echo "Preference Updated successfully";


}

public function mymessage()
{
	
	$user = User::find(Auth::user()->id);
	$user_id = Auth::user()->id;
	$message = DB::table('castmessage')->where('castmessage.reciever', '=', $user_id)->orwhere('castmessage.sender', '=', $user_id)->count();

	if ($message > 0) {
					



		$message = DB::table('castmessage')->orderBy('id','DESC')->where('castmessage.reciever', '=', $user_id)->orwhere('castmessage.sender', '=', $user_id)->get();
		$value = '';
		$value	.= "<div class='row'>";
		foreach($message as $msg) {
				# code...
			if ($msg->reciever == $user_id) {
				# code...
				$id = $msg->sender;

			}else{
				$id = $msg->reciever;
			}
				$profileImage = DB::table('photoupload')->where('user_id', '=', $id)->where('image_type', '=', 'profileImage')->first();
				$model = DB::table('models')->where('user_id', '=', $id)->first();
				if ($model) {
					# code...
				$modelname = $model->firstName.' '.$model->lastName;
				}else{
					$others = DB::table('others')->where('user_id', '=', $id)->first();
					$modelname = $others->agentName;
				}

				$msgdate  = $msg->msgdate;
				$date = explode("-", $msgdate);
				$msgyear = $date[0];
				$msgmonth = $date[1];
				$msgday = $date[2];
				$month = date('M', $msgmonth);
				$date = $month.' '.$msgday;
				$msgs =  str_limit($msg->message, 20, $end = '...');
				$value .= "
				<a href='#click' id=".$msg->id." class='list-group-item viewmsg'>
				<div class='row'>
				<input type = 'hidden' name='hiddenid' id='hideid' value=".$msg->id.">
			<div class='col-lg-3'>".
				HTML::image($profileImage->imagename, 'profile picture', array('width' => '50px', 'Height'=>'50px')).
			"</div>
			<div class='col-lg-9'>
				<div class='row'>
					<div class='col-lg-8'>
						<h5 class='text-left'><b>".$modelname."</b></h5>
					</div>
					<div class='col-lg-4'>
						<p class='text-right'>".$date."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-lg-12'>
						<p>".$msgs."</p>
					</div>
				</div>
			</div>
		</div>
		</a>";


			}
		}else{
			$value = 'No message';
		}

		$message2 = DB::table('castmessage')->orderBy('id','DESC')->where('castmessage.reciever', '=', $user_id)->orwhere('castmessage.sender', '=', $user_id)->first();
		if ($message2) {
			
			if ($message2->reciever == $user_id) {
				# code...
				$id = $message2->sender;
				$hiddenid = $message2->sender;
			}else{
				$id = $message2->reciever;
				$hiddenid = $message2->reciever;
			}

			$getmsg =	DB::table('castmessage')->orwhere(function($query1) use ($user_id, $id){
			$query1
			->where('sender', $id)
    		->where('reciever', $user_id);				
			})

    ->orWhere(function($query) use ($user_id, $id) {
        $query
            ->where('sender', $user_id)
            ->where('reciever', $id);
    })
    ->get();

			//select the other users details
			$model = DB::table('models')->where('user_id', '=', $id)->first();
				if ($model) {
					# code...
				$modelname = $model->firstName.' '.$model->lastName;
				}else{
					$others = DB::table('others')->where('user_id', '=', $id)->first();
					$modelname = $others->agentName;
				}

				//select your own details
				$model = DB::table('models')->where('user_id', '=', $user_id)->first();
				if ($model) {
					# code...
				$myname = $model->firstName.' '.$model->lastName;
				}



				$value2 = '';
				$showmsg = '';
			foreach ($getmsg as $key) {
				
				$showmsg = $key->id;

				if ($key->sender == $user_id) {
					# code...
					$name = $myname;
				}else{
					$name = $modelname;
				}

				$profileImage = DB::table('photoupload')->where('user_id', '=', $id)->where('image_type', '=', 'profileImage')->first();

				$msgdate  = $key->msgdate;
				$date = explode("-", $msgdate);
				$msgyear = $date[0];
				$msgmonth = $date[1];
				$msgday = $date[2];
				$month = date('M', $msgmonth);
				$date = $month.' '.$msgday;
				$msgs =  $key->message;

				
				$value2 .= "<div class='row' id='hidemsg'>
							<input type = 'hidden' name='hiddenid' id='hiddenid' value=".$key->id.">
								<div class='col-lg-1'>".
				HTML::image($profileImage->imagename, 'profile picture', array('width' => '30px', 'Height'=>'30px')).
								"</div>
								<div class='col-lg-10'>
								<div class='row'>
									<div class='col-lg-10'>
										<h5 class='text-left'> <span class= 'success glyphicon glyphicon-user'></span> ".$name."</h5>
									</div>
									<div class='col-lg-2'>
										<p class='text-right'>".$date."</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-12'>
										<p class='text-left'>".$msgs."</p>
									</div>
								</div>
								
								</div>
				
							</div>";
			}
			$value2 .= "<div class='row'>
			<input type = 'hidden' name='otherVal' id='otherVal' value=".$id.">
			<input type = 'hidden' name='showmsg' id='showmsg' value=".$showmsg.">

								<div class='col-lg-1'>
								</div>
								<div class='col-lg-8'>
								<textarea rows='4' cols='50'>
								</textarea>
								</div>
								<div class='col-lg-3 text-right'>
								<br>
								<br>
								<button class='btn btn-primary text-right reply'><span class='glyphicon glyphicon-share-alt'></span> REPLY</button>
								</div>
								</div>";
			
		}else{
			$value2 = '';
		}
	

		$getnotifyunseen = $this->getunseen();
		$userAuth = Auth::user()->id;
	return View::make('models/mymessage')->with(compact('user', 'getnotifyunseen', 'newmessage', 'value', 'value2', 'userAuth'));
}

public function sents()
{
	# code...
	$user = User::find(Auth::user()->id);
	$user_id = Auth::user()->id;
	$hiddenid = $_GET['hiddenid'];
	$message2 = DB::table('castmessage')->where('castmessage.id', '=', $hiddenid)->first();
	if ($message2) {
			
			if ($message2->reciever == $user_id) {
				# code...
				$id = $message2->sender;
			}else{
				$id = $message2->reciever;
			}

			$getmsg =	DB::table('castmessage')->orwhere(function($query1) use ($user_id, $id){
			$query1
			->where('sender', $id)
    		->where('reciever', $user_id);				
			})

    ->orWhere(function($query) use ($user_id, $id) {
        $query
            ->where('sender', $user_id)
            ->where('reciever', $id);
    })
    ->get();

			//select the other users details
			$model = DB::table('models')->where('user_id', '=', $id)->first();
				if ($model) {
					# code...
				$modelname = $model->firstName.' '.$model->lastName;
				}else{
					$others = DB::table('others')->where('user_id', '=', $id)->first();
					$modelname = $others->agentName;
				}

				//select your own details
				$model = DB::table('models')->where('user_id', '=', $user_id)->first();
				if ($model) {
					# code...
				$myname = $model->firstName.' '.$model->lastName;
				}



				$value2 = '';
				$showmsg = '';
			foreach ($getmsg as $key) {
				$showmsg = $key->id;
				if ($key->sender == $user_id) {
					# code...
					$name = $myname;

				}else{
					$name = $modelname;
				}

				$profileImage = DB::table('photoupload')->where('user_id', '=', $id)->where('image_type', '=', 'profileImage')->first();

				$msgdate  = $key->msgdate;
				$date = explode("-", $msgdate);
				$msgyear = $date[0];
				$msgmonth = $date[1];
				$msgday = $date[2];
				$month = date('M', $msgmonth);
				$date = $month.' '.$msgday;
				$msgs =  $key->message;

				
				$value2 .= "<div class='row' id='hidemsg'>
							<input type = 'hidden' name='hiddenid' id='hiddenid' value=".$key->id.">
								<div class='col-lg-1'>".
				HTML::image($profileImage->imagename, 'profile picture', array('width' => '30px', 'Height'=>'30px')).
								"</div>
								<div class='col-lg-11'>
								<div class='row'>
									<div class='col-lg-10'>
										<h5 class='text-left'> <span class= 'success glyphicon glyphicon-user'></span> ".$name."</h5>
									</div>
									<div class='col-lg-2'>
										<p class='text-right'>".$date."</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-12'>
										<p class='text-left'>".$msgs."</p>
									</div>
								</div>
								</div>
				
							</div>";
			}

			$value2 .= "<div class='row'>
			<input type = 'hidden' name='otherVal' id='otherVal' value=".$id.">
			<input type = 'hidden' name='showmsg' id='showmsg' value=".$showmsg.">
								<div class='col-lg-1'>
								</div>
								<div class='col-lg-8'>
								<textarea rows='4' cols='50'>
								</textarea>
								</div>
								<div class='col-lg-3 text-right'>
								<br>
								<br>
								<button class='btn btn-primary text-right reply'><span class='glyphicon glyphicon-share-alt'></span> REPLY</button>
								</div>
								</div>";
}




echo $value2;
}

public function save()
{
	# code...
	$user = User::find(Auth::user()->id);
	$user_id = Auth::user()->id;
	$hiddenid = $_GET['showmsg'];
	$otheruser = $_GET['otherVal'];
	$msg = $_GET['msg'];
	$savecastmsg = new castmessage;
	$savecastmsg->sender = $user_id;
	$savecastmsg->reciever = $otheruser;
	$savecastmsg->message = $msg;
	$savecastmsg->msgdate = date('Y-m-d');
	$savecastmsg->save();

	$message2 = DB::table('castmessage')->where('castmessage.id', '=', $hiddenid)->first();
	if ($message2) {
			
			if ($message2->reciever == $user_id) {
				# code...
				$id = $message2->sender;
			}else{
				$id = $message2->reciever;
			}

			$getmsg =	DB::table('castmessage')->orwhere(function($query1) use ($user_id, $id){
			$query1
			->where('sender', $id)
    		->where('reciever', $user_id);				
			})

    ->orWhere(function($query) use ($user_id, $id) {
        $query
            ->where('sender', $user_id)
            ->where('reciever', $id);
    })
    ->get();

			//select the other users details
			$model = DB::table('models')->where('user_id', '=', $id)->first();
				if ($model) {
					# code...
				$modelname = $model->firstName.' '.$model->lastName;
				}else{
					$others = DB::table('others')->where('user_id', '=', $id)->first();
					$modelname = $others->agentName;
				}

				//select your own details
				$model = DB::table('models')->where('user_id', '=', $user_id)->first();
				if ($model) {
					# code...
				$myname = $model->firstName.' '.$model->lastName;
				}



				$value2 = '';
				$showmsg = '';
			foreach ($getmsg as $key) {
				$showmsg = $key->id;
				if ($key->sender == $user_id) {
					# code...
					$name = $myname;

				}else{
					$name = $modelname;
				}

				$profileImage = DB::table('photoupload')->where('user_id', '=', $id)->where('image_type', '=', 'profileImage')->first();

				$msgdate  = $key->msgdate;
				$date = explode("-", $msgdate);
				$msgyear = $date[0];
				$msgmonth = $date[1];
				$msgday = $date[2];
				$month = date('M', $msgmonth);
				$date = $month.' '.$msgday;
				$msgs =  $key->message;

				
				$value2 .= "<div class='row' id='hidemsg'>
							<input type = 'hidden' name='hiddenid' id='hiddenid' value=".$key->id.">
								<div class='col-lg-1'>".
				HTML::image($profileImage->imagename, 'profile picture', array('width' => '30px', 'Height'=>'30px')).
								"</div>
								<div class='col-lg-11'>
								<div class='row'>
									<div class='col-lg-10'>
										<h5 class='text-left'> <span class= 'success glyphicon glyphicon-user'></span> ".$name."</h5>
									</div>
									<div class='col-lg-2'>
										<p class='text-right'>".$date."</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-12'>
										<p class='text-left'>".$msgs."</p>
									</div>
								</div>
								</div>
				
							</div>";
			}

			$value2 .= "<div class='row'>
			<input type = 'hidden' name='otherVal' id='otherVal' value=".$id.">
			<input type = 'hidden' name='showmsg' id='showmsg' value=".$showmsg.">
								<div class='col-lg-1'>
								</div>
								<div class='col-lg-8'>
								<textarea rows='4' cols='50'>
								</textarea>
								</div>
								<div class='col-lg-3 text-right'>
								<br>
								<br>
								<button class='btn btn-primary text-right reply'><span class='glyphicon glyphicon-share-alt'></span> REPLY</button>
								</div>
								</div>";
}




echo $value2;
}

public function bookmodel($id)
{
	# code...
	$id = $id;
	$user = User::find($id);
	$model = DB::table('models')->where('user_id', '=', $id)->get();
	$modelscloseby = DB::table('models')->where('user_id', '=', Auth::user()->id)->count();
	if ($modelscloseby > 0) {
		# code...
		$modelscloseby = DB::table('models')->where('user_id', '=', Auth::user()->id)->first();
		$getmodelscloseby = DB::table('models')->where('location', '=', $user->newmodel->location)->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->take(5)->get();
	}else{
		$modelscloseby = DB::table('others')->where('user_id', '=', Auth::user()->id)->first();
		$getmodelscloseby = DB::table('models')->where('location', '=', $user->newmodel->location)->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->take(5)->get();
	}

	

	return View::make('models/bookmodel')->with(compact('id', 'user', 'getmodelscloseby'));
}

public function sendbooking()
{
	# code...
	$modelid = $_GET['modelid'];
    $castid = $_GET['castid'];

    $modelcheck = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->where('castMethod','=', 'invited')->where('castStatus','=', 'discarded')->count();

    $modelcheck1 = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->where('castRequest','=', 'request')->where('castStatus','=', '')->count();

    $modelcheck2 = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->where('castRequest','=', 'request')->where('castStatus','=', 'discarded')->count();

    if ($modelcheck > 0) {
    	# code...
    	$affectedRows = casttable::where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->update(array('castStatus' => 'confirmed'));
    }elseif ($modelcheck1 > 0) {
    	# code...
    	$affectedRows = casttable::where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->update(array('castStatus' => 'confirmed'));
    }elseif ($modelcheck2 > 0) {
    	# code...
    	$affectedRows = casttable::where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->update(array('castStatus' => 'confirmed'));
    }else{
    	$affectedRows = new casttable;
    	$affectedRows->cast_id = $castid;
    	$affectedRows->user_id = $modelid;
    	$affectedRows->castMethod = 'invited';
    	$affectedRows->castStatus = 'confirmed';
    	$affectedRows->save();
    }
   
}

public function viewcast()
{
	$modelid = $_GET['modelid'];
	$cast = DB::table('casting')->where('casting.user_id', '=', Auth::user()->id)->get();

	$value = '';
	foreach ($cast as $key) {
		# code...
		$getuser = DB::table('casttable')->where('cast_id', '=', $key->id)->where('user_id', '=', $modelid)
		->where(function($q){
			$q->where(function($query1){
				$query1
				->where('castMethod','=', 'invited')
	    		->where('castStatus','=', 'confirmed');				
				})
			->orWhere(function($query){
	        $query
	            ->where('castRequest','=', 'request')
	            ->where('castStatus','=', 'confirmed');
	    		});
			# code...
		})			
    ->count();
    		if ($getuser > 0) {
			# code...
			$btn = "<button class='btn btn-default'>User already Booked</button>";
		}else{
			$btn = "<button type='button' class='btn btn-primary btn-sm send' id=".$key->id.">INVITE MODEL TO THIS CAST</button>";
		}

		$value .= "<div class='row casting-bg'>
                        <div class='col-lg-2'>";
                        	if(empty($key->castImage))
                        	{ 
                        	$image = 	HTML::image('img/photo.jpg', 'profile picture', array('width' => '80px'));
							}
							else
                        	{
                        	 $image = HTML::image($key->castImage ,'cast picture', array('width' => '80px'));
							}
			$value .= $image ."</div>
                        <div class='col-lg-5' style='padding-top: 20px; padding-left: 50px;'>
                            <h4>".$key->castTitle."</h4>
                            <p>Male/Female models</p>
                            <h5>Location: ".$key->location."</h5>
                            <p>Casting closes: ".$key->DayExp."-".$key->Monthend."-".$key->Yearend."</p>
                        </div>
                        <div class='col-lg-4'>
                        <br>
                        <br>
                        <br>".$btn."
                        </div>
                        </div>";

}
	echo $value;
}

public function sendcast()
{
	$modelid = $_GET['modelid'];
	parse_str($_GET['cast'], $formdata);
	$title = $formdata['title'];
	$casting = $formdata['casting'];
	$paymethod = $formdata['paymethod'];
	$paydetail = $formdata['paydetail'];
	$location = $formdata['location'];
	$city = $formdata['city'];
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
		$others->location = $location;
		$others->area = $city;
		$others->Daycast = $Daycast;
		$others->Monthcast = $Monthcast;
		$others->Yearcast = $Yearcast;
		$others->Dayend = $Dayend;
		$others->Monthend = $Monthend;
		$others->Yearend = $Yearend;
		$others->save();

		$cast_id = $others->id;

		$affectedRows = new casttable;
    	$affectedRows->cast_id = $cast_id;
    	$affectedRows->user_id = $modelid;
    	$affectedRows->castMethod = 'invited';
    	$affectedRows->castStatus = 'confirmed';
    	$affectedRows->save();

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

public function calculatePlan($value='')
{
	# code...
}

public function btnlk()
{
	# code...
	$user = $_GET['user'];
	$like = castlikes::where('likesreciever', '=', $user)->count();
	echo $like;
}

public function btnfl()
{
	# code...
	$user = $_GET['user'];
	$btnfol = castfollowers::where('following', '=', $user)->count();
	echo $btnfol;
}

public function shownotify($id)
{
	# code...
	echo $this->getnotice();
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

public function getStatus($value)
{
	# code...
	$keyfollowing = $value;
	$usrFollow = DB::table('castfollowers')->where('following', '=', $keyfollowing)->where('follower', '=', Auth::user()->id)->first();
			
			$user_id = Auth::user()->id;

			$getmsg =	DB::table('castfollowers')->where(function($query1) use ($keyfollowing, $user_id){
				$query1
				->where('follower', $user_id)
				->where('following', $keyfollowing);				
				})
		    ->where(function($query) use ($keyfollowing, $user_id) {
		        $query
		            ->where('follower', $keyfollowing)
		            ->where('following', $user_id);
		    })
		    ->count();

			if ($getmsg) {
				# code...
			$idfollow = "<button class='btn btn-xs btn-success active userunfollow' id=md".$keyfollowing."><span class='glyphicon glyphicon-retweet'></span> following</button>";
			}else{
				if ($keyfollowing == $user_id) {

			$idfollow = "<button class='btn btn-xs btn-default'><span class='glyphicon glyphicon-user'></span> </button>";	
				}else{
					if ($usrFollow) {
						# code...	

			$idfollow = "<button class='btn btn-xs btn-success active userunfollow' id=md".$keyfollowing."><span class='glyphicon glyphicon-ok'></span> following</button>";		
					}else{
					# code...
			$idfollow = "<button class='btn btn-xs btn-default active userfollow' id=md".$keyfollowing." style='background-color: #fff'><span class='glyphicon glyphicon-ok'></span> follow</button>";
					}
				}
}

	return $idfollow;

}

public function displayfol()
{
	# code...
	$users = $_GET['user'];
	$following = $fol = DB::table('castfollowers')->where('following', '=', $users)->get();
$value = '';
	if ($following) {
		# code...
		
		foreach ($following as $key) {
			# code...
			$key->follower;
			$idfollow = $this->getStatus($key->follower);

			$getuser = DB::table('models')->where('user_id', '=', $key->follower)->first();
			if ($getuser) {
				# code...
				$name = $getuser->firstName." ".$getuser->lastName;
			}else{
				$getuser = DB::table('others')->where('user_id', '=', $key->follower)->first();
				$name = $getuser->agentName;
			}

			if (isset($getuser->agentName)) {
				# code...
				$url = "/others/showprofile/".$key->follower;
			}else{
				$url = "/models/profile/".$key->follower;
			}

			$getuserpix = DB::table('photoupload')->where('user_id', '=', $key->follower)->where('image_type', '=', 'profileImage')->first();
		$value .= "<div class='row'>
						<div class='col-lg-12 col-sm-12 col-xs-12'>
							<div class='row'>
								<div class='col-lg-3 col-sm-3 col-xs-3'>";
					if(!empty($getuserpix->imagename)){
							 $value .=  $image = HTML::image($getuserpix->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$value .=	"</div>
								<div class='col-lg-4 col-sm-4 col-xs-4 text-left'>
								<h5><b><a href=".$url." style='color:#000'>".$name."</a></b></h5>
								<h5><i><span class='glyphicon glyphicon-user' style='color: orange'></span> ".$this->userType($key->follower)."</i></h5>
								</div>
								<div class='col-lg-5 col-sm-5 col-xs-5 text-center md".$key->follower."'>
								<br>
								".$idfollow."
								</div>
							</div>
						</div>
					</div>
					<br>";
		}
	}
echo $value;

}

public function displayflwer()
{
	# code...
	$users = $_GET['user'];
	$follower = $fol = DB::table('castfollowers')->where('follower', '=', $users)->get();
	$value = '';
	if ($follower) {
		# code...
		
		foreach ($follower as $key) {
			# code...
			$keyfollowing = $key->following;
			$idfollow = $this->getStatus($key->following);

			$getuser = DB::table('models')->where('user_id', '=', $keyfollowing)->first();
			if ($getuser) {
				# code...
				$name = $getuser->firstName." ".$getuser->lastName;
			}else{
				$getuser = DB::table('others')->where('user_id', '=', $keyfollowing)->first();
				$name = $getuser->agentName;
			}

			if (isset($getuser->agentName)) {
				# code...
				$url = "/others/showprofile/".$key->follower;
			}else{
				$url = "/models/profile/".$key->follower;
			}

			$getuserpix = DB::table('photoupload')->where('user_id', '=', $keyfollowing)->where('image_type', '=', 'profileImage')->first();
		$value .= "<div class='row'>
						<div class='col-lg-12 col-sm-12 col-xs-12'>
							<div class='row'>
								<div class='col-lg-3 col-sm-3 col-xs-3'>";
					if(!empty($getuserpix->imagename)){
							 $value .=  $image = HTML::image($getuserpix->imagename ,'cast picture', array('width' => '60px', 'Height' => '60px'));
							        }
							        else{
							$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px', 'Height' => '60px'));
									}
							$value .=	"</div>
								<div class='col-lg-4 col-sm-4 col-xs-4 text-left'>
								<h5><b><a href=".$url." style='color:#000'>".$name."</a></b></h5>
								<h5><i><span class='glyphicon glyphicon-user' style='color: orange'></span> ".$this->userType($keyfollowing)."</i></h5>
								</div>
								<div class='col-lg-5 col-sm-5 col-xs-5 text-center md".$keyfollowing."'>
								<br>
								".$idfollow."
								</div>
							</div>
						</div>
					</div><br>";
		}
	}
echo $value;

}

public function userunfollow()
{
	# code...
	$user = $_GET['user'];
	$pieces = explode("md", $user);
	$users = $pieces[1];

	$user_id = Auth::user()->id;

	$follower = DB::table('castfollowers')->where('follower', '=', $user_id)->where('following', '=', $users)->delete();
	$value = "<button class='btn btn-default active userfollow' id=md".$users." style='background-color: #fff'><span class='glyphicon glyphicon-ok'></span> follow</button>";
	echo $value;
}

public function userfollow()
{
	# code...
	$user = $_GET['user'];
	$pieces = explode("md", $user);
	$users = $pieces[1];

	$user_id = Auth::user()->id;

	$castfollowers = new castfollowers;
	$castfollowers->follower = $user_id;
	$castfollowers->following = $users;
	$castfollowers->save();

	$value = "<button class='btn btn-success active userunfollow' id=md".$users."><span class='glyphicon glyphicon-ok'></span> following</button>";
	
	echo $value;
}

public function mynetwork()
{
	# code...
	$user_id = Auth::user()->id;
	$networks = DB::table('mymodel')->where('model_id', '=', $user_id)->where('status', '=', 'active')->get();

	$views = '';
	foreach ($networks as $key) {
		# code...
	$user = User::find($key->agent_id);
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
		$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', $key->agent_id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
			break;
		default:
			# code...
			break;
	}

$views .="<br>
			<div class='col-lg-4 col-sm-4 col-xs-12'>
			<div class='col-lg-7 col-sm-7'>";
				if(!empty($user->photoupload->imagename)){
							 $views .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('class' => 'img-responsive'));
							        }
				        else{
							$views .= $image = HTML::image('img/photo.jpg', 'profile picture', array('class' => 'img-responsive'));
						}
	$views	.=	"</div>
				<div class='col-lg-5 col-sm-5'>
				<a href=/others/showprofile/".$key->agent_id." ><strong>".$user->Others->agentName."</strong></a>
				<p><strong>$user_type_spec</strong></p>";
$views .="<a href=/others/showprofile/".$key->agent_id." class='btn btn-success btn-sm' >View User</a>
		 </div>
		 </div>";
	}

	$user = User::find(Auth::user()->id);
	$userAuth = Auth::user()->id;
	$verification = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->first();
	$getnotifyunseen = $this->getunseen();
	$getcastunseen = $this->getcastunseen();
	$getmsgunseen = $this->getmsgunseen();
	return View::make('models.mynetwork')->with(compact('user', 'castget', 'views', 'getnotifyunseen', 'userAuth', 'getcastunseen', 'getmsgunseen'));
}

public function setprofile()
	{
		# code...
		$pix_id = $_GET['pix_id'];
		$imagegallery = DB::table('imagegallery')->where('id', '=', $pix_id)->first();
		$photoupload = DB::table('photoupload')->where('user_id', '=', Auth::user()->id)->get();

		if ($photoupload) {
			# code...
			$getphoto = DB::table('photoupload')->where('user_id', '=', Auth::user()->id)->update(array('imagename'=>$imagegallery->imagename));
			echo HTML::image($imagegallery->imagename, 'profile picture', array('width' => '130px', 'class' => 'img-responsive'));
		}else{
			
			$photouploadin = new photoupload;
			$photouploadin->user_id = Auth::user()->id;
			$photouploadin->image_type = 'profileImage';
			$photouploadin->imagename = $imagegallery->imagename;
			$photouploadin->save();

			echo HTML::image($imagegallery->imagename, 'profile picture', array('width' => '130px', 'class' => 'img-responsive'));
		}
	}

	public function delpix()
	{
		# code...
		$pix_id = $_GET['pix_id'];
		$imagegallery = DB::table('imagegallery')->where('id', '=', $pix_id)->delete();

		$getdata = DB::table('notifyuploadphoto')->where('img_id', '=', $pix_id)->first();
		if ($getdata) {
			$update = DB::table('modelnofity')->where('id', '=', $getdata->NotId)->update(array('status' => 'inactive'));
		}
		$getlike = DB::table('notifyimagelike')->where('imageid', '=', $pix_id)->first();
		if ($getlike) {
			$update = DB::table('modelnofity')->where('id', '=', $getlike->NotId)->update(array('status' => 'inactive'));			
		}
		$getimagecomment = DB::table('imagecomment')->where('imageid', '=', $pix_id)->get();
		if ($getimagecomment) {
			foreach ($getimagecomment as $key) {
				# code...
			
			$getcomm = DB::table('notifycommentimg')->where('commId', '=', $key->id)->get();
			foreach ($getcomm as $key2) {
				# code...
			$update = DB::table('modelnofity')->where('id', '=', $key2->NotId)->update(array('status' => 'inactive'));
			}
			
			$getimgcomm = DB::table('imagecommentlike')->where('commId', '=', $key->id)->get();
			if ($getimgcomm) {

				foreach ($getimgcomm as $key3) {
				$getdata = 	DB::table('notifycommentlikeimg')->where('commentId', '=', $key3->id)->get();

				foreach ($getdata as $key6) {
					# code...
			$update = DB::table('modelnofity')->where('id', '=', $key6->NotId)->update(array('status' => 'inactive'));
				}
				}
					
				}

			$getreplyimg = DB::table('replycommentimg')->where('commentId', '=', $key->id)->get();
			if ($getreplyimg) {
					foreach ($getreplyimg as $key4) {
						$getimgreply = DB::table('notifyreplycommentimg')->where('replyId', '=', $key4->id)->get();
						foreach ($getimgreply as $key5) {
							# code...
			$update = DB::table('modelnofity')->where('id', '=', $key5->NotId)->update(array('status' => 'inactive'));
						}
					}
				}

			$getrepltlikimg = DB::table('replylikeimg')->where('replyId', '=', $key->id)->get();
			if ($getrepltlikimg) {
					foreach ($getrepltlikimg as $key6) {
						$getreply = DB::table('notifyreplylikeimg')->where('replyId', '=', $key6->id)->get();
						foreach ($getreply as $key7) {
						$update = DB::table('modelnofity')->where('id', '=', $key7->NotId)->update(array('status' => 'inactive'));	
							
						}
					}
				}	
		}
		}
	}

	public function bankdetails()
	{
		# code...
		$acctname = $_GET['acctname'];
		$acctno = $_GET['acctno'];
		$bank = $_GET['bank'];

		$getbankdtls = DB::table('bankdetails')->where('user_id', '=', Auth::user()->id)->get();
		if ($getbankdtls) {
			# code...
			$updatebank = DB::table('bankdetails')->where('user_id', '=', Auth::user()->id)->update(array('acctname' => $acctname, 'acctno' => $acctno, 'bank' => $bank));
		}else{
		$bankdetails = new bankdetails;
		$bankdetails->user_id = Auth::user()->id;
		$bankdetails->acctname = $acctname;
		$bankdetails->acctno = $acctno;
		$bankdetails->bank = $bank;
		$bankdetails->save();
		}

		echo "bank details saved";
	}

	public function changeplans()
	{
		$value = $_GET['val'];
		$Amount = '';
		$view = '';
		$no = 0;
		if ($value == '2') {
			$plan = 'Afro Plus';
			$Amount = 2850;
			$url = '/pay/afroplus';
		}elseif ($value == '3') {
			$plan = 'Afro Unlimited';
			$Amount = 3500;
			$url = '/pay/afrounlimited';
		}

			$view .= "<div class='modal-body'>
      		<div class='well'>
      			<div class='row'>";
		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$plan."</h4>
				<p>Total Amount: <strong>".number_format($Amount)."</strong></p>";

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
							# code...
							$no += 1;
							$user = User::find(Auth::user()->id);
						$view .= "<tr>
									<td>$no</td>
									<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";
						
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>
     	 <div class='modal-footer'>
     	 		<div class='row'>
     	 			<div class='col-lg-12 c0l-xs-12'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			        <a type='button' target='_' class='btn-primary Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px' href=/models/payofflinesub/$value>Pay Offline</a>
			        <form method='post' action=$url>
			        <button class='btn-success Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px'><i class='fa fa-money'></i> Pay Online</button>
			        </form>
			        <button class='btn btn-primary proceedpay' ><i class='fa fa-money'></i> Proceed to Payment</button>
			    	</div>
			    </div>  
		</div>";

		echo $view;

	}

	public function regplan()
	{
		$value = $_GET['val'];
		$Amount = '';
		$view = '';
		$no = 0;
		if ($value == '2') {
			$plan = 'Afro Plus';
			$Amount = 2850;
			$url = '/pay/afroplus';
		}elseif ($value == '3') {
			$plan = 'Afro Unlimited';
			$Amount = 3500;
			$url = '/pay/afrounlimited';
		}

			$view .= "<div class='modal-body'>
      		<div class='well'>
      			<div class='row'>";
		$view .= "<div class='col-lg-12'>
				<h4>Payment for ".$plan."</h4>
				<p>Total Amount: <strong>".number_format($Amount)."</strong></p>";

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
							# code...
							$no += 1;
							$user = User::find(Auth::user()->id);
						$view .= "<tr>
									<td>$no</td>
									<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";
						
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>
     	 <div class='modal-footer'>
     	 		<div class='row'>
     	 			<div class='col-lg-12 c0l-xs-12'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			        <a type='button' target='_' class='btn-primary Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px' href=/models/payofflinesub/$value>Pay Offline</a>
			        <form method='post' action=$url>
			        <button class='btn-success Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px'><i class='fa fa-money'></i> Pay Online</button>
			        </form>
			        <a type='button' class='btn-default Offlinebtn' style='display:none; border:none; border-radius: 3px; padding: 5px' href=/models/changeplan/1>Continue</a>
			        <button class='btn btn-primary proceedpay' ><i class='fa fa-money'></i> Proceed to Payment</button>
			    	</div>
			    </div>  
		</div>";

		echo $view;

	}

	public function payofflinesub($id)
{

		$id = $id;
		$csdate = date('Y');
		$rand = mt_rand(1000,9999);
		$code = "ADM/SUB/".$rand."/".$csdate;
		$view = '';
		$no = '';

		if ($id == '2') {
			$plan = 'Afro Plus';
			$Amount = 2850;
		}elseif ($id == '3') {
			$plan = 'Afro Unlimited';
			$Amount = 3500;
		}

	
		$offlinepayoutjob = new offlinepayoutsub;
		$offlinepayoutjob->sub_id = $id;
		$offlinepayoutjob->user_id = Auth::user()->id;
		$offlinepayoutjob->ref_id = $code;
		$offlinepayoutjob->amount = $Amount;
		$offlinepayoutjob->save();			

	

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
				<h4>Payment for ".$plan."</h4>
				<p>Total Amount: <strong>".number_format($Amount)."</strong></p>
				<p>Sender name: <strong>$code</strong></p>
				</div>
				<div class='row'>
				<div class='col-lg-6'>
					<p style='color: red'><b><i>Note: you must include your name and sender name code on the space provided in your bank slip</i></b></p>
				</div>
			</div>
				";
			$view .=	"<table data-sortable class='table table-hover table-responsive'>
						<thead>
							<tr>
								<th>No</th>
								<th>Model</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody>";
							# code...
							$no += 1;
							$user = User::find(Auth::user()->id);
						$view .= "<tr>
									<td>$no</td>
									<td>".$user->NewModel->displayName."</td>
									<td><i class='fa fa-check'></i> confirmed</td>
								</tr>";
			$view .= "</tbody>
					</table>
			</div>
			</div>
      		</div>
     	 </div>";

		return View::make('others/offlinepayoutsub')->with(compact('view', 'user'));
}

public function castdecline()
{
	$view = '';
	$castid = $_GET['castid'];
$view .= "<div class='row'>
				<div class='col-lg-12'>
				<h5>Are you sure you want to Decline this cast</h5>
				</div>
			  </div>
			<div class='row'>
				<div class='col-lg-6 col-xs-12'>
					<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-primary declinecast' id=$castid data-dismiss='modal'>Yes</button>
				</div>
				<div class='col-lg-6 col-xs-6'>
					<button class='btn btn-danger' data-dismiss='modal'>No</button>
				</div>
				</div>
			</div>
			</div>";
echo $view;
}

public function declinecast()
{
	$castid = $_GET['val'];
	$getcast = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', Auth::user()->id)->update(array('castStatus' => 'discarded'));

}

}