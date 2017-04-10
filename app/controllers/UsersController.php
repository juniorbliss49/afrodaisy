<?php

use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

class UsersController extends BaseController{

public function sendemail()
{
	$csdate = date('Y');
   		 $rand = mt_rand(1000000,9999999);

   		 $emailverification = new emailverification;
   		 $emailverification->user_id = Auth::user()->id;
   		 $emailverification->code = $rand.$csdate;
   		 $emailverification->save();

   		 $code = $rand.$csdate;
   		 $url=Auth::user()->id."/".$code;

		 $user = User::find(Auth::user()->id);
		if (empty($user->NewModel->displayName)) {
			# code...
			$name = $user->Others->agentName;
		}else{
			$name = $user->NewModel->displayName;
		}  		 

   		 Mail::send('emails.welcome', array('url' => $url, 'user' => $name), function($message)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to(Auth::user()->email)->subject('Welcome!');
		    
		});

   		 echo "<p>email sent</p>";
}

public function activate($id, $code)
{
	$getdata = DB::table('emailverification')->where('user_id', '=', $id)->where('code', '=', $code)->get();
	if ($getdata) {
	$getdata = DB::table('emailverification')->where('user_id', '=', $id)->where('code', '=', $code)->update(array('status' => 'active'));	

	$getuser = DB::table('verificationtable')->where('user_id', '=', $id)->get();
	if ($getuser) {
			$getuser = DB::table('verificationtable')->where('user_id', '=', $id)->update(array('email' => 'yes'));
		}else{
			$verification = new verificationtable;
			$verification->user_id = $id;
			$verification->email = 'yes';
			$verification->save();
		}	
	}
	$getnotifyunseen = '';
	return View::make('layouts.activate')->with(compact('getnotifyunseen'));

}

public function updatepassword()
{
	$value = '';
	$password = $_GET['password'];
	$oldpassword = $_GET['oldpassword'];
	$user = DB::table('users')->where('id', '=', Auth::user()->id)->first();
	if (empty($password) || empty($oldpassword)) {
		"<span class='bg-danger' style = 'padding: 7px'>Password incorrect</span>";
	}else{
	if (Hash::check($oldpassword, $user->password)) {
		# code...
		$newpassword = Hash::make($password);
		$users = DB::table('users')->where('id', '=', Auth::user()->id)->update(array('password' => $newpassword));
		$value = "<span class='bg-success' style = 'padding: 7px'>Password changed successfully</span>";
	}else{
		$value = "<span class='bg-danger' style = 'padding: 7px'>Password incorrect</span>";
	}
}
	echo $value;
}

public function updateemail()
{
	$value = '';
	$password = $_GET['password'];
	$email = $_GET['email'];
	$user = DB::table('users')->where('id', '=', Auth::user()->id)->first();

	$validator = Validator::make(
                array(
            'email' => $email,
                ), 
                array(
            'email' => 'required|email|unique:users'
                )
     );
		
	if ($validator->fails()) {
	$value = "<span class='bg-danger' style = 'padding: 7px'>Email taken already or not an email</span>";					
		
	}else{
	if (Hash::check($password, $user->password)) {
		# code...

		$getdata = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->update(array('email' => ''));

		$csdate = date('Y');
   		 $rand = mt_rand(1000000,9999999);

   		 $emailverification = new emailverification;
   		 $emailverification->user_id = Auth::user()->id;
   		 $emailverification->code = $rand.$csdate;
   		 $emailverification->save();

   		 $code = $rand.$csdate;
   		 $url=Auth::user()->id."/".$code;

		 $user = User::find(Auth::user()->id);
		if (empty($user->NewModel->displayName)) {
			# code...
			$name = $user->Others->agentName;
		}else{
			$name = $user->NewModel->displayName;
		}  		 

   		 Mail::send('emails.welcome', array('url' => $url, 'user' => $name), function($message)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($_GET['email'])->subject('Welcome!');
		    
		});

		$users = DB::table('users')->where('id', '=', Auth::user()->id)->update(array('email' => $email));
		$value = "<span class='bg-success' style = 'padding: 7px'>Email changed successfully check your email for verification</span>";

	}else{
		$value = "<span class='bg-danger' style = 'padding: 7px'>Password incorrect</span>";
	}
}
	echo $value;
}

public function send()
{
	return View::make('layouts.send');
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




	public function index()
	{
		$getnotifyunseen = '';
		return View::make('page.index')->with(compact('getnotifyunseen'));
	}

	public function newAccount()
	{
		return View::make('page.signup');
	}

	public function addUser()
	{
		$data = Input::all();

		$validator = Validator::make($data, User::$auth_rules);
		
		if ($validator->fails()) {
		return Redirect::back()->withErrors($validator)->withInput();					
			
		}
		$user = new User;
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->user_type = Input::get('user_type');
		$user->save();

		$user_id = User::where('email', '=', Input::get('email'))->get();
		$getindustry = DB::table('industryprofessional')->get();
		$user_type_spec = Input::get('user_type');

		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
			switch (Input::get('user_type')) {
				case 'newFace':
				case 'proModel':
					return Redirect::to('models/welcome')->with('user_id', $user_id);
					break;
				case 'photo':
				case 'agent':
				case 'artist':
				case 'fashion':
				case 'tattoo':
				case 'others':
					return Redirect::to('others/welcome')->with(compact('getindustry', 'user_type_spec'));
					break;
			}
		}
		return Redirect::to('signin');
	}

	public function signin()
	{
		return View::make('page.signin');
	}

	public function login()
	{
		return View::make('page.login');
	}

	public function logout()
	{
		# code...
		Auth::logout();
		return Redirect::to('afrodiasycpanel/login');
	}

	public function Logincpanel()
	{
		$data = Input::all();
		$validator = Validator::make($data, User::$auth_login);

		if ($validator->fails()) {
		return Redirect::back()->withErrors($validator)->withInput();					
			
		}

		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
				$user = User::find(Auth::user()->id);
				if (Auth::user()->user_type == 'admin') {
					# code...
					return Redirect::to('admin/')->with(compact('user', 'access'));
				}elseif (Auth::user()->user_type == 'account') {
					# code...
					return Redirect::to('account/')->with(compact('user', 'access'));
				}else{
					Auth::logout();
					return Redirect::to('page.login');
				}
			}
		return Redirect::back()->withInput()->with('message', 'Email or Password not correct');
	}

	public function LoginUser()
	{
		$data = Input::all();
		$validator = Validator::make($data, User::$auth_login);

		if ($validator->fails()) {
		return Redirect::back()->withErrors($validator)->withInput();					
			
		}

		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
				$user = User::find(Auth::user()->id);
				$user_id = Auth::user()->user_type;
			switch (Auth::user()->user_type) {
				case 'newFace':
				case 'proModel':
				$getuser = DB::table('models')->where('user_id', '=', Auth::user()->id)->get();
				$getcat = DB::table('distable')->where('user_id', '=', Auth::user()->id)->first();
				$getplan = DB::table('usersplan')->where('user_id', '=', Auth::user()->id)->first();
				$getimage = DB::table('imagegallery')->where('user_id', '=', Auth::user()->id)->first();
				if ($getuser) {
				if(empty($getplan)){
					return Redirect::to('models/changesubscription');
				}	
				elseif (!isset($getcat) && !isset($getimage)) {
					return Redirect::to('models/photoupload');
				}else{
					$access = 'granted';
					return Redirect::to('models/dashboard')->with(compact('user', 'access'));
				}

				}else{
					return Redirect::to('models/welcome')->with('user_id', $user_id);
				}
					break;
				case 'photo':
				case 'agent':
				case 'artist':
				case 'fashion':
				case 'others':
				case 'tattoo':
				$getuser = DB::table('others')->where('user_id', '=', Auth::user()->id)->get();
				if ($getuser) {
					$access = 'granted';
					return Redirect::to('others/dashboard')->with('user', $user);
				}else{
					return Redirect::to('others/welcome')->with(compact('getindustry', 'user_type_spec'));
				}
					break;
			}
			}
		return Redirect::back()->withInput()->with('message', 'Email or Password not correct');

	}
	public function signout()
	{
		Session::forget('otherspage');
		Session::forget('modelspage'); 
		Session::forget('models');
		Session::forget('others');
		Session::forget('category');
		Session::forget('subscribe');
		Session::forget('photoupload');		

		Auth::logout();
		return Redirect::to('signin');
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

	public function planinsert($id)
    {
    	$user_id = Auth::user()->id;
    	$planstatus = 'active';
    	$startdate = time();

    	$dateFrom = $startdate;
    	$month = date('m', $startdate);
	  $day = date('d', $startdate);
	  $year = date('Y', $startdate);
	  $startdates = strtotime("$year-$month-$day");

    	$dateplan = $this->calculate_next_year($startdate);

    	$date = explode("-", $dateplan);
		$Expyear = $date[0];
		$Expmonth = $date[1];
		$Expday = $date[2];

		$status = 'active';

    	if ($id == '1') {
    		# code...
			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$userplan->status = $planstatus;
			    	$userplan->save();
    	}elseif ($id == '2') {
    		# code...
			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$usersplan->status = $planstatus;
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
			    	$usersub->enddate = $dateplan;
					$usersub->status = $status;
			    	$usersub->save();

    	}elseif ($id == '3') {
    		# code...
			    	$userplan = new usersplan;
			    	$userplan->user_id = $user_id;
			    	$userplan->plan_id = $id;
			    	$usersplan->status = $planstatus;
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
			    	$usersub->enddate = $dateplan;
			    	$usersub->status = $status;
			    	$usersub->save();
    	}



    	$user = User::find(Auth::user()->id);
		$Discipline = DB::table('disciplines')->get();
		return View::make('/users/photoupload')->with(compact('user', 'Discipline'));
    }

    public function mymessage()
{
	$user_id = Auth::user()->id;
	$users = array();
	$view = '';
	$message = '';
	$num = '';

	$slNotification = DB::table('modelnofity')->where('NotId', '=', 13)->where('user', '=', Auth::user()->id)->get();
	foreach ($slNotification as $key) {
		$getinfo = DB::table('notifymessage')->where('NotId', '=', $key->id)->get();
		if ($getinfo) {
			# code...
		}else{
			$notifymessage = new notifymessage;
			$notifymessage->NotId = $key->id;
			$notifymessage->user_id = Auth::user()->id;
			$notifymessage->date = date('d-m-Y');
			$notifymessage->save();
		}
	}

	$message = DB::table('castmessage')->where('castmessage.reciever', '=', $user_id)->orwhere('castmessage.sender', '=', $user_id)->count();
	if ($message > 0) {
		# code...
		$message = DB::table('castmessage')->orderBy('id','DESC')->where('castmessage.reciever', '=', $user_id)->orwhere('castmessage.sender', '=', $user_id)->get();
		$view .= "<div class='row'>";
		foreach($message as $msg) {
			if ($msg->reciever == $user_id) {
				# code...
				$id = $msg->sender;
				$msgstatus = "<p style='font-size:85%'><strong><i class='fa fa-inbox'></i> inbox</strong></p>";

			}else{
				$id = $msg->reciever;
				$msgstatus = "<p style='font-size:85%'><strong><i class='fa fa-share-square-o'></i> sent</strong></p>";
			}

			if (!in_array($id,$users)) {
				$num += 1;
				$users[] = $id;

				$profileImage = DB::table('photoupload')->where('user_id', '=', $id)->where('image_type', '=', 'profileImage')->first();
				$model = DB::table('models')->where('user_id', '=', $id)->first();
				if ($model) {
					# code...
				$modelname = $model->displayName;
				}else{
					$others = DB::table('others')->where('user_id', '=', $id)->first();
					$modelname = $others->agentName;
				}

				$date = strtotime($msg->msgdate);
				$msgdates = "<p style='font-size:80%'><strong><i class='fa fa-calendar-o'></i> ".date('j F, Y', $date)."</strong></p>";
				$msgs =  str_limit($msg->message, 20, $end = '...');

				$view .= "<a href='/messagedetails/$id' style='border-bottom: 1px solid #000;'>
							<div class='row' style='border: 1px solid #000; border-radius: 5px'>
							<div class='col-lg-12' style='padding: 1%; color: #000'>
								<div class='col-lg-3 col-xs-12'>
								<div class='col-lg-12 col-xs-5'>";
				if ($profileImage) {
					$view .= HTML::image($profileImage->imagename, 'profile picture', array('width' => '60%', 'Height'=>'60%', 'class' => 'img-responsive'));
				}else{
					$view .= HTML::image('img/photo.jpg', 'profile picture', array('width' => '60%', 'Height'=>'60%', 'class' => 'img-responsive'));
				}
				
				$view .=		"</div>
								<div class='col-lg-12 col-xs-7'>
									<p><strong><i class='fa fa-user'></i> $modelname</strong></p>
								</div>
								</div>
								<div class='col-lg-5 col-xs-12 text-center'>
									<i class='fa fa-envelope-o'></i> $msgs
								</div>
								<div class='col-lg-4 col-xs-12'>
								$msgdates
								$msgstatus
								</div>
							</div>
							</div>
						</a>";
		}

		}
		$view .= "</div>";
	}

	$getnotifyunseen = $this->getunseen();
	return View::make('layouts/mymessage')->with(compact('user', 'getnotifyunseen', 'newmessage', 'view'));
}

public function messagedetails($id)
{
	# code...
	$id = $id;
	$view = '';
	$user_id = Auth::user()->id;
	$getmsg =	DB::table('castmessage')->orwhere(function($query1) use ($user_id, $id){
			$query1
			->where('sender', $id)
    		->where('reciever', $user_id);				
			})

    ->orWhere(function($query) use ($user_id, $id) {
        $query
            ->where('sender', $user_id)
            ->where('reciever', $id);
    })->get();


    foreach ($getmsg as $key) {
    	# code...
    	$user = $key->sender;
    	$profileImage = DB::table('photoupload')->where('user_id', '=', $user)->where('image_type', '=', 'profileImage')->first();

    	$model = DB::table('models')->where('user_id', '=', $user)->first();
				if ($model) {
					# code...
				$modelname = $model->displayName;
				}else{
					$others = DB::table('others')->where('user_id', '=', $user)->first();
					$modelname = $others->agentName;
				}

		$date = strtotime($key->msgdate);
		$msgdates = "<i class='fa fa-calendar-o'></i> ".date('j F, Y', $date);

		$view .= "<div class='row' id='hidemsg'>
								<div class='col-lg-1 col-xs-12'>
								<br>
								<a href=".$this->getProfile($user).">";
				if ($profileImage) {
			$view .= HTML::image($profileImage->imagename, 'profile picture', array('width' => '100%', 'Height'=>'100%'));
				}else{
			$view .=  HTML::image('img/photo.jpg', 'profile picture', array('width' => '100%', 'Height'=>'100%'));
				}
				$view .= "</a>
								</div>
								<div class='col-lg-10 col-xs-12'>
								<div class='row'>
									<div class='col-lg-7 col-xs-6'>
										<a href=".$this->getProfile($user)." style='color: #000'>
										<h5 class='text-left'> <span class= 'success glyphicon glyphicon-user'></span> ".$modelname."</h5>
										</a>
									</div>
									<div class='col-lg-5 col-xs-6'>
										<p class='text-right'>".$msgdates."</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-12 col-xs-12'>
										<p class='text-left'><i class='fa fa-envelope-o'></i> ".$key->message."</p>
									</div>
								</div>
								
								</div>
				
							</div><hr>";

    }
    	    $view .= Form::open(array('url' => 'users/sendmsg'));
    	    $view .= "<div class='row'>
				<div class='col-lg-5'>
					<input type = 'hidden' name='otherVal' id='otherVal' value=".$id.">
					<textarea class='form-control' name='msg' rows='4' cols='50'></textarea>
				</div>
				<div class='col-lg-2 text-right'>
				<br>
				<br>
				<button class='btn btn-primary text-right reply'><span class='glyphicon glyphicon-share-alt'></span> REPLY</button>
				</div>
			</div></div>";
			$view .= Form::close();
			$getnotifyunseen = $this->getunseen();

return View::make('layouts/messagedetails')->with(compact('view', 'getnotifyunseen'));
}

public function sendmsg()
{
	# code...
	$msg = Input::get('msg');
	$otheruser = Input::get('otherVal');
	$user_id = Auth::user()->id;
	if (!empty($msg)) {
		# code...
		$savecastmsg = new castmessage;
	$savecastmsg->sender = $user_id;
	$savecastmsg->reciever = $otheruser;
	$savecastmsg->message = $msg;
	$savecastmsg->msgdate = date('Y-m-d');
	$savecastmsg->save();
	return Redirect::back();
	}else{
		return Redirect::back();
	}

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
	$getverify = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->where('verify', '=', 'yes')->where('mobile', '=', 'yes')->get();
	if ($modelscloseby > 0) {
		# code...
		$modelscloseby = DB::table('models')->where('user_id', '=', Auth::user()->id)->first();
		$getmodelscloseby = DB::table('models')->where('location', '=', $user->newmodel->location)->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->take(5)->get();
	}else{
		$modelscloseby = DB::table('others')->where('user_id', '=', Auth::user()->id)->first();
		$getmodelscloseby = DB::table('models')->where('location', '=', $user->newmodel->location)->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->take(5)->get();
	}

	$getnotifyunseen = $this->getunseen();

	return View::make('layouts/bookmodel')->with(compact('id', 'user', 'getmodelscloseby', 'getnotifyunseen', 'getverify'));
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

public function sendbookings()
{
	# code...
	$id = $_GET['id'];
	$pieces = array();
	$pieces = explode(",", $id);
	
	$modelid = $pieces[0];
    $castid = $pieces[1];

    $modelcheck = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->where('castMethod','=', 'invited')->where('castStatus','=', 'discarded')->count();

    $modelcheck1 = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->where('castRequest','=', 'request')->where('castStatus','=', '')->count();

    $modelcheck2 = DB::table('casttable')->where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->where('castRequest','=', 'request')->where('castStatus','=', 'discarded')->count();

    if ($modelcheck > 0) {
    	# code...
    	$affectedRows = casttable::where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->update(array('castStatus' => 'confirmed'));
    	$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $modelid;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $castid;
		$upcoming->user_id = $modelid;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

				$getnum = DB::table('models')->where('user_id', '=', $modelid)->first();
		$num = $getnum->phone;
		$user = $getnum->displayName;
		$getmail = User::find($modelid);

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

    }elseif ($modelcheck1 > 0) {
    	# code...
    	$affectedRows = casttable::where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->update(array('castStatus' => 'confirmed'));
    	$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $modelid;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $castid;
		$upcoming->user_id = $modelid;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

					$getnum = DB::table('models')->where('user_id', '=', $modelid)->first();
		$num = $getnum->phone;
		$user = $getnum->displayName;
		$getmail = User::find($modelid);

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

    }elseif ($modelcheck2 > 0) {
    	# code...
    	$affectedRows = casttable::where('cast_id', '=', $castid)->where('user_id', '=', $modelid)->update(array('castStatus' => 'confirmed'));
    	$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'acceptedCast')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $modelid;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $castid;
		$upcoming->user_id = $modelid;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

					$getnum = DB::table('models')->where('user_id', '=', $modelid)->first();
		$num = $getnum->phone;
		$user = $getnum->displayName;
		$getmail = User::find($modelid);

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

    }else{
    	$affectedRows = new casttable;
    	$affectedRows->cast_id = $castid;
    	$affectedRows->user_id = $modelid;
    	$affectedRows->castMethod = 'invited';
    	$affectedRows->castStatus = '';
    	$affectedRows->save();

    	$dates = date('d-m-Y');
		$times = date('g:i A');
		$notify = DB::table('notification')->where('name', '=', 'castinvitation')->first();

		$modeldata = new ModelNotify;
		$modeldata->NotId = $notify->id;
		$modeldata->user = $modelid;
		$modeldata->status = 'active';
		$modeldata->date = $dates;
		$modeldata->save();
		$ModelNotId = $modeldata->id;

		$upcoming = new notifycaststatus;
		$upcoming->NotId = $ModelNotId;
		$upcoming->cast_id = $castid;
		$upcoming->user_id = $modelid;
		$upcoming->status = $notify->id;
		$upcoming->date = $dates;
		$upcoming->time = $times;
		$upcoming->save();

					$getnum = DB::table('models')->where('user_id', '=', $modelid)->first();
		$num = $getnum->phone;
		$user = $getnum->displayName;
		$getmail = User::find($modelid);

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

    }
   
}

public function viewcast()
{
	$modelid = $_GET['modelid'];
	$cast = DB::table('casting')->where('casting.user_id', '=', Auth::user()->id)->where('status', '=', 'activated')->orderBy('id','DESC')->get();

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
			$btn = "<button class='btn btn-default'>Booked</button>";
		}else{
			$btn = "<button type='button' class='btn btn-primary btn-sm send' id=".$modelid.','.$key->id.">INVITE </button>";
		}

		$value .= "<div class='row casting-bg'>
                        <div class='col-lg-2 col-xs-3'>";
                        	if(empty($key->castImage))
                        	{ 
                        	$image = 	HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px'));
							}
							else
                        	{
                        	 $image = HTML::image($key->castImage ,'cast picture', array('width' => '60px'));
							}
			$value .= $image ."</div>
                        <div class='col-lg-5 col-xs-5'>
                            <h4>".$key->castTitle."</h4>
                            <h5>Location: ".$key->location."</h5>
                            <p>Casting closes: ".$key->DayExp."-".$key->Monthend."-".$key->Yearend."</p>
                        </div>
                        <div class='col-lg-4 col-xs-4'>
                        <br>
                        <br>
                        <br>".$btn."
                        </div>
                        </div>";

}
	echo $value;
}

public function viewcasts()
{
	$modelid = $_GET['modelid'];
	$cast = DB::table('casting')->where('casting.user_id', '=', Auth::user()->id)->where('status', '=', 'activated')->get();

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
			$btn = "<button class='btn btn-default'>Booked</button>";
		}else{
			$user_id = "$modelid,$key->id";
			$btn = "<button type='button' class='btn btn-primary btn-sm send' id=$user_id>INVITE </button>";
		}

		$value .= "<div class='row casting-bg'>
                        <div class='col-lg-2 col-xs-3'>";
                        	if(empty($key->castImage))
                        	{ 
                        	$image = 	HTML::image('img/photo.jpg', 'profile picture', array('width' => '60px'));
							}
							else
                        	{
                        	 $image = HTML::image($key->castImage ,'cast picture', array('width' => '60px'));
							}
			$value .= $image ."</div>
                        <div class='col-lg-5 col-xs-5'>
                            <h4>".$key->castTitle."</h4>
                            <h5>Location: ".$key->location."</h5>
                            <p>Casting closes: ".$key->DayExp."-".$key->Monthend."-".$key->Yearend."</p>
                        </div>
                        <div class='col-lg-4 col-xs-4'>
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
	$country = $formdata['country'];
	$location = $formdata['location'];
	$city = $formdata['town'];
	$Daycast = $formdata['Daycast'];
	$Monthcast = $formdata['Monthcast'];
	$Yearcast = $formdata['Yearcast'];
	$Dayend = $formdata['Dayend'];
	$Monthend = $formdata['Monthend'];
	$Yearend = $formdata['Yearend'];
	$status = 'pending';
	$visibility = 'none';
	# code...

	$others = new Casting;
		$others->user_id = Auth::user()->id;
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
		$others->status = $status;
		$others->visibility = $visibility;
		$others->save();

		$cast_id = $others->id;

		$affectedRows = new casttable;
    	$affectedRows->cast_id = $cast_id;
    	$affectedRows->user_id = $modelid;
    	$affectedRows->castMethod = 'invited';
    	$affectedRows->castStatus = 'confirmed';
    	$affectedRows->save();


}

    public function subscription()
	{
		$plan = usersplan::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->first();

		$getplan = DB::table('userplanduration')->where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->Join('limitation', 'userplanduration.plan_id', '=', 'limitation.plan_id')->get();

		$getnotifyunseen = $this->getunseen();
		$user = User::find(Auth::user()->id);
	$getcastunseen = $this->getcastunseen();
	$getmsgunseen = $this->getmsgunseen();
		return View::make('layouts.subscription')->with(compact('user', 'getcastunseen', 'getmsgunseen', 'getplan', 'getnotifyunseen'));
			
	}

	public function changesubscription()
	{
		# code...
		$user = User::find(Auth::user()->id);
		$getnotifyunseen = $this->getunseen();
		return View::make('layouts.changesubscription')->with(compact('user', 'getnotifyunseen'));
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
    	$plan = usersplan::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->first();

		$getplan = DB::table('userplanduration')->where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->Join('limitation', 'userplanduration.plan_id', '=', 'limitation.plan_id')->get();

	return $this->subscription();
	}

public function smsVerification()
{
	# code...
	$random = $_GET['random'];
	$user_id = Auth::user()->id;

	$getrandom = DB::table('randomnumbergenertor')->where('number', '=', $random)->count();
	if ($getrandom > 0) {
		# code...
		$getrandomdel = DB::table('randomnumbergenertor')->where('number', '=', $random)->delete();
		$insertNumber = new randomnumber;
		$insertNumber->user_id = $user_id;
		$insertNumber->number = $random;
		$insertNumber->verify = 'yes';
		$insertNumber->save();

	$verificationtables = DB::table('verificationtable')->where('user_id', '=', $user_id)->count();

	if ($verificationtables > 0) {
		# code...
		$verificationtable = DB::table('verificationtable')->where('user_id', '=', $user_id)->update(array('mobile' => 'yes'));
	}else{
		$randomnumbergenertor = new verificationtable;
		$randomnumbergenertor->user_id = $user_id;
		$randomnumbergenertor->mobile = 'yes';
		$randomnumbergenertor->save();
	}
	echo "<p>Verification accepted</p>";
	}
	else{
		echo "Generate new number";
	}
}

public function getmodeltype($id)
{
	# code...
	$getreallife = DB::table('distable')->where('dis_id', '=', $id)->Join('usersplan', 'distable.user_id', '=', 'usersplan.user_id')->where('usersplan.status', '=', 'active')->Join('photoupload', 'distable.user_id', '=', 'photoupload.user_id')->Join('models', 'distable.user_id', '=', 'models.user_id')->select('usersplan.user_id', 'usersplan.plan_id', 'models.displayName', 'models.location', 'photoupload.imagename')->take(4)->orderBy('distable.id','DESC')->get();

		$viewreallife = '';

	$viewreallife .= "<div class='col-lg-12 col-sm-12 col-xs-12'>
						<div class='row'>
							<div class='col-lg-12 col-sm-12 col-xs-12'>
								<div class='row'>";
								foreach ($getreallife as $key) {
									# code...
												if ($key->plan_id == '2') {
													# code..
													$class = 'imgborder';
												}elseif ($key->plan_id == '3') {
													# code...
													$class = 'imgborder2';
												}else{
													$class = 'imgborder1';
												}
								$users = User::find($key->user_id);
				$viewreallife .= "<div class='col-lg-3 col-sm-3 col-xs-6'>";
				$viewreallife .=	  "<a href=/models/profile/".$key->user_id." >";
				$viewreallife .= HTML::image($key->imagename ,'cast picture', array('width' => '85px', 'height' => '85px', 'class' => "img-circle $class", 'data-toggle' =>'tooltip', 'data-placement'=>'bottom', 'title'=>$key->displayName)); 
				$viewreallife .= "</a>
								</div>";
								}
				$viewreallife .= "</div>
							</div>
						</div>
					</div>";

			return $viewreallife;
}

public function getpaidusers()
{
	# code...
	$getreallife = DB::table('usersplan')->where('usersplan.plan_id', '!=', '1')->where('usersplan.status', '=', 'active')->Join('photoupload', 'usersplan.user_id', '=', 'photoupload.user_id')->Join('models', 'usersplan.user_id', '=', 'models.user_id')->select('usersplan.user_id', 'usersplan.plan_id', 'models.displayName', 'models.location', 'photoupload.imagename')->take(20)->orderBy('usersplan.user_id','DESC')->get();

		$viewreallife = '';

								foreach ($getreallife as $key) {
									# code...
												if ($key->plan_id == '2') {
													# code..
													$class = 'imgborder';
												}elseif ($key->plan_id == '3') {
													# code...
													$class = 'imgborder2';
												}
								$users = User::find($key->user_id);
				$viewreallife .= "<div class='col-lg-2 col-sm-2 col-xs-6'>";
				$viewreallife .=	  "<a href=/models/profile/".$key->user_id." >";
				$viewreallife .= HTML::image($key->imagename ,'cast picture', array('width' => '120', 'height' => '120px', 'class' => "$class img-responsive", 'data-toggle' =>'tooltip', 'data-placement'=>'bottom', 'title'=>$key->displayName)); 
				$viewreallife .= "</a>
								</div>";
								}

			return $viewreallife;
}

public function getprotype($value)
{
	# code...
	$getafroplus = DB::table('users')->where('user_type', '=', $value)->Join('usersplan', 'users.id', '=', 'usersplan.user_id')->where('usersplan.plan_id', '!=', '1')->where('usersplan.status', '=', 'active')->Join('photoupload', 'users.id', '=', 'photoupload.user_id')->Join('models', 'users.id', '=', 'models.user_id')->select('usersplan.user_id', 'usersplan.plan_id', 'usersplan.status', 'models.displayName', 'models.location', 'photoupload.imagename')->take(4)->get();

	$users = '';
	$viewpromodel = '';

	$viewpromodel .= "<div class='col-lg-12'>
						<div class='row'>
							<div class='col-lg-12'>
								<div class='row'>";
								foreach ($getafroplus as $key) {
									# code...
						if ($key->plan_id == '2') {
							# code..
							$class = 'imgborder';
						}elseif ($key->plan_id == '3') {
							# code...
							$class = 'imgborder2';
						}
								$users = User::find($key->user_id);
				$viewpromodel .= "<div class='col-lg-3'>
									<a href=/models/profile/".$key->status.">";
				$viewpromodel .= HTML::image($key->imagename ,'cast picture', array('width' => '85px', 'height' => '85px', 'class' => 'img-circle $class', 'data-toggle' =>'tooltip', 'data-placement'=>'bottom', 'title'=>$key->displayName)); 
				$viewpromodel .= 	"</a>
									</div>";
								}
				$viewpromodel .= "</div>
							</div>
						</div>
					</div>";
	return $viewpromodel;
}

public function modelsearch()
{
	# code...
	$getCountry = DB::table('models')->select('country')->distinct()->get();
	if (!empty(Auth::user()->id)) {
		# code...
		$getnotifyunseen = $this->getunseen();
		$userAuth = Auth::user()->id;
	}else{
	$getnotifyunseen = '';
	$userAuth = '';	
	}
	$location = DB::table('models')->select('location')->distinct()->get();
	$categories = DB::table('disciplines')->get();
	$modelType = DB::table('categories')->get();

	$getmodel = DB::table('models')->Join('verificationtable', 'models.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->Join('photoupload', 'models.user_id', '=', 'photoupload.user_id')->take(20)->get();

		$viewnewface = $this->getprotype('newFace');

			$viewpromodel = $this->getprotype('proModel');

			$viewfashion = $this->getmodeltype(21);

			$viewhighfashion = $this->getmodeltype(33);

					$viewreallife = $this->getmodeltype(29);

		$actors = $this->getmodeltype(1); 

		$viewplussized = $this->getmodeltype(27);

		$viewsenior = $this->getmodeltype(26);

		$getpaidusers = $this->getpaidusers();
		

	return View::make('layouts.modelsearch')->with(compact('getCountry', 'getnotifyunseen', 'viewsenior', 'userAuth', 'viewplussized', 'viewreallife', 'actors', 'viewhighfashion', 'viewfashion', 'location', 'viewpromodel', 'viewnewface',  'categories', 'modelType', 'getmodel', 'getpaidusers'));
}

public function searchmodel()
{
	# code...
	sleep(3);
	parse_str($_GET['user'], $formdata);

	$model = DB::table('models');
		$getit = '';
		$view = '';
		if (!empty($formdata['gender'])) {
			# code...
			$gender = $formdata['gender'];
			$getit= $model->where('gender', '=', $gender);
		}
		if (!empty($formdata['getcountry'])) {
			# code...
			$getcountry = $formdata['getcountry'];
			$getit = $model->where('country', '=', $getcountry);
		}
		if (!empty($formdata['getstates'])) {
			# code...
			$getstates = $formdata['getstates'];
			$getit = $model->where('location', '=', $getstates);
		}
		if (!empty($formdata['categories'])) {
			# code...
			$categories = $formdata['categories'];
			$getit = $model->join('distable', function($join) use ($categories)
                    {
                        $join->on('models.user_id', '=', 'distable.user_id')
                             ->where('distable.dis_id', '=', $categories);
                    });
		}
		if (!empty($formdata['types'])) {
			# code...
			$types = $formdata['types'];
			$getit = $model->join('catinput', function($join) use ($types)
                    {
                        $join->on('models.user_id', '=', 'catinput.user_id')
                             ->where('catinput.cat_id', '=', $types);
                    });
		}

		if (!empty($formdata['modelType'])) {
			# code...
			$newface = $formdata['modelType'];
			$getit = $model->join('users', function($join) use ($newface)
                    {
                        $join->on('models.user_id', '=', 'users.id')
                             ->where('users.user_type', '=', $newface);
                    });
		}
		if (!empty($formdata['agemin'])) {
			# code...
			$agemin = $formdata['agemin'];
			$getit = $model->where('Age', '>=', $agemin);
		}
		if (!empty($formdata['agemax'])) {
			# code...
			$agemax = $formdata['agemax'];
			$getit = $model->where('Age', '<=', $agemax);
		}
		if (!empty($formdata['height-min'])) {
			# code...
			$heightmin = $formdata['height-min'];
			$getit = $model->where('Height', '>=', $heightmin);
		}
		if (!empty($formdata['height-max'])) {
			# code...
			$heightmax = $formdata['height-max'];
			$getit = $model->where('Height', '<=', $heightmax);
		}
		if (!empty($formdata['bust-min'])) {
			# code...
			$bustmin = $formdata['bust-min'];
				# code...
				
			$getit = $model->join('modelpreference', function($join) use ($bustmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.chestbust', '>=', $bustmin );
                    });
			
		}
		if (!empty($formdata['bust-max'])) {
			# code...
			$bustmax = $formdata['bust-max'];

			if (!empty($formdata['bust-min'])) {
				# code...
				$bustmax = $formdata['bust-max'];
			$getit = $model->where('modelpreference.chestbust', '<=', $bustmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($bustmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.chestbust', '<=', $bustmax );
                    });				
			}

						
		}
		if (!empty($formdata['collar-min'])) {
			# code...
			$collarmin = $formdata['collar-min'];
			$getit = $model->join('modelpreference', function($join) use ($collarmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.collar', '>=', $collarmin );
                    });
		}
		if (!empty($formdata['collar-max'])) {
			# code...
			
			$collarmax = $formdata['collar-max'];
			if (!empty($formdata['collar-min'])) {
				# code...
			$getit = $model->where('modelpreference.collar', '<=', $collarmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($collarmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.collar', '<=', $collarmax );
                    });
			}
		}
		if (!empty($formdata['dress-min'])) {
			# code...
			$dressmin = $formdata['dress-min'];
			$getit = $model->join('modelpreference', function($join) use ($dressmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.dress', '>=', $dressmin );
                    });
		}
		if (!empty($formdata['dress-max'])) {
			# code...
			$dressmax = $formdata['dress-max'];
			if (!empty($formdata['dress-min'])) {
				# code...
			$getit = $model->where('modelpreference.dress', '<=', $dressmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($dressmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.dress', '<=', $dressmax );
                    });
		}
		}
		if (!empty($formdata['haircolor'])) {
			# code...
			$haircolor = $formdata['haircolor'];
			$getit = $model->join('modelpreference', function($join) use ($haircolor)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.hair_color', '=', $haircolor );
                    });
		}if (!empty($formdata['waist-min'])) {
			# code...
			$waistmin = $formdata['waist-min'];
			$getit = $model->join('modelpreference', function($join) use ($waistmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.waist', '>=', $waistmin );
                    });
		}
		if (!empty($formdata['waist-max'])) {
			# code...
			$waistmax = $formdata['waist-max'];
			if (!empty($formdata['waist-min'])) {
				# code...
			$getit = $model->where('modelpreference.waist', '<=', $waistmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($waistmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.waist', '<=', $waistmax );
                    });
		}
		}
		if (!empty($formdata['jacket-min'])) {
			# code...
			$jacketmin = $formdata['jacket-min'];

			$getit = $model->join('modelpreference', function($join) use ($jacketmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.jacket', '>=', $jacketmin );
                    });
		}
		if (!empty($formdata['jacket-max'])) {
			# code...
			$jacketmax = $formdata['jacket-max'];
			if (!empty($formdata['jacket-min'])) {
				# code...
			$getit = $model->where('modelpreference.jacket', '<=', $jacketmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($jacketmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.jacket', '<=', $jacketmax );
                    });
		}
		}
		if (!empty($formdata['shoes-min'])) {
			# code...
			$shoesmin = $formdata['shoes-min'];
			$getit = $model->join('modelpreference', function($join) use ($shoesmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.shoes', '>=', $shoesmin );
                    });
		}
		if (!empty($formdata['shoes-max'])) {
			# code...
			$shoesmax = $formdata['shoes-max'];
			if (!empty($formdata['shoes-min'])) {
				# code...
			$getit = $model->where('modelpreference.shoes', '<=', $shoesmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($shoesmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.shoes', '<=', $shoesmax );
                    });
		}
		}
		if (!empty($formdata['trousers-min'])) {
			# code...
			$trousersmin = $formdata['trousers-min'];
			$getit = $model->join('modelpreference', function($join) use ($trousersmin)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.trousers', '>=', $trousersmin );
                    });
		}
		if (!empty($formdata['trousers-max'])) {
			# code...
			$trousersmax = $formdata['trousers-max'];
			if (!empty($formdata['trousers-min'])) {
				# code...
			$getit = $model->where('modelpreference.shoes', '<=', $trousersmax );
			}else{
			$getit = $model->join('modelpreference', function($join) use ($trousersmax)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.trousersmax', '<=', $trousersmax );
                    });
		}
		}
		if (!empty($formdata['ethnicity'])) {
			# code...
			$ethnicity = $formdata['ethnicity'];
			$getit = $model->join('modelpreference', function($join) use ($ethnicity)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.ethnicity', '=', $ethnicity );
                    });
		}
		if (!empty($formdata['Hair_type'])) {
			# code...
			$Hair_type = $formdata['Hair_type'];
			$getit = $model->join('modelpreference', function($join) use ($Hair_type)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.Hair_type', '=', $Hair_type );
                    });
		}
		if (!empty($formdata['butt'])) {
			# code...
			$butt = $formdata['butt'];
			$getit = $model->join('modelpreference', function($join) use ($butt)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.butt', '=', $butt );
                    });
		}
		if (!empty($formdata['eyes'])) {
			# code...
			$eyes = $formdata['eyes'];
			$getit = $model->join('modelpreference', function($join) use ($eyes)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.eyes', '=', $eyes );
                    });
		}
		if (!empty($formdata['languages'])) {
			# code...
			$languages = $formdata['languages'];
			$getit = $model->join('modelpreference', function($join) use ($languages)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.languages', '=', $languages );
                    });
		}
		if (!empty($formdata['qualification'])) {
			# code...
			$qualification = $formdata['qualification'];
			$getit = $model->join('modelpreference', function($join) use ($qualification)
                    {
                        $join->on('models.user_id', '=', 'modelpreference.modelId')
                             ->where('modelpreference.qualification', '=', $qualification );
                    });
		}
		if (!empty($formdata['imagecat'])) {
			# code...
			$disid = $formdata['imagecat'];
			$getit = $model->leftjoin('imagecategory', function($join) use ($disid)
                    {
                        $join->on('models.user_id', '=', 'imagecategory.user_id')
                             ->where('imagecategory.disid', '=', $disid );
                    });
		}
		$errors = array_filter($formdata);
		if (empty($errors)) {
			# code...
			$getit = $model->join('users', function($join)
                    {
                        $join->on('models.user_id', '=', 'users.id')
                             ->where('users.user_type', '=', 'proModel');
                    });
		}
	
	$result = $getit->get();
	$getuser = $getit->paginate(15);

				$view .=	"<div class='row showmodels'>
						<div class='col-lg-12'>
							<div class='row'>";
								foreach ($result as $key) {
									# code...
									$getuserplan = DB::table('usersplan')->where('user_id', '=', $key->user_id)->where('status', '=', 'active')->first();
							if ($getuserplan) {
								# code...
								if ($getuserplan->plan_id == '2') {
							# code..
								$class = 'imgborder';
								}elseif ($getuserplan->plan_id == '3') {
									# code...
									$class = 'imgborder2';
								}else{
								$class = 'imgborder1';	
							}
							}else{
								$class = 'imgborder1';	
							}

									$displayName = str_limit($key->displayName, 10, $end = '...');
						$view	.=  "<div class='col-lg-2 col-xs-2 col-sm-2' style = 'margin-bottom: 10px; width: 130px; height: 174px; color: #000'>
										<a href=models/profile/".$key->user_id." class='userdtl' id=".$key->user_id." style='color: #000'>";
						$user = User::find($key->user_id);
						if (!empty($key->imageid)) {
							$getimg = DB::table('imagegallery')->where('id', '=', $key->imageid)->first();
							$view .=  $image = HTML::image($getimg->imagename ,'profile', array('width' => '130px', 'height' => '174px', 'class'=>"img-responsive $class"));
							        
						}else{
							

						if(!empty($user->photoupload->imagename)){
							
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '130px', 'height' => '174px', 'class'=>"img-responsive $class"));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px', 'class'=>"img-responsive $class"));
									}
						}
						$view 	.=	"<p style='color: #000'><strong>".$displayName."</strong></p>
									</a>
										<div class=usershow".$key->user_id.">
										</div>
									</div>";
								}
						$view .= "</div>";
							"</div>
						</div>";
	

	echo $view;

}

public function viewsearch()
{
	# code...
	$id = $_GET['user'];
	echo "ebere";

}

public function searchmodeltext()
{
	# code...
	parse_str($_GET['val'], $formdata);
	$val = $formdata['search'];
	$view = '';
	$result = DB::table('models')->where('displayName', 'LIKE','%'.$val.'%')->get();

	$view .=	"<div class='row showmodels'>
						<div class='col-lg-12'>
							<div class='row'>";
								foreach ($result as $key) {
									# code...
						$view	.=  "<div class='col-lg-2' style = 'margin-bottom: 10px'>
										<a href=models/profile/".$key->user_id.">";
						$user = User::find($key->user_id);
						$name = $user->NewModel->displayName;
						$displayName = str_limit($name, 10, $end = '...');;
						if(!empty($user->photoupload->imagename)){
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '131px', 'height' => '174px'));
							        }
							        else{
							$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px'));
									}
						$view 	.=	"<p style='color: #000'><strong>$displayName</strong></p>
									</a>
									</div>";
								}
						$view .= "</div>
							</div>
						</div>";
	

	echo $view;		
}

public function pollingsystem()
{
	# code...
	$getpoll = DB::table('castlikes')->select('likesreciever')->distinct()->get();
	foreach ($variable as $key => $value) {
		# code...
	}
}

public function casting()
{
	# code...
	$cstCountry = DB::table('casting')->where('visibility', '!=', 'none')->select('country')->distinct()->get();
	$getstate = DB::table('casting')->where('visibility', '!=', 'none')->select('location')->distinct()->get();
	$getlocation = DB::table('casting')->where('visibility', '!=', 'none')->where('status', '=', 'activated')->orderBy('id', 'DESC')->get();
	$countcast = DB::table('casting')->where('status', '=', 'activated')->where('visibility', '!=', 'none')->count();
	$num = $countcast/6;
	$val = ceil($num);
	$values = '';

	if ($getlocation) {
		
		foreach ($getlocation as $key) {

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$daycast = $key->DayExp;
		$monthcast = $key->MonthExp;
		$yearcast = $key->YearExp;


				$date1 = strtotime("$key->YearExp-$key->MonthExp-$key->DayExp");	
		$datecast = date('l, j F Y', $date1);
		$date2 = strtotime("$key->created_at");
		$datecreate = date('l, j F Y', $date2);
		if ($key->gender == 'both') {
			# code...
			$gender = 'male/female';
		}
		else{
			$gender = $key->gender;
		}

		if ($key->payType == 'paid') {
			# code...
			$amt = number_format($key->payDesc);
			$btn = "<h4><i class='fa fa-money'></i> $amt<strong></strong></h4>";
		}elseif ($key->payType == 'Other') {
			# code...
			$btn = "<h5><strong>Other</strong></h5>";
		}
		else{
			$btn = "<h5><strong>TFP</strong> <span style='font-variant: small-caps;'>(Time for print or Trade for print)</span></h5>";
		}

        $values        .=   "<li><div class='container'>
        					<div class='row casting-bg'>
                        		<div class='col-lg-3 col-sm-4'>";
                        	if(!empty($key->castImage)){
							 $values .=  $image = HTML::image($key->castImage ,'profile', array('width' => '130px', 'height' => '174px', 'class' => 'img-responsive'));
							        }
							        else{
							$values .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px', 'class' => 'img-responsive'));
									}
        $values         .=       "</div>
                        <div class='col-lg-6 col-sm-5'>
                            <a href=/others/showcastdetail/".$key->id.">".$key->castTitle."</a>
                            <p>".$gender." models</p>
                            <h5><strong><span class='glyphicon glyphicon-map-marker'></strong> ".$key->location."</h5>
                            $btn
                            <p>Cast Created: ".$datecreate."</p>
                            <p>Casting closes: ".$datecast."</p>
                        </div>
                        <div class='col-lg-3 col-sm-2 text-left'>
                        <br>
                        <br>
                        <br>
                            <a href=/others/showcastdetail/".$key->id." class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
                        </div>
                    </div>
                    </div>
                    <br></li>";

		
	}

	}

$values .= "<script type='text/javascript'>
	    $('.paginate').paginathing({
	    perPage: 6,
	    limitPagination: $val
		})
		</script>";

		if(!empty(Auth::user()->id)){
		$getnotifyunseen = $this->getunseen();	
	}else{
		$getnotifyunseen = '';
	}

		

	return View::make('layouts.casting')->with(compact('cstCountry', 'getstate', 'values', 'getnotifyunseen'));
}

public function castingdetail()
{
	$castlocation = $_GET['location'];
	if ($castlocation == 'all') {
		$getlocation = DB::table('casting')->where('visibility', '!=', 'none')->where('status', '=', 'activated')->orderBy('id','DESC')->get();
		$getcount = DB::table('casting')->where('visibility', '!=', 'none')->where('status', '=', 'activated')->count();
	}else{
		$getlocation = DB::table('casting')->where('location', '=', $castlocation)->where('visibility', '!=', 'none')->where('status', '=', 'activated')->orderBy('id','DESC')->get();
		$getcount = DB::table('casting')->where('location', '=', $castlocation)->where('visibility', '!=', 'none')->where('status', '=', 'activated')->count();
	}
	
	# code...
	$value = '';
	
	if ($getcount > 0) {
		# code...
	$countcast = DB::table('casting')->where('status', '=', 'activated')->where('visibility', '!=', 'none')->count();
	$num = $countcast/6;
	$val = ceil($num);
	$value = '';
	foreach ($getlocation as $key) {
		# code...
			$date1 = strtotime("$key->YearExp-$key->MonthExp-$key->DayExp");	
		$datecast = date('l, j F Y', $date1);
		if ($key->gender == 'both') {
			# code...
			$gender = 'male/female';
		}
		else{
			$gender = $key->gender;
		}

		if ($key->payType == 'paid') {
			# code...
			$btn = "<h4><i class='fa fa-money'></i> <strong>$key->payDesc</strong></h4>";
		}else{
			$btn = "<h5><strong>TFP</strong> <span style='font-variant: small-caps;'>(Time for print or Trade for print)</span></h5>";
		}

        $value         .=   "<li><div class='container'>
        					<div class='row casting-bg'>
                        		<div class='col-lg-3 col-sm-4'>";
                        	if(!empty($key->castImage)){
							 $value .=  $image = HTML::image($key->castImage ,'profile', array('width' => '130px', 'height' => '174px', 'class' => 'img-responsive'));
							        }
							        else{
							$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px', 'class' => 'img-responsive'));
									}
        $value         .=       "</div>
                        <div class='col-lg-6 col-sm-5'>
                            <a href=/others/showcastdetail/".$key->id.">".$key->castTitle."</a>
                            <p>".$gender." models</p>
                            <h5><strong><span class='glyphicon glyphicon-map-marker'></strong> ".$key->location."</h5>
                            $btn
                            <p>Casting closes: ".$datecast."</p>
                        </div>
                        <div class='col-lg-3 col-sm-2 text-left'>
                        <br>
                        <br>
                        <br>
                            <a href=/others/showcastdetail/".$key->id." class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
                        </div>
                    </div>
                    </div>
                    <br>
                    </li>";
	}
	$value = "<ul class='paginate'  style='list-style-type: none'>
						$value
			</ul>
					<script type='text/javascript'>
				    $('.paginate').paginathing({
				    perPage: 6,
				    limitPagination: $val
					})
					</script>";
}else{
	$value .= "<div class='container'>
        		<div class='row'>
        			<h2>!!!Oopps No Cast Yet in this Location</h2>
        		</div>
        	</div>";

}
	echo $value;
}


public function castsearchcode()
{
	# code...
	$id = $_GET['val'];
	$value = '';
	$dbsearch = DB::table('casting')->where('castcode', '=', $id)->get();
	if ($dbsearch) {
		# code...
	foreach ($dbsearch as $key) {
		# code...
        $value         .=   "<div class='row casting-bg'>
                        		<div class='col-lg-2'>";
                        	if(!empty($key->castImage)){
							 $value .=  $image = HTML::image($key->castImage ,'profile', array('width' => '130px', 'height' => '174px'));
							        }
							        else{
							$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '130px', 'height' => '174px'));
									}
        $value         .=       "</div>
                        <div class='col-lg-8' style='padding-top: 20px; padding-left: 50px;''>
                            <a href=>".$key->castTitle."</a>
                            <p>".$key->gender." models</p>
                            <h5>".$key->location."</h5>
                            <p>Casting closes: ".$key->YearExp."-".$key->MonthExp."-".$key->DayExp."</p>
                        </div>
                        <div class='col-lg-2'>
                        <br>
                        <br>
                        <br>
                            <a href=/others/showcastdetail/".$key->id." class='btn btn-default' style='background-color: #54d7e3; color: #fff;''>MORE DETAILS</a>
                        </div>
                    </div>
                    <br>";
	}
	echo $value;
}
	else{
		echo "no result";
	}
}

public function sendnews()
{
	# code...
	$user_id = Auth::user()->id;
	
	$notify = DB::table('notification')->where('name', '=', 'status')->first();

	$newsmsg = $_GET['newsmsg'];

	$addnews = new status;
	$addnews->user_id = $user_id;
	$addnews->status = $newsmsg;
	$addnews->date = date('d-m-Y');
	$addnews->save();
	$statusId = $addnews->id;

	$addnewsId = $addnews->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifynews;
	$addnotify->NotId = $ModelNotId;
	$addnotify->statusId = $statusId;
	$addnotify->user_id = $user_id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getStatus = DB::table('status')->where('id', $statusId)->get();
	$view = '';
	foreach ($getStatus as $key) {
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
							 $view .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
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
								<hr>
								</div>";
	}

	echo $view;	

}

public function gtnotifystatus($id)
{
	# code...
	$value = '';
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
			$geylikestatus = DB::table('statuslike')->where('statusId', '=', $getnews->statusId)->count();
		$userlikestaus = DB::table('statuslike')->where('statusId', '=', $getnews->statusId)->where('sender_id', '=', Auth::user()->id)->first();
		$getcomment = DB::table('statuscomment')->where('statusId', '=', $getnews->statusId)->count();

		$user = User::find($getnews->user_id);
		if (empty($user->NewModel->displayName)) {
			# code...
			$name = $user->Others->agentName;
		}else{
			$name = $user->NewModel->displayName;
		}

		switch ($user->user_type) {
				case 'proModel':
					$user_type_spec = 'Professional model';
					$url = "/models/profile/".$getnews->user_id;
					break;
				case 'newFace':
					$user_type_spec = 'New Face';
					$url = "/models/profile/".$getnews->user_id;
					break;
				case 'photo':
					$user_type_spec = 'Photographer';
					$url = "/others/showprofile/".$getnews->user_id;
					break;
				case 'agent':
					$user_type_spec = 'Agency';
					$url = "/others/showprofile/".$getnews->user_id;
					break;
				case 'artist':
					$user_type_spec = 'Hair & Make-up Artist';
					$url = "/others/showprofile/".$getnews->user_id;
					break;
				case 'fashion':
					$user_type_spec = 'Fashion stylist';
					$url = "/others/showprofile/".$getnews->user_id;
					break;
				case 'tattoo':
					$user_type_spec = 'Tattoo Artist';
					$url = "/others/showprofile/".$getnews->user_id;
					break;
				case 'others':
$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
					$url = "/others/showprofile/".$getnews->user_id;
					break;
			}

$value .=	"<li>
			<div class='row' style='border: 1px solid #54d7e3;'>
		<div class='col-lg-12 col-xs-12'>
			<div class='row'>
				<div class='col-lg-8 col-xs-8'>
					<p>".$getStatus->status."</p>
					<br>
					<br>
				</div>
				<div class='col-lg-4 col-xs-4'>
					<div class='row'>
					<div class='col-lg-8 col-xs-5'>
					</div>
					<div class='col-lg-4 col-xs-7 text-center likeStatus likeshow".$getnews->statusId."' style='cursor: pointer' id=".$getnews->statusId.">";
					if ($geylikestatus) {
						# code...
	$value .= 			"<div class='row'>
								<span class='glyphicon glyphicon-heart' style='font-size: 250%; z-index: 1; color: #54d7e3;'>
								</span>
						</div>
						<div class='row' style='background-color: #000; color:#fff; font-weight: bold;'>
								".$geylikestatus."
						</div>";
					}else{
	$value .=			"<div class='row'>
								<span class='glyphicon glyphicon-heart' style='font-size: 250%; z-index: 1; color: pink;'>
								</span>
						</div>
						<div class='row' style='background-color: #000; color:#fff; font-weight: bold;'>
								".$geylikestatus."
						</div>";
						}
	$value .=	"</div>
				</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-lg-1 col-xs-1'>";
		if(!empty($user->photoupload->imagename)){
					 $value .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '33px'));
					        }
					        else{
					$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '33px'));
							}	
	$value .=	"</div>
				<div class='col-lg-7 col-xs-10'>
					<p>Posted by <a href=".$url.">".$name."</a> | ".$user_type_spec." |<br>
					".$getnews->date." | <a href=comment/".$getnews->id.">View | (".$getcomment.") Comments</a> </p>
				</div>
				<div class='col-lg-4'>
				
				</div>
			</div>
		</div>
	</div>
	<br></li>";
		}

		return $value;

}

public function gtuploadphoto($id)
{
	# code...
	$view = '';
	$getupload = DB::table('notifyuploadphoto')->where('NotId', '=', $id)->first();
	$user = $getupload->user_id;

	$following = Auth::user()->id;

		$imagegallery = DB::table('imagegallery')->where('id', $getupload->img_id)->first();

		$date1 = strtotime($imagegallery->created_at);	
	$dateimg = date('j F Y', $date1);

	$geylikestatus = DB::table('imagelike')->where('imageid', '=', $getupload->img_id)->count();
		$userlikestaus = DB::table('imagelike')->where('imageid', '=', $getupload->img_id)->where('sender_id', '=', Auth::user()->id)->first();

		$getcomment = DB::table('imagecomment')->where('imageid', '=', $getupload->img_id)->count();
		$getnews = DB::table('imagecomment')->where('imageid', '=', $getupload->img_id)->first();

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

			switch ($users->user_type) {
				case 'proModel':
					$user_type_spec = 'Professional model';
					$url = "/models/profile/".$imagegallery->user_id;
					break;
				case 'newFace':
					$user_type_spec = 'New Face';
					$url = "/models/profile/".$imagegallery->user_id;
					break;
				case 'photo':
					$user_type_spec = 'Photographer';
					$url = "/others/showprofile/".$imagegallery->user_id;
					break;
				case 'agent':
					$user_type_spec = 'Agency';
					$url = "/others/showprofile/".$imagegallery->user_id;
					break;
				case 'artist':
					$user_type_spec = 'Hair & Make-up Artist';
					$url = "/others/showprofile/".$imagegallery->user_id;
					break;
				case 'fashion':
					$user_type_spec = 'Fashion stylist';
					$url = "/others/showprofile/".$imagegallery->user_id;
					break;
				case 'tattoo':
					$user_type_spec = 'Tattoo Artist';
					$url = "/others/showprofile/".$imagegallery->user_id;
					break;
				case 'others':
$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
					$url = "/others/showprofile/".$imagegallery->user_id;
					break;
			}

			$view .= "<li>
						<div class='row' style='border: 1px solid #54d7e3;'>
						<div class='col-lg-7 col-xs-5'>
						<div class='row'>
							<div class='col-lg-2 col-xs-1'>
							<br><br>";
					if(!empty($users->photoupload->imagename)){
								 $view .=  $image = HTML::image($users->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '33px'));
								        }
								        else{
								$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '33px'));
										}	
				$view .=	"</div>
							<div class='col-lg-10 col-xs-8'>
								<br>
								<br>
								<p>By <a href=".$url.">".$name."</a>,<br>
								".$dateimg." | <a href=imagecomment/".$imagegallery->id.">View | (".$getcomment.") Comments</a> </p>
							</div>
						</div>
						</div>
						<br><br>
						<div class='col-lg-4 col-xs-5 text-right'>
						<div class='demo-gallery'>
				            <ul id=hash$id class='list-unstyled row gallery'>
				 					<li class='col-lg-12' galleryId=$imagegallery->id data-responsive=/$imagegallery->imagename data-src=/$imagegallery->imagename data-sub-html='' style='margin-bottom: 5px' id=pix$imagegallery->id>
				                    
				                        <img class='text-right img-responsive' src=/$imagegallery->imagename>
				  
				                	</li>
				            </ul>
				        </div></div>";
		$view .=	"<div class='col-lg-1 col-xs-1 text-center'>
						<div class='row'>
						<div class='col-lg-12 col-xs-12 text-center likeimage likeshow".$imagegallery->id."' style='cursor: pointer' id=".$imagegallery->id.">";
						if ($userlikestaus) {
							# code...
		$view .= 			"<div class='row'>
									<span class='glyphicon glyphicon-heart' style='font-size: 150%; z-index: 1; color: #54d7e3;'>
									</span>
							</div>
							<div class='row' style='background-color: #000; color: #fff'>
									".$geylikestatus."
							</div>";
						}else{
		$view .=			"<div class='row'>
									<span class='glyphicon glyphicon-heart' style='font-size: 150%; z-index: 1; color: pink;'>
									</span>
							</div>
							<div class='row' style='background-color: #000; color: #fff'>
									".$geylikestatus."
							</div>";
							}
		$view .=	"</div>
					</div>
						</div>
					  </div><br>
					  </li>";
		}

		return $view;
}

public function getfollowersupdate()
{			
	# code...
		$slNotification = DB::table('modelnofity')->orderBy('id','DESC')->where('status', '=', 'active')->where(function($query1) {
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
		$vals = '';
		$vals .= "<ul class='paginate' style='list-style-type: none'>";
		$vals .= $countVal;
		$vals .= "</ul>";
		$value = $vals;
	}else{
		$value = '';
	}
	return $value;

}

public function newspage()
{
	# code...
	$value = $this->getfollowersupdate();

	$getnotifyunseen = $this->getunseen();
	return View::make('layouts.newspage')->with(compact('value', 'getnotifyunseen'));
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

public function getUserType($id)
{
	# code...
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
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
					break;
			}

	return $user_type_spec;
}

public function imagecomment($id)
{
	# code...
	$comId = $id;
	$getStatus = DB::table('imagegallery')->where('id',$comId)->get();
if ($getStatus) {
	# code...
	$getuser = User::find(Auth::user()->id);
	$value = '';
	foreach ($getStatus as $key) {
		# code...
		$commid = $key->id;

		$date1 = strtotime($key->created_at);	
		$dateimg = date('l, j F Y', $date1);

		$getcomment = DB::table('imagecomment')->where('imageid', '=', $commid)->count();

		$geylikestatus = DB::table('imagelike')->where('imageid', '=', $key->id)->count();
		$userlikestaus = DB::table('imagelike')->where('imageid', '=', $key->id)->where('sender_id', '=', Auth::user()->id)->first();

		$users = User::find($key->user_id);
			if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}

			switch ($users->user_type) {
				case 'proModel':
					$user_type_spec = 'Professional model';
					$url = "/models/profile/".$key->user_id;
					break;
				case 'newFace':
					$user_type_spec = 'New Face';
					$url = "/models/profile/".$key->user_id;
					break;
				case 'photo':
					$user_type_spec = 'Photographer';
					$url = "/others/showprofile/".$key->user_id;
					break;
				case 'agent':
					$user_type_spec = 'Agency';
					$url = "/others/showprofile/".$key->user_id;
					break;
				case 'artist':
					$user_type_spec = 'Hair & Make-up Artist';
					$url = "/others/showprofile/".$key->user_id;
					break;
				case 'fashion':
					$user_type_spec = 'Fashion stylist';
					$url = "/others/showprofile/".$key->user_id;
					break;
				case 'tattoo':
					$user_type_spec = 'Tattoo Artist';
					$url = "/others/showprofile/".$key->user_id;
					break;
				case 'others':
					$getuser = DB::table('industryprofessionalusers')->where('user_id', '=', Auth::user()->id)->first();
		$getusertype = DB::table('industryprofessional')->where('id', '=', $getuser->industry_id)->first();
			$user_type_spec = $getusertype->name;
					$url = "/others/showprofile/".$key->user_id;
					break;
			}

		$value4 = '';
		$value4 .=	"<div class='col-lg-3 col-xs-2 text-center'>
						<div class='col-lg-3 col-xs-7 text-center likeimage likeshow".$key->id."' style='cursor: pointer' id=".$key->id.">";
						if ($userlikestaus) {
							# code...
		$value4 .= 			"<div class='row'>
									<span class='glyphicon glyphicon-heart' style='font-size: 150%; z-index: 1; color: #54d7e3;'>
									</span>
							</div>
							<div class='row' style='background-color: #000; color: #fff'>
									".$geylikestatus."
							</div>";
						}else{
		$value4 .=			"<div class='row'>
									<span class='glyphicon glyphicon-heart' style='font-size: 150%; z-index: 1; color: pink;'>
									</span>
							</div>
							<div class='row' style='background-color: #000; color: #fff'>
									".$geylikestatus."
							</div>";
							}
		$value4 .=	"</div>
					</div>";

			$value .= "<div class='row'>
						<div class='col-lg-8 col-xs-7'>
						<div class='row'>
							<div class='col-lg-2 col-xs-2'>
							<br><br>";
					if(!empty($users->photoupload->imagename)){
								 $value .=  $image = HTML::image($users->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '33px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '33px'));
										}	
				$value .=	"</div>
							<div class='col-lg-10 col-xs-9'>
								<br>
								<br>
								<p>Posted by <a href=".$url.">".$name."</a> | ".$user_type_spec." |<br>
								".$dateimg." | <a href=/users/imagecomment/".$key->id.">(".$getcomment.") Comments</a> </p>
							</div>
						</div>
						</div>
						<div class='col-lg-4 col-xs-5 text-right'>
						<div class='demo-gallery'>
				            <ul id='lightgallery' class='list-unstyled row'>
				 					<li class='col-lg-12 col-xs-12' data-responsive=/$key->imagename data-src=/$key->imagename data-sub-html='' style='margin-bottom: 5px' id=pix$key->id>
				                    <a href>
				                    <br><br>
				                        <img class='text-left img-responsive' src=/$key->imagename>
				                    </a>
				                	</li>
				            </ul>
				        </div>
						</div>
					  </div>
					  <br>";
	}
	$value3 = '';
	$value3	.=	"<div class='row'>
					<div class='col-lg-10 col-xs-10'>
						<p><strong>".$getcomment." Comment</strong></p>
						<hr>
					</div>
				</div>

				<div class='row'>
					<div class='col-lg-1 col-xs-3'>";
		if(!empty($getuser->photoupload->imagename)){
					 $value3 .=  $image = HTML::image($getuser->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$value3 .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}
			$value3	.=		"</div>
					<div class='col-lg-9 col-xs-8'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-12 col-xs-12'>
								<textarea class='form-control newscomm'  id=".$id." rows='2' placeholder='Post Comment'></textarea>
							</div>
						</div>
						<div class='row text-right'>
							<div class='col-lg-9 col-xs-6'>
				
							</div>
							<div class='col-lg-3 col-xs-6'>
								<button type='button' class='btn btn-sm btn-primary text-right form-control' id='sendcomm'>Send</button>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				<div class='col-lg-12 spincomm'></div>
				<br>
				<div class='addcomm'>";
				$getcomments = DB::table('imagecomment')->orderBy('id','DESC')->where('imageid', '=', $id)->get();
				if ($getcomment) {
					# code...
					foreach ($getcomments as $key) {
						# code...

						$getnumcomment = DB::table('replycommentimg')->where('commentId', '=', $key->id)->count();

						$getimgcommlike = DB::table('imagecommentlike')->where('commId', '=', $key->id)->count();

						$getcommdtl = DB::table('imagecommentlike')->where('commId', $key->id)->where('sender_id', Auth::user()->id)->first();
						$user = User::find($key->user_id);
						if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile($key->user_id);
						$getcommVal = User::find(($key->user_id));
		$value3 .= "<div class='row'>
					<div class='col-lg-1 col-xs-3'>";
					if(!empty($getcommVal->photoupload->imagename)){
					 $value3 .=  $image = HTML::image($getcommVal->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$value3 .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}
		$value3 .=	"</div>
					<div class='col-lg-10 col-xs-8'>
						<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$key->comment."<br>
						<small>";
						if ($getcommdtl) {
							# code...
		$value3 .= 		"<div id=comm".$key->id."><a href='#like' class='unlikecomm' id=".$key->id.">(".$getimgcommlike.") liked</a> - <a class='replycomm' id=".$key->id." href='#comm'>(".$getnumcomment.") Reply</a> - <span style='color: #999'>".$key->date."</span></div>";
						}else{
		$value3 .= 		"<div id=comm".$key->id."><a href='#like' class='likecomm' id=".$key->id.">(".$getimgcommlike.") like</a> - <a class='replycomm' id=".$key->id." href='#comm'>(".$getnumcomment.") Reply</a> - <span style='color: #999'>".$key->date."</span></div>";
					}
		$value3 .=		"</small></p>
					</div>
					<div class='col-lg-1 '>
					</div>
				</div>
				<div id=showreplycom".$key->id." style='display: none'></div>
				<hr>";
				}
				}
		$value3 .= "</div>";
		$getStatus = DB::table('status')->orderBy('id','DESC')->where('id','!=', $comId)->take(5)->get();
		$value2 = '';
		foreach ($getStatus as $key) {
			# code...
			$user = User::find($key->user_id);
						if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
$value2  .= "<div class='row'>
				<div class='col-lg-1 col-xs-3'>";
				$user = User::find($key->user_id);
		if(!empty($user->photoupload->imagename)){
					 $value2 .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$value2 .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}	
	$value2 .=	"</div>
				<div class='col-lg-7 col-xs-9'>
					<p>".$key->status."<br>
					 <a href=".$url.">".$name."</a></p>
				</div>
				<div class='col-lg-4'>
					
				</div>
			</div>
			<br>";
			}


			$getnotifyunseen = $this->getunseen();

			return View::make('layouts.imagecomment')->with(compact('value', 'getnotifyunseen', 'value2', 'value3', 'value4'));
			}else{
				$values = 'Nothing to Show';
				$getnotifyunseen = $this->getunseen();
				return View::make('layouts.imagecomment')->with(compact('values', 'getnotifyunseen'));
			}

}

public function comment($id)
{
	# code...
	$comId = $id;
	$getStatus = DB::table('status')->where('id',$comId)->get();

	$getuser = User::find(Auth::user()->id);
	$value = '';
	foreach ($getStatus as $key) {
		# code...
		$commid = $key->id;
		$getcomment = DB::table('statuscomment')->where('statusId', '=', $commid)->count();

		$geylikestatus = DB::table('statuslike')->where('statusId', '=', $key->id)->count();
		$userlikestaus = DB::table('statuslike')->where('statusId', '=', $key->id)->where('sender_id', '=', Auth::user()->id)->first();

		$user = User::find($key->user_id);
		if (empty($user->NewModel->displayName)) {
			# code...
			$name = $user->Others->agentName;
		}else{
			$name = $user->NewModel->displayName;
		}

		$url = $this->getProfile($key->user_id);
		$user_type_spec = $this->getUserType($key->user_id);

$value .=	"<div class='row' style='border: 1px solid #54d7e3;'>
		<div class='col-lg-12'>
			<div class='row'>
				<div class='col-lg-8 col-xs-8'>
					<p>".$key->status."</p>
					<br>
					<br>
				</div>
				<div class='col-lg-4 col-xs-4'>
					<div class='row'>
					<div class='col-lg-8 col-xs-5'>
					</div>
					<div class='col-lg-4 col-xs-7 text-center likeStatus likeshow".$key->id."' style='cursor: pointer' id=".$key->id.">";
					if ($userlikestaus) {
						# code...
	$value .= 			"<div class='row'>
								<span class='glyphicon glyphicon-heart' style='font-size: 250%; z-index: 1; color: #54d7e3;'>
								</span>
						</div>
						<div class='row' style='background-color: #000; color:#fff; font-weight: bold;'>
								".$geylikestatus."
						</div>";
					}else{
	$value .=			"<div class='row'>
								<span class='glyphicon glyphicon-heart' style='font-size: 250%; z-index: 1; color: pink;'>
								</span>
						</div>
						<div class='row' style='background-color: #000; color:#fff; font-weight: bold;'>
								".$geylikestatus."
						</div>";
						}
	$value .=	"</div>
				</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-lg-1 col-xs-1'>";
		if(!empty($user->photoupload->imagename)){
					 $value .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '33px'));
					        }
					        else{
					$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '33px'));
							}	
	$value .=	"</div>
				<div class='col-lg-7 col-xs-10'>
					<p>Posted by <a href=".$url.">".$name."</a> | ".$user_type_spec." |<br>
					".$key->date." | <a href=/users/comment/".$key->id.">(".$getcomment.") Comments</a> </p>
				</div>
				<div class='col-lg-4'>
					
				</div>
			</div>
		</div>
	</div>
	<br>";
	}
	$value3 = '';
	$value3	.=	"<div class='row'>
					<div class='col-lg-10'>
						<p><strong>".$getcomment." Comment</strong></p>
						<hr>
					</div>
				</div>

				<div class='row'>
					<div class='col-lg-1 col-xs-3'>";
		if(!empty($getuser->photoupload->imagename)){
					 $value3 .=  $image = HTML::image($getuser->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$value3 .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}
			$value3	.=		"</div>
					<div class='col-lg-9 col-xs-8'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-12 col-xs-12'>
								<textarea class='form-control newscomm'  id=".$id." rows='2' placeholder='Post Comment'></textarea>
							</div>
						</div>
						<div class='row text-right'>
							<div class='col-lg-9 col-xs-6'>
				
							</div>
							<div class='col-lg-3 col-xs-6'>
								<button type='button' class='btn btn-sm btn-primary text-right form-control' id='sendcomm'>Send</button>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				<div class='col-lg-12 spincomm'></div>
				<div class='addcomm'>";
				$getcomments = DB::table('statuscomment')->orderBy('id','DESC')->where('statusId', '=', $id)->get();
				if ($getcomment) {
					# code...
					foreach ($getcomments as $key) {
						# code...
						$getnumreply = DB::table('replycomment')->where('commentId', '=', $key->id)->count();
						$getcommdtl = DB::table('commentlike')->where('commId', $key->id)->where('sender_id', Auth::user()->id)->first();
						$getlike = DB::table('commentlike')->where('commId', $key->id)->count();

						$user = User::find($key->user_id);
						if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile($key->user_id);
						$getcommVal = User::find(($key->user_id));
		$value3 .= "<div class='row'>
					<div class='col-lg-1 col-xs-3'>";
					if(!empty($getcommVal->photoupload->imagename)){
					 $value3 .=  $image = HTML::image($getcommVal->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$value3 .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}
		$value3 .=	"</div>
					<div class='col-lg-10 col-xs-8'>
						<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$key->comment."<br>
						<small>";
						if ($getcommdtl) {
							# code...
		$value3 .= 		"<div id=comm".$key->id."><a href='#like' class='unlikecomm' id=".$key->id.">(".$getlike.") liked</a> - <a class='replycomm' id=".$key->id." href='#comm'>(".$getnumreply.") Reply</a> - <span style='color: #999'>".$key->date."</span></div>";
						}else{
		$value3 .= 		"<div id=comm".$key->id."><a href='#like' class='likecomm' id=".$key->id.">(".$getlike.") like</a> - <a class='replycomm' id=".$key->id." href='#comm'>(".$getnumreply.") Reply</a> - <span style='color: #999'>".$key->date."</span></div>";
					}
		$value3 .=		"</small></p>
					</div>
					<div class='col-lg-1'>
					</div>
				</div>
				<div id=showreplycom".$key->id." style='display: none'></div>
				<hr>";
				}
				}
		$value3 .= "</div>";
		$getStatus = DB::table('status')->orderBy('id','DESC')->where('id','!=', $comId)->take(5)->get();
		$value2 = '';
		foreach ($getStatus as $key) {
			# code...
			$user = User::find($key->user_id);
						if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
$value2  .= "<div class='row'>
				<div class='col-lg-1 col-xs-3'>";
				$user = User::find($key->user_id);
		if(!empty($user->photoupload->imagename)){
					 $value2 .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$value2 .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}	
	$value2 .=	"</div>
				<div class='col-lg-7 col-xs-9'>
					<p>".$key->status."<br>
					 <a href=".$url.">".$name."</a></p>
				</div>
				<div class='col-lg-4'>
					
				</div>
			</div>
			<br>";
			}

			$getnotifyunseen = $this->getunseen();

			return View::make('layouts.comment')->with(compact('value', 'getnotifyunseen', 'value2', 'value3'));

}

public function sendcommimg()
{
	# code...
	$user_id = Auth::user()->id;
	
	$notify = DB::table('notification')->where('name', '=', 'commentPhotos')->first();

	$newsmsg = $_GET['newsmsg'];
	$id = $_GET['id'];

	$getStatususer = DB::table('imagegallery')->where('id', '=', $id)->first();

	$addnews = new imagecomment;
	$addnews->imageid = $id;
	$addnews->user_id = $user_id;
	$addnews->comment = $newsmsg;
	$addnews->date = date('d-m-Y');
	$addnews->save();
	$statusId = $addnews->id;

	$addnewsId = $addnews->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifycommentimg;
	$addnotify->NotId = $ModelNotId;
	$addnotify->commId = $statusId;
	$addnotify->user_id = $getStatususer->user_id;
	$addnotify->sender_id = $user_id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$view = '';
		$user = User::find(Auth::user()->id);
						if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile(Auth::user()->id);
						$getcommVal = User::find((Auth::user()->id));
		$view .= "<div class='row'>
					<div class='col-lg-1'>";
					if(!empty($getcommVal->photoupload->imagename)){
					 $view .=  $image = HTML::image($getcommVal->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}
		$view .=	"</div>
					<div class='col-lg-9'>
						<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$newsmsg."<br>
						<small><div id=comm".$statusId."><a href='#like' class='likecomm' id=".$statusId.">like</a> - <a class='replycomm2' id=".$statusId." href='#comm'>Reply</a> - <span style='color: #999'>".date('d-m-Y')."</span></div></small></p>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				<div id=showreplycom".$statusId." style='display: none'></div>
				<hr>";

	echo $view;	

}

public function sendcomm()
{
	# code...
	$user_id = Auth::user()->id;
	
	$notify = DB::table('notification')->where('name', '=', 'commentStatus')->first();

	$newsmsg = $_GET['newsmsg'];
	$id = $_GET['id'];

	$getStatususer = DB::table('status')->where('id', '=', $id)->first();

	$addnews = new statuscomment;
	$addnews->statusId = $id;
	$addnews->user_id = $user_id;
	$addnews->comment = $newsmsg;
	$addnews->date = date('d-m-Y');
	$addnews->save();
	$statusId = $addnews->id;

	$addnewsId = $addnews->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifycomment;
	$addnotify->NotId = $ModelNotId;
	$addnotify->commId = $statusId;
	$addnotify->user_id = $getStatususer->user_id;
	$addnotify->sender_id = $user_id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$view = '';
		$user = User::find(Auth::user()->id);
						if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile(Auth::user()->id);
						$getcommVal = User::find((Auth::user()->id));
		$view .= "<div class='row'>
					<div class='col-lg-1'>";
					if(!empty($getcommVal->photoupload->imagename)){
					 $view .=  $image = HTML::image($getcommVal->photoupload->imagename ,'profile', array('width' => '50px', 'height' => '50px'));
					        }
					        else{
					$view .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '50px', 'height' => '50px'));
							}
		$view .=	"</div>
					<div class='col-lg-9'>
						<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$newsmsg."<br>
						<small><div id=comm".$statusId."><a href='#like' class='likecomm2' id=".$statusId.">like</a> - <a class='replycomm2' id=".$statusId." href='#comm'>Reply</a> - <span style='color: #999'>".date('d-m-Y')."</span></div></small></p>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				<div id=showreplycom".$statusId." style='display: none'></div>
				<hr>";

	echo $view;	

}

public function replycommentimg()
{
	# code...
	$commid = $_GET['commid'];
	$value = '';
	$getuser = User::find(Auth::user()->id);
				$getcomment = DB::table('replycommentimg')->where('commentId', '=', $commid)->get();
				foreach ($getcomment as $key) {
					# code...
					$getnumreplylike = DB::table('replylikeimg')->where('replyId', '=', $key->id)->count();

					$getcomments = DB::table('replylikeimg')->where('replyId', '=', $key->id)->where('sender_id', '=', Auth::user()->id)->get();
					$keydata = $key->id;
					$user = User::find($key->user_id);
					if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile($key->user_id);
	$value .= "<div class='row'>
					<div class='col-lg-3'>
					</div>
					<div class='col-lg-6 col-xs-12'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-1 col-xs-1'>";
					$getusers = User::find($key->user_id);
					if(!empty($getusers->photoupload->imagename)){
								 $value .=  $image = HTML::image($getusers->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '30px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '50px'));
										}
				$value	.=		"</div>
							<div class='col-lg-10 col-xs-10'>
								<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$key->commsg."<br>";
						if ($getcomments) {
							# code...
						
				$value	.= "<small><div class=showreplycomlike".$key->id."><a class='unlikereplycomm' id=".$key->id." href='#lyk'>(".$getnumreplylike.") unlike</a> - <span style='color: #999'>".$key->date."</span></div></small>";
					}else{
				$value	.= "<small><div class=showreplycomlike".$key->id."><a class='likereplycomm' id=".$key->id." href='#lyk'>(".$getnumreplylike.") like</a> - <span style='color: #999'>".$key->date."</span></div></small>";
					}

				$value	.="</p>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				";	
				}

				$value .= "<div class=replydata".$commid.">
				</div>
				<div class='col-lg-12 spinsndcomm$commid'>
				</div>
				<br>
					<div class='row'>
					<div class='col-lg-3'>
					</div>
					<div class='col-lg-6 col-xs-12'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-1 col-xs-1'>";
					if(!empty($getuser->photoupload->imagename)){
								 $value .=  $image = HTML::image($getuser->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '30px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '50px'));
										}
				$value	.=		"</div>
							<div class='col-lg-10 col-xs-10'>
								<textarea class='form-control newscomm' id=replytext".$commid." rows='2' placeholder='Reply Comment'></textarea>
							</div>
						</div>
						<div class='row text-right'>
							<div class='col-lg-8 col-xs-8'>
				
							</div>
							<div class='col-lg-3 col-xs-4'>
								<button type='button' class='btn btn-sm btn-primary text-right form-control sendcommreply' id=".$commid.">Send</button>
							</div>
							<div class='col-lg-1'>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>";

	echo $value;
}

public function replycomment()
{
	# code...
	$commid = $_GET['commid'];
	$value = '';
	$getuser = User::find(Auth::user()->id);
				$getcomment = DB::table('replycomment')->where('commentId', '=', $commid)->get();
				foreach ($getcomment as $key) {
					# code...
					$getlike = DB::table('replylike')->where('replyId', '=', $key->id)->count();
					$getcomments = DB::table('replylike')->where('replyId', '=', $key->id)->where('sender_id', '=', Auth::user()->id)->get();
					$keydata = $key->id;
					$user = User::find($key->user_id);
					if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile($key->user_id);
	$value .= "<div class='row'>
					<div class='col-lg-3'>
					</div>
					<div class='col-lg-6 col-xs-12'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-1 col-xs-1'>";
					$getusers = User::find($key->user_id);
					if(!empty($getusers->photoupload->imagename)){
								 $value .=  $image = HTML::image($getusers->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '30px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '50px'));
										}
				$value	.=		"</div>
							<div class='col-lg-10 col-xs-10'>
								<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$key->commsg."<br>";
						if ($getcomments) {
							# code...
						
				$value	.= "<small><div class=showreplycomlike".$key->id."><a class='unlikereplycomm' id=".$key->id." href='#lyk'>(".$getlike.") liked</a> - <span style='color: #999'>".$key->date."</span></div></small>";
					}else{
				$value	.= "<small><div class=showreplycomlike".$key->id."><a class='likereplycomm' id=".$key->id." href='#lyk'>(".$getlike.") like</a> - <span style='color: #999'>".$key->date."</span></div></small>";
					}

				$value	.="</p>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				";	
				}

				$value .= "<div class=replydata".$commid.">
				</div>
				<div class='col-lg-12 spinsndcomm$commid'>
				</div>
				<br>
					<div class='row'>
					<div class='col-lg-3'>
					</div>
					<div class='col-lg-6 col-xs-12'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-1 col-xs-1'>";
					if(!empty($getuser->photoupload->imagename)){
								 $value .=  $image = HTML::image($getuser->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '30px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '50px'));
										}
				$value	.=		"</div>
							<div class='col-lg-10 col-xs-10'>
								<textarea class='form-control newscomm' id=replytext".$commid." rows='2' placeholder='Reply Comment'></textarea>
							</div>
						</div>
						<div class='row text-right'>
							<div class='col-lg-8 col-xs-8'>
				
							</div>
							<div class='col-lg-3 col-xs-4'>
								<button type='button' class='btn btn-sm btn-primary text-right form-control sendcommreply' id=".$commid.">Send</button>
							</div>
							<div class='col-lg-1'>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>";

	echo $value;
}

public function sendReplyimg()
{
	# code...
$replytext = $_GET['replytext'];
$commid = $_GET['commid'];

	$notify = DB::table('notification')->where('name', '=', 'replycommentPhotos')->first();
	$getStatususer = DB::table('imagecomment')->where('id', '=', $commid)->first();


        $replycomment = new replycommentimg;
        $replycomment->commentId = $commid;
        $replycomment->commsg = $replytext;
        $replycomment->user_id = Auth::user()->id;
        $replycomment->date = date('d-m-Y');
        $replycomment->save();
        $replyid = $replycomment->id;

    $modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getStatususer->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifyreplycommentimg;
	$addnotify->NotId = $ModelNotId;
	$addnotify->replyId = $replyid;
	$addnotify->user_id = $getStatususer->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

		$value = '';

					# code...
					$user = User::find(Auth::user()->id);
					if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile(Auth::user()->id);
	$value .= "<div class='row'>
					<div class='col-lg-3 col-xs-3'>
					</div>
					<div class='col-lg-6 col-xs-6'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-1 col-xs-1'>";
								if(!empty($user->photoupload->imagename)){
								 $value .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '30px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '50px'));
										}
				$value	.=		"</div>
							<div class='col-lg-10 col-xs-10'>
								<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$replytext."<br>
						<small><div class=showreplycomlike".$replyid."><a class='likereplycomm' id=".$replyid." href='#like'>like</a> - <span style='color: #999'>".date('d-m-Y')."</span></div></small></p>
							</div>
						</div>
					</div>
					<div class='col-lg-2 col-xs-2'>
					</div>
				</div>
				<br>";	
	echo $value;			
}


public function sendReply()
{
	# code...
$replytext = $_GET['replytext'];
$commid = $_GET['commid'];

	$notify = DB::table('notification')->where('name', '=', 'replycomment')->first();
	$getStatususer = DB::table('statuscomment')->where('id', '=', $commid)->first();


        $replycomment = new replycomment;
        $replycomment->commentId = $commid;
        $replycomment->commsg = $replytext;
        $replycomment->user_id = Auth::user()->id;
        $replycomment->date = date('d-m-Y');
        $replycomment->save();
        $replyid = $replycomment->id;

    $modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getStatususer->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifyreplycomment;
	$addnotify->NotId = $ModelNotId;
	$addnotify->replyId = $replyid;
	$addnotify->user_id = $getStatususer->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

		$value = '';

					# code...
					$user = User::find(Auth::user()->id);
					if (empty($user->NewModel->displayName)) {
							# code...
							$name = $user->Others->agentName;
						}else{
							$name = $user->NewModel->displayName;
						}
						$url1 = $this->getProfile(Auth::user()->id);
	$value .= "<div class='row'>
					<div class='col-lg-3'>
					</div>
					<div class='col-lg-6 col-xs-12'>
						<div class='row' style='margin-bottom: 3px'>
							<div class='col-lg-1 col-xs-1'>";
					if(!empty($user->photoupload->imagename)){
								 $value .=  $image = HTML::image($user->photoupload->imagename ,'profile', array('width' => '25px', 'height' => '30px'));
								        }
								        else{
								$value .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '25px', 'height' => '50px'));
										}
				$value	.=		"</div>
							<div class='col-lg-10 col-xs-10'>
								<p><a href=".$url1."><strong>".$name."</strong></a><br>
						".$replytext."<br>
						<small><div class=showreplycomlike".$replyid."><a class='likereplycomm' id=".$replyid." href='#like'>like</a> - <span style='color: #999'>".date('d-m-Y')."</span></div></small></p>
							</div>
						</div>
					</div>
					<div class='col-lg-2'>
					</div>
				</div>
				<br>";	
	echo $value;			
}

public function likeimage()
{
	# code...
	
		$notify = DB::table('notification')->where('name', '=', 'likedPhotos')->first();
	$statusid = $_GET['statusid'];

	$getStatusdtl = DB::table('imagegallery')->where('id', '=', $statusid)->first();

	$getstatNum = DB::table('imagelike')->where('imageid', '=', $statusid)->where('sender_id', '=', Auth::user()->id)->get();

	if ($getstatNum) {
		# code...
		$getnumber = DB::table('imagelike')->where('imageid', '=', $statusid)->count();

	$value = '';
	$value .= 			"<div class='row'>
								<span class='glyphicon glyphicon-heart' style='font-size: 150%; z-index: 1; color: #54d7e3;'>
								</span>
						</div>
						<div class='row' style='background-color: #000; color:#fff; font-weight: bold;'>
								".$getnumber."
						</div>";

	}else{

	$addlikestat = new imagelike;
	$addlikestat->imageid = $statusid;
	$addlikestat->user_id = $getStatusdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getStatusdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifyimagelike;
	$addnotify->NotId = $ModelNotId;
	$addnotify->imageid = $statusid;
	$addnotify->user_id = $getStatusdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getnumber = DB::table('imagelike')->where('imageid', '=', $statusid)->count();

	$value = '';
	$value .= 			"<div class='row'>
								<span class='glyphicon glyphicon-heart' style='font-size: 150%; z-index: 1; color: #54d7e3;'>
								</span>
						</div>
						<div class='row' style='background-color: #000; color:#fff; font-weight: bold;'>
								".$getnumber."
						</div>";
}
	echo $value;
}

public function likeimages()
{
	# code...
	
		$notify = DB::table('notification')->where('name', '=', 'likedPhotos')->first();
	$statusid = $_GET['statusid'];

	$getStatusdtl = DB::table('imagegallery')->where('id', '=', $statusid)->first();

	$getstatNum = DB::table('imagelike')->where('imageid', '=', $statusid)->where('sender_id', '=', Auth::user()->id)->get();

	if ($getstatNum) {
		# code...
		$getnumber = DB::table('imagelike')->where('imageid', '=', $statusid)->count();

	$value = '';
	$value .= 			"<button class='btn btn-xs btn-primary'><i class='fa fa-check'></i>($getnumber) Liked</bottun>";

	}else{

	$addlikestat = new imagelike;
	$addlikestat->imageid = $statusid;
	$addlikestat->user_id = $getStatusdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getStatusdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifyimagelike;
	$addnotify->NotId = $ModelNotId;
	$addnotify->imageid = $statusid;
	$addnotify->user_id = $getStatusdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getnumber = DB::table('imagelike')->where('imageid', '=', $statusid)->count();

	$value = '';
	$value .= 			"<button class='btn btn-xs btn-primary'><i class='fa fa-check'></i>($getnumber) Liked</bottun>";
}

	echo $value;
}

public function unlikeimages()
{
	# code...
	
	$statusid = $_GET['statusid'];
	$value = '';

	$getstatNum = DB::table('imagelike')->where('imageid', '=', $statusid)->where('sender_id', '=', Auth::user()->id)->get();
		$getnumber = DB::table('imagelike')->where('imageid', '=', $statusid)->count();

	if ($getstatNum) {
		# code...
		$dellike = DB::table('imagelike')->where('imageid', '=', $statusid)->where('sender_id', '=', Auth::user()->id)->delete();
		$getnumber = DB::table('imagelike')->where('imageid', '=', $statusid)->count();

	$value = "<button id=$statusid class='btn btn-xs btn-primary likepix'><i class='fa fa-check'></i>($getnumber) Like image</bottun>";
	
	}else{

	$value = "<button id=$statusid class='btn btn-xs btn-primary likepix'><i class='fa fa-check'></i>($getnumber) Like image</bottun>";
}

	echo $value;
}

public function likeStatus()
{
	# code...
	
		$notify = DB::table('notification')->where('name', '=', 'likeStatus')->first();
	$statusid = $_GET['statusid'];

	$getStatusdtl = DB::table('status')->where('id', '=', $statusid)->first();

	$getstatNum = DB::table('statuslike')->where('statusId', '=', $statusid)->where('sender_id', '=', Auth::user()->id)->get();

	if ($getstatNum) {
		# code...
		$getnumber = DB::table('statuslike')->where('statusId', '=', $statusid)->count();

	$value = '';
	$value .= 			"<div class='row'>
							<div class='col-lg-12' style=' background-color: #ecdcbc;'>
								<span class='glyphicon glyphicon-heart' style='font-size: 40px; z-index: 1; color: #54d7e3;'>
								</span>
							</div>
						</div>
						<div class='row' style='background-color: #49371c;'>
							<div class='col-lg-12' style='color:#fff; font-weight: bold;'>
								".$getnumber."
							</div>
						</div>";

	}else{

	$addlikestat = new statuslike;
	$addlikestat->statusId = $statusid;
	$addlikestat->user_id = $getStatusdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getStatusdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifystatuslike;
	$addnotify->NotId = $ModelNotId;
	$addnotify->statusId = $addlikestatId;
	$addnotify->user_id = $getStatusdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getnumber = DB::table('statuslike')->where('statusId', '=', $statusid)->count();

	$value = '';
	$value .= 			"<div class='row'>
							<div class='col-lg-12' style=' background-color: #ecdcbc;'>
								<span class='glyphicon glyphicon-heart' style='font-size: 40px; z-index: 1; color: #54d7e3;'>
								</span>
							</div>
						</div>
						<div class='row' style='background-color: #49371c;'>
							<div class='col-lg-12' style='color:#fff; font-weight: bold;'>
								".$getnumber."
							</div>
						</div>";
}
	echo $value;
}

public function likecommimg()
{
	# code...
	$commid = $_GET['commid'];

		$notify = DB::table('notification')->where('name', '=', 'likePhotoscomment')->first();
	$getcommdtl = DB::table('imagecomment')->where('id', $commid)->first();

	$addlikestat = new imagecommentlike;
	$addlikestat->commId = $commid;
	$addlikestat->user_id = $getcommdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getcommdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifycommentlikeimg;
	$addnotify->NotId = $ModelNotId;
	$addnotify->commentId = $addlikestatId;
	$addnotify->user_id = $getcommdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getcount = DB::table('imagecommentlike')->where('commid', '=', $commid)->count();
	$getreply = DB::table('replycommentimg')->where('commentId', '=', $commid)->count();

	$value = "<small><a href='#like' class='unlikecomm' id=".$commid.">($getcount) liked</a> - <a class='replycomm2' id=".$commid." href='#comm'>($getreply) Reply</a> - <span style='color: #999'>".$getcommdtl->date."</span></small>";
	echo $value;
}

public function likecomm()
{
	# code...

	$commid = $_GET['commid'];

		$notify = DB::table('notification')->where('name', '=', 'likeComment')->first();
	$getcommdtl = DB::table('statuscomment')->where('id', $commid)->first();

	$addlikestat = new commentlike;
	$addlikestat->commId = $commid;
	$addlikestat->user_id = $getcommdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getcommdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifycommentlike;
	$addnotify->NotId = $ModelNotId;
	$addnotify->commentId = $addlikestatId;
	$addnotify->user_id = $getcommdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getcount = DB::table('commentlike')->where('commid', '=', $commid)->count();
	$getreply = DB::table('replycomment')->where('commentId', '=', $commid)->count();

	$value = "<small><a href='#like' class='unlikecomm' id=".$commid.">($getcount) liked</a> - <a class='replycomm2' href='#comm' id=".$commid.">($getreply)Reply</a> - <span style='color: #999'>".$getcommdtl->date."</span></small>";
	echo $value;

}

public function unlikecommimg()
{
	# code...

	$commid = $_GET['commid'];
	$getcommdtl = DB::table('imagecomment')->where('id', $commid)->first();

		$notify = DB::table('notification')->where('name', '=', 'likePhotoscomment')->first();
	$getcommdtl = DB::table('imagecommentlike')->where('commId', $commid)->where('sender_id', Auth::user()->id)->first();


	$getcomlike = DB::table('notifycommentlikeimg')->where('commentId', $getcommdtl->id)->where('sender_id', Auth::user()->id)->first();

	$delnotify = DB::table('modelnofity')->where('id', $getcomlike->NotId)->update(array('status'=> 'inactive'));

	$delcomlike = DB::table('imagecommentlike')->where('commId', $commid)->where('sender_id', Auth::user()->id)->delete();

		$getcount = DB::table('imagecommentlike')->where('commId', $commid)->count();
	$getreply = DB::table('replycommentimg')->where('commentId', $commid)->count();

	$value = "<small><a href='#like' class='likecomm' id=".$commid.">($getcount) like</a> - <a class='replycomm' id=".$commid." href='#comm'>($getreply) Reply</a> - <span style='color: #999'>".$getcommdtl->date."</span></small>";
	echo $value;
	
}

public function unlikecomm()
{
	# code...

	$commid = $_GET['commid'];
	$getcommdtl = DB::table('statuscomment')->where('id', $commid)->first();

		$notify = DB::table('notification')->where('name', '=', 'likeComment')->first();
	$getcommdtl = DB::table('commentlike')->where('commId', $commid)->where('sender_id', Auth::user()->id)->first();


	$getcomlike = DB::table('notifycommentlike')->where('commentId', $getcommdtl->id)->where('sender_id', Auth::user()->id)->first();

	$delnotify = DB::table('modelnofity')->where('id', $getcomlike->NotId)->update(array('status'=> 'inactive'));

	$delcomlike = DB::table('commentlike')->where('commId', $commid)->where('sender_id', Auth::user()->id)->delete();

	$getcount = DB::table('commentlike')->where('commId', $commid)->count();
	$getreply = DB::table('replycomment')->where('commentId', $commid)->count();

	$value = "<small><a href='#like' class='likecomm2' id=".$commid.">($getcount) like</a> - <a class='replycomm' id=".$commid." href='#comm'>($getreply) Reply</a> - <span style='color: #999'>".$getcommdtl->date."</span></small>";
	echo $value;
	
}

public function likereplycommimg()
{
	# code...

	$commid = $_GET['commid'];

		$notify = DB::table('notification')->where('name', '=', 'likereplyPhotos')->first();
	$getcommdtl = DB::table('replycommentimg')->where('id', $commid)->first();

	$addlikestat = new replylikeimg;
	$addlikestat->replyId = $commid;
	$addlikestat->user_id = $getcommdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getcommdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifyreplylikeimg;
	$addnotify->NotId = $ModelNotId;
	$addnotify->replyId = $addlikestatId;
	$addnotify->user_id = $getcommdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getcount = DB::table('replylikeimg')->where('replyId', '=', $commid)->count();

	$value = "<small><a class='unlikereplycomm' id=".$commid." href='#lyk'>($getcount) liked</a> - <span style='color: #999'>".date('d-m-Y')."</span></small>";
	echo $value;

}

public function likereplycomm()
{
	# code...

	$commid = $_GET['commid'];

		$notify = DB::table('notification')->where('name', '=', 'likereply')->first();
	$getcommdtl = DB::table('replycomment')->where('id', $commid)->first();

	$addlikestat = new replylike;
	$addlikestat->replyId = $commid;
	$addlikestat->user_id = $getcommdtl->user_id;
	$addlikestat->sender_id = Auth::user()->id;
	$addlikestat->date = date('d-m-Y');
	$addlikestat->save();
	$addlikestatId = $addlikestat->id;

	$modeldata = new ModelNotify;
	$modeldata->NotId = $notify->id;
	$modeldata->user = $getcommdtl->user_id;
	$modeldata->status = 'active';
	$modeldata->date = date('d-m-Y');
	$modeldata->save();
	$ModelNotId = $modeldata->id;

	$addnotify = new notifyreplylike;
	$addnotify->NotId = $ModelNotId;
	$addnotify->replyId = $addlikestatId;
	$addnotify->user_id = $getcommdtl->user_id;
	$addnotify->sender_id = Auth::user()->id;
	$addnotify->date = date('d-m-Y');
	$addnotify->save();

	$getcount = DB::table('replylike')->where('replyId', '=', $commid)->count();

	$value = "<small><a class='unlikereplycomm' id=".$commid." href='#lyk'>($getcount) liked</a> - <span style='color: #999'>".date('d-m-Y')."</span></small>";
	echo $value;

}

public function unlikereplycommimg()
{
	# code...

	$commid = $_GET['commid'];
	$getcommdtl = DB::table('replycommentimg')->where('id', $commid)->first();

		$notify = DB::table('notification')->where('name', '=', 'likereplyPhotos')->first();
	$getcommdtl = DB::table('replylikeimg')->where('replyId', $commid)->where('sender_id', Auth::user()->id)->first();


	$getcomlike = DB::table('notifyreplylikeimg')->where('replyId', $getcommdtl->id)->where('sender_id', Auth::user()->id)->first();

	$delnotify = DB::table('modelnofity')->where('id', $getcomlike->NotId)->update(array('status'=> 'inactive'));

	$delcomlike = DB::table('replylikeimg')->where('replyId', $commid)->where('sender_id', Auth::user()->id)->delete();
	$getcount = DB::table('replylikeimg')->where('replyId', $commid)->count();

	$value = "<small><a class='likereplycomm' id=".$commid." href='#lyk'>($getcount) like</a> - <span style='color: #999'>".date('d-m-Y')."</span></small>";
	echo $value;
	
}

public function unlikereplycomm()
{
	# code...

	$commid = $_GET['commid'];
	$getcommdtl = DB::table('replycomment')->where('id', $commid)->first();

		$notify = DB::table('notification')->where('name', '=', 'likereply')->first();
	$getcommdtl = DB::table('replylike')->where('replyId', $commid)->where('sender_id', Auth::user()->id)->first();


	$getcomlike = DB::table('notifyreplylike')->where('replyId', $getcommdtl->id)->where('sender_id', Auth::user()->id)->first();

	$delnotify = DB::table('modelnofity')->where('id', $getcomlike->NotId)->update(array('status'=> 'inactive'));

	$delcomlike = DB::table('replylike')->where('replyId', $commid)->where('sender_id', Auth::user()->id)->delete();

	$getcount = DB::table('replylike')->where('replyId', $commid)->count();

	$value = "<small><a class='likereplycomm' id=".$commid." href='#lyk'>($getcount) like</a> - <span style='color: #999'>".date('d-m-Y')."</span></small>";
	echo $value;
	
}
public function favorite()
{
	# code...
	$user_id = Auth::user()->id;
	$user = User::find(Auth::user()->id);
	$getfollower = DB::table('castfollowers')->where('follower', '=', $user_id)->get();
	$views = '';
	if ($getfollower) {
		# code...
		$views = '';
		$views = "<div class='row'><br>";
		foreach ($getfollower as $key) {
			# code...
			$key->following;
			$users = User::find($key->following);
					if (empty($users->NewModel->displayName)) {
							# code...
							
						}else{
							$name = $users->NewModel->displayName;
							$views .="<div class='col-lg-3 col-xs-12 col-sm-3 thumbnail' style='height: 200px; margin-right: 10px' id=acpt".$key->following.">
							<div class='row'>
							<div class='col-lg-5 col-sm-12 col-xs-5 text-right'>";
								if(!empty($users->photoupload->imagename)){
											 $views .=  $image = HTML::image($users->photoupload->imagename ,'profile', array('class' => 'img img-responsive', 'width' => '80px', 'height' => '80px'));
											        }
								        else{
											$views .= $image = HTML::image('img/photo.jpg', 'profile picture', array('class' => 'img img-responsive', 'width' => '50px', 'height' => '80px'));
										}
					$views	.=	"</div>
						<div class='col-lg-7 col-sm-12 col-xs-5 text-left'>
					<a href=/models/profile/".$key->following." ><strong>".str_limit($users->NewModel->displayName, $limit = 10, $end = '...')."</strong></a>
					<button class='btn btn-primary btn-xs bookmodel' data-toggle='modal' data-target='#exampleModal2' id=".$key->following.">
								Book model
							</button>
					<button class='btn btn-primary btn-xs exist' data-toggle='modal' data-target='#exampleModal' id=$key->following>
							link existing cast
						</button>
					<button class='btn btn-success btn-xs glyphicon glyphicon-ok followings' id=".$key->following."> following</button>
						</div>
						</div>	
						 </div>
						 ";
						}
		}
		$views .= "</div><br>";
	}
	$getnotifyunseen = $this->getunseen();

	return View::make('others.favorite')->with(compact('user', 'getnotifyunseen', 'views'));
}

public function photosession()
{
$view = '';
	$getphotosession = DB::table('photosession')->where('status', '=', 'active')->orderBy('id', 'DESC')->get();
	$countphoto = DB::table('photosession')->where('status', '=', 'active')->count();
	$num = $countphoto/6;
	$val = ceil($num);
	$view .= "<ul class='paginate' style='list-style-type:none'>";
	foreach($getphotosession as $photosession){
		$users = User::find($photosession->user_id);
	
	$gettype = DB::table('otherprofessional')->where('id', '=', $photosession->service)->first();	

     $view .= "<li>
     			<div class='row'>
                <div class='col-lg-12'>
                    <div class='row casting-bg'>
                        <div class='col-lg-4'>";
                        	if(!empty($photosession->image)){
		    		$view .=			HTML::image($photosession->image ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}		    				
              $view .= "</div>
                        <div class='col-lg-5 photo-bg' style='padding-top: 20px; padding-left: 20px;'>
                            <a href=''><h5>".$photosession->title."</h5></a>
                            <h5>Type:<span class='photo-div'>".$gettype->name."</span></h5>
                            <h5>Posted by: <a href=/others/showprofile/".$users->Others->user_id.">".$users->Others->agentName."</a></h5>
                            <h5>Location: <span class='photo-div'>".$photosession->location."</span></h5>
                        </div>
                        <div class='col-lg-3'>
                        <br>
                            <h3 style='color: #333'><img src='/img/nigeria-naira-currency-symbol.png' class='img-responsive' style='width: 11%; float: left;'> ".number_format($photosession->price)."</h3>
                            <a href=photosession/course/".$photosession->id." class='btn btn-default btn-xs' style='background-color: #54d7e3; color: #fff;'>MORE DETAILS</a>
                        </div>
                    </div>
                </div>
                </div><br><br>
                <li>";
               }
    	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";

               if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}



	return View::make('layouts.photosession')->with(compact('getphotosession', 'getnotifyunseen', 'view'));
}

public function courses()
{
$view = '';
	$getphotosession = DB::table('courses')->orderBy('id', 'DESC')->where('status', '=', 'active')->get();
	$countphoto = DB::table('courses')->where('status', '=', 'active')->count();
	$num = $countphoto/6;
	$val = ceil($num);
	$view .= "<ul class='paginate' style='list-style-type:none'>";
	foreach($getphotosession as $photosession){
		$users = User::find($photosession->user_id);

		$gettype = DB::table('otherprofessional')->where('id', '=', $photosession->service)->first();
		
     $view .= "<li>
     			<div class='row'>
                <div class='col-lg-12'>
                    <div class='row casting-bg'>
                        <div class='col-lg-4'>";
                        	if(!empty($photosession->image)){
		    		$view .=			HTML::image($photosession->image ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px'));
		    				}		    				
              $view .= "</div>
                        <div class='col-lg-5 photo-bg' style='padding-top: 20px; padding-left: 20px;'>
                            <a href=/others/showprofile/$photosession->user_id><h5>".$photosession->title."<h5></a>
                            <h5>Type:<span class='photo-div'>".$gettype->name."</span></h5>
                            <h5>Posted by: <a href=''>".$users->Others->agentName."</a></h5>
                            <h5>Location: <span class='photo-div'>".$photosession->location."</span></h5>
                        </div>
                        <div class='col-lg-3'>
                        <br>
                            <h3 style='color: #333'><img src='/img/nigeria-naira-currency-symbol.png' class='img-responsive' style='width: 11%; float: left;'>".number_format($photosession->price)."</h3>
                            <a href=courses/details/".$photosession->id." class='btn btn-default btn-xs' style='background-color: #54d7e3; color: #fff;'>MORE DETAILS</a>
                        </div>
                    </div>
                </div>
                </div><br><br>
                </li>";
               }
        $view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";

     if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.coursespage')->with(compact('getphotosession', 'getnotifyunseen', 'view'));
}

public function services()
{
	
$view = '';
	$getphotosession = DB::table('servicemarketplace')->orderBy('id', 'DESC')->where('status', '=', 'active')->get();
	$countphoto = DB::table('servicemarketplace')->where('status', '=', 'active')->count();
	$num = $countphoto/6;
	$val = ceil($num);
	$view .= "<ul class='paginate' style='list-style-type:none'>";
	foreach($getphotosession as $photosession){
		$users = User::find($photosession->user_id);
		$gettype = DB::table('otherprofessional')->where('id', '=', $photosession->service)->first();
		
     $view .= "<li>
     			<div class='row'>
                <div class='col-lg-12'>
                    <div class='row casting-bg'>
                        <div class='col-lg-4'>";
                        	if(!empty($photosession->image)){
		    		$view .=			HTML::image($photosession->image ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}		    				
              $view .= "</div>
                        <div class='col-lg-5 photo-bg' style='padding-top: 20px; padding-left: 20px;'>
                            <a href='/others/showprofile/$photosession->user_id'><h5>".$photosession->name."</h5></a>
                            <h5>Type:<span class='photo-div'>".$gettype->name."</span></h5>
                            <h5>Posted by: <a href=''>".$users->Others->agentName."</a></h5>
                            <h5>Location: <span class='photo-div'>".$photosession->location."</span></h5>
                        </div>
                        <div class='col-lg-3'>
                        <br>
                            <h3 style='color: #333'><img src='/img/nigeria-naira-currency-symbol.png' class='img-responsive' style='width: 11%; float: left;'>".number_format($photosession->price)."</h3>
                            <a href=services/details/".$photosession->id." class='btn btn-default btn-xs' style='background-color: #54d7e3; color: #fff;'>MORE DETAILS</a>
                        </div>
                    </div>
                </div>
                </div><br><br>
                </li>";
               }
       $view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";

               if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.services')->with(compact('getphotosession', 'view', 'getnotifyunseen'));
}

public function photocourse($id)
{
	$getphotocourse = DB::table('photosession')->where('id', '=', $id)->first();
	$getuserName = DB::table('others')->where('user_id', $getphotocourse->user_id)->first();

	$id = $id;

if (isset(Auth::user()->id)) {
	# code...
$getnotifyunseen = $this->getunseen();

}else{

$getnotifyunseen = '';

}

	return View::make('layouts.photocourse')->with(compact('getphotocourse', 'getuserName', 'id', 'getnotifyunseen'));
}

public function servicedetails($id)
{
	$getphotocourse = DB::table('servicemarketplace')->where('id', '=', $id)->first();
	$getuserName = DB::table('others')->where('user_id', $getphotocourse->user_id)->first();

if (isset(Auth::user()->id)) {
	# code...
$getnotifyunseen = $this->getunseen();

}else{

$getnotifyunseen = '';

}

	return View::make('layouts.servicedetails')->with(compact('getphotocourse', 'getnotifyunseen', 'getuserName'));
}
public function coursesdetails($id)
{
	$getphotocourse = DB::table('courses')->where('id', '=', $id)->first();
	$getuserName = DB::table('others')->where('user_id', $getphotocourse->user_id)->first();

if (isset(Auth::user()->id)) {
	# code...
$getnotifyunseen = $this->getunseen();

}else{

$getnotifyunseen = '';

}

	return View::make('layouts.coursesdetails')->with(compact('getphotocourse', 'getnotifyunseen', 'getuserName'));
}

public function photocoursebook($id)
{
	$id = $id;
	$photocoursebook = new bookphotosession;
	$photocoursebook->photoid = $id;
	$photocoursebook->user_id = Auth::user()->id;
	$photocoursebook->save();
	return Redirect::back();
}

public function coursebook($id)
{
	$id = $id;
	$photocoursebook = new bookcourse;
	$photocoursebook->coursesid = $id;
	$photocoursebook->user_id = Auth::user()->id;
	$photocoursebook->save();
	return Redirect::back();
}

public function servicebook($id)
{
	$id = $id;
	$photocoursebook = new bookservice;
	$photocoursebook->serviceid = $id;
	$photocoursebook->user_id = Auth::user()->id;
	$photocoursebook->save();
	return Redirect::back();
}

public function applycast()
{
	sleep(2);
	$id = $_GET['val'];
	$cast = $id;
	$month = date('m');
	$year = date('Y');
	$addcast = '';
	$casttable = new casttable;
	$casttable->cast_id = $cast;
	$casttable->user_id = Auth::user()->id;
	$casttable->castRequest = 'request';
	$casttable->save();

	$castApplication = new castApplication;
	$castApplication->user_id = Auth::user()->id;
	$castApplication->cast_id = $cast;
	$castApplication->month = $month;
	$castApplication->year = $year;
	$castApplication->save();

	echo "<p class='bg-success' style='padding: 10px'>Model Applied successfully</p>";

}

public function applycast2()
{
	sleep(2);
	$id = $_GET['val'];
	$cast = $id;
	$addcast = '';
	$getcast = DB::table('casttable')->where('cast_id', '=', $cast)->where('user_id', '=', Auth::user()->id)->update(array('castStatus' => 'confirmed'));
	echo "<p class='bg-primary' style='padding: 10px'>Application successful</p>";

}

public function sendsms()
{
	$getuser = User::find(Auth::user()->id);
	if ($getuser->user_type == 'proModel' || $getuser->user_type == 'newFace') {
		$getnum = DB::table('models')->where('user_id', '=', Auth::user()->id)->first();
		$num = $getnum->phone;
	}else{
		$getnum = DB::table('others')->where('user_id', '=', Auth::user()->id)->first();
		$num = $getnum->telephone;
	}

	$getrandom = DB::table('randomnumbergenertor')->first();
	$number = $getrandom->number;
	$msg = "This is your verification code $getrandom->number from Afrodaisy";

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

}

public function agency()
{
	$getagency = DB::table('users')->where('users.user_type', '=', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
	$getcountry = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.country')->get();
	$countagency = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->count();
	$view = '';
	$num = $countagency/5;
	$val = ceil($num);

	$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: '10',
		    limitPagination: $val
			})
			</script>";

			if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.agency')->with(compact('getnotifyunseen', 'view', 'getcountry'));


}

public function selcountry()
{
	$val = $_GET['val'];
	$type = $_GET['type'];
	if ($type == 'agency') {
	$getcountry =  DB::table('users')->where('users.user_type', '=', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $val)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.location')->get();
	$view = '';

	foreach ($getcountry as $key) {
		$view .= "<option value=$key->location>$key->location</option>";
	}	
	}elseif ($type == 'photographer') {
	$getcountry =  DB::table('users')->where('users.user_type', '=', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $val)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.location')->get();
	$view = '';

	foreach ($getcountry as $key) {
		$view .= "<option value=$key->location>$key->location</option>";
	}
	}elseif ($type == 'fashion') {
	$getcountry =  DB::table('users')->where('users.user_type', '=', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $val)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.location')->get();
	$view = '';

	foreach ($getcountry as $key) {
		$view .= "<option value=$key->location>$key->location</option>";
	}	
	}elseif ($type == 'others') {
	$getcountry =  DB::table('users')->where('users.user_type', '=', 'others')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $val)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.location')->get();
	$view = '';

	foreach ($getcountry as $key) {
		$view .= "<option value=$key->location>$key->location</option>";
	}	
	}elseif ($type == 'artist') {
	$getcountry =  DB::table('users')->where('users.user_type', '=', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $val)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.location')->get();
	$view = '';

	foreach ($getcountry as $key) {
		$view .= "<option value=$key->location>$key->location</option>";
	}	
	}
	
	echo $view;
}

public function searchresult()
{
	sleep(3);
	$selcountry = $_GET['selcountry'];
	$selcity = $_GET['selcity'];
	$view = '';

	if (empty($selcity) && empty($selcountry)) {
		$view = "Oopps no result found";
	}elseif (!empty($selcountry) && empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
$getcount = DB::table('users')->where('users.user_type', '=', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}elseif (!empty($selcountry) && !empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('users')->where('users.user_type', '=', 'agent')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}
	echo $view;
}

public function photographers()
{
	$getagency = DB::table('users')->where('users.user_type', '=', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
	$getcountry = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.country')->get();
	$countagency = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->count();
	$view = '';
	$num = $countagency/5;
	$val = ceil($num);

	$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: '10',
		    limitPagination: $val
			})
			</script>";

			if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.photographers')->with(compact('getnotifyunseen', 'view', 'getcountry'));
}

public function searchphoto()
{
	sleep(3);
	$selcountry = $_GET['selcountry'];
	$selcity = $_GET['selcity'];
	$view = '';

	if (empty($selcity) && empty($selcountry)) {
		$view = "Oopps no agency";
	}elseif (!empty($selcountry) && empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
$getcount = DB::table('users')->where('users.user_type', '=', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}elseif (!empty($selcountry) && !empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('users')->where('users.user_type', '=', 'photo')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}
	echo $view;
}

public function fashion()
{
	$getagency = DB::table('users')->where('users.user_type', '=', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
	$getcountry = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.country')->get();
	$countagency = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->count();
	$view = '';
	$num = $countagency/5;
	$val = ceil($num);

	$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: '10',
		    limitPagination: $val
			})
			</script>";

			if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.fashion')->with(compact('getnotifyunseen', 'view', 'getcountry'));
}

public function searchfashion()
{
	sleep(3);
	$selcountry = $_GET['selcountry'];
	$selcity = $_GET['selcity'];
	$view = '';

	if (empty($selcity) && empty($selcountry)) {
		$view = "Oopps no result found";
	}elseif (!empty($selcountry) && empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
$getcount = DB::table('users')->where('users.user_type', '=', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}elseif (!empty($selcountry) && !empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('users')->where('users.user_type', '=', 'fashion')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}
	echo $view;
}

public function artist()
{
	$getagency = DB::table('users')->where('users.user_type', '=', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
	$getcountry = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.country')->get();
	$countagency = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->count();
	$view = '';
	$num = $countagency/5;
	$val = ceil($num);

	$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: '10',
		    limitPagination: $val
			})
			</script>";

			if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.artist')->with(compact('getnotifyunseen', 'view', 'getcountry'));
}

public function searchartist()
{
	sleep(3);
	$selcountry = $_GET['selcountry'];
	$selcity = $_GET['selcity'];
	$view = '';

	if (empty($selcity) && empty($selcountry)) {
		$view = "Oopps no result found";
	}elseif (!empty($selcountry) && empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
$getcount = DB::table('users')->where('users.user_type', '=', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}elseif (!empty($selcountry) && !empty($selcity)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('users')->where('users.user_type', '=', 'artist')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}
	echo $view;
}

public function unfollow()
{
	$following = $_GET['val'];
	$del = DB::table('castfollowers')->where('follower', '=', Auth::user()->id)->where('following', '=', $following)->delete();
}

public function others()
{
	$view = '';
	$getcountry = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->groupBy('others.country')->get();

	$getothers = DB::table('users')->where('users.user_type', '=', 'others')->Join('others', 'users.id', '=', 'others.user_id')->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();

	$getindustry = DB::table('industryprofessional')->get();

	$countagency = DB::table('others')->Join('verificationtable', 'others.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->count();
	$num = $countagency/5;
	$val = ceil($num);

	$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getothers as $key){
	$user = User::find($key->user_id);
	$getprofession = DB::table('industryprofessionalusers')->where('user_id', '=', $key->user_id)->Join('industryprofessional', 'industryprofessionalusers.industry_id', '=', 'industryprofessional.id')->first();
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4>Profession: $getprofession->name</h4>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: '10',
		    limitPagination: $val
			})
			</script>";

	if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}

	return View::make('layouts.others')->with(compact('getnotifyunseen', 'view', 'getcountry', 'getindustry'));
}

public function searchothers()
{
	$selcountry = $_GET['selcountry'];
    $selcity = $_GET['selcity'];
    $selothers = $_GET['selothers'];
    $view = '';

    if (empty($selcity) && empty($selcountry) && empty($selothers)) {
		$view = "<h4>Oopps no other Professionals</h4>";
	}elseif (!empty($selcountry) && empty($selcity) && empty($selothers)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'others')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
$getcount = DB::table('users')->where('users.user_type', '=', 'others')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
	$getprofession = DB::table('industryprofessionalusers')->where('user_id', '=', $key->user_id)->Join('industryprofessional', 'industryprofessionalusers.industry_id', '=', 'industryprofessional.id')->first();
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4>Profession: $getprofession->name</h4>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}elseif (!empty($selcountry) && !empty($selcity) && empty($selothers)) {
		$getagency = DB::table('users')->where('users.user_type', '=', 'others')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('users')->where('users.user_type', '=', 'others')->Join('others', 'users.id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'users.id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
$getprofession = DB::table('industryprofessionalusers')->where('user_id', '=', $key->user_id)->Join('industryprofessional', 'industryprofessionalusers.industry_id', '=', 'industryprofessional.id')->first();
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4>Profession: $getprofession->name</h4>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}elseif (!empty($selcountry) && empty($selcity) && !empty($selothers)) {
		$getagency = DB::table('industryprofessionalusers')->where('industry_id', '=', $selothers)->Join('others', 'industryprofessionalusers.user_id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'industryprofessionalusers.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('industryprofessionalusers')->where('industry_id', '=', $selothers)->Join('others', 'industryprofessionalusers.user_id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->Join('verificationtable', 'industryprofessionalusers.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getagency as $key){
	$user = User::find($key->user_id);
$getprofession = DB::table('industryprofessionalusers')->where('user_id', '=', $key->user_id)->Join('industryprofessional', 'industryprofessionalusers.industry_id', '=', 'industryprofessional.id')->first();
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4>Profession: $getprofession->name</h4>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}
	elseif (!empty($selcountry) && !empty($selcity) && !empty($selothers)) {
		$getuser = DB::table('industryprofessionalusers')->where('industry_id', '=', $selothers)->Join('others', 'industryprofessionalusers.user_id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'industryprofessionalusers.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->get();
		$getcount = DB::table('industryprofessionalusers')->where('industry_id', '=', $selothers)->Join('others', 'industryprofessionalusers.user_id', '=', 'others.user_id')->where('others.country', '=', $selcountry)->where('others.location', '=', $selcity)->Join('verificationtable', 'industryprofessionalusers.user_id', '=', 'verificationtable.user_id')->where('verificationtable.verify', '=', 'yes')->orderBy('others.id', 'DESC')->count();
		$num = $getcount/6;
	$val = ceil($num);

		$view .= "<ul class='paginate' style='list-style-type:none'>";
				foreach($getuser as $key){
	$user = User::find($key->user_id);
$getprofession = DB::table('industryprofessionalusers')->where('user_id', '=', $key->user_id)->Join('industryprofessional', 'industryprofessionalusers.industry_id', '=', 'industryprofessional.id')->first();
	$view .=	"<li>
					<div class='row' style='border: 1px solid #000'>
						<div class='col-lg-3 col-sm-4'>";
				if(!empty($user->photoupload->imagename)){
		    		$view .=			HTML::image($user->photoupload->imagename ,'profile', array('width' => '200px', 'Height' => '200px', 'class' => 'img-responsive'));
                        	}
		    				else{
		    		$view .=			HTML::image('img/photo.jpg', 'profile picture', array('width' => '217px', 'Height' => '118px', 'class' => 'img-responsive'));
		    				}	
	$view .=		"</div>
						<div class='col-lg-6 col-sm-5'>
						<a href='/others/showprofile/$key->user_id' style='color: #54d7e3'><h4>".$key->agentName."</h4></a>
						<h4>Profession: $getprofession->name</h4>
						<h4><span class='glyphicon glyphicon-map-marker' style='color: orange;'></span> $key->country, $key->location</h4>
						</div>
						<div class='col-lg-3 col-sm-2'>
						<br>
						<br>
						<br>
							<a href=/others/showprofile/$key->user_id class='btn btn-xs' style='background-color: #54d7e3; font-size: 14px; color: #fff;'>MORE DETAILS</a>
						</div>
					</div>
				</li><br><br>";
			}
	$view .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 6,
		    limitPagination: $val
			})
			</script>";
	}
	echo $view;

}

public function about()
{
	$industryprofessional = DB::table('industryprofessional')->get();

		if (isset(Auth::user()->id)) {
				# code...
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}


	return View::make('layouts.about')->with(compact('industryprofessional','getnotifyunseen'));


}

public function paywebhook()
{
	$data = 0;
	if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER) ) 
    exit();

// Retrieve the request's body
$input = @file_get_contents("php://input");
define('PAYSTACK_SECRET_KEY','sk_test_40e1c7665852c9ba5f6f95db7f205e40480de86f');

// validate event do all at once to avoid timing attack
if($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))
  exit();

http_response_code(200);

// parse event (which is json string) as object
// Do something - that will not take long - with $event
$event = json_decode($input, true);

$data = $event['data']['reference'];

$getdata = $this->checkdata($data);

exit();
}

public function checkdata($value)
{
	$checkphotosession = DB::table('onlinepayoutphotosession')->where('ref_id', '=', $value)->get();
	$checkcourses = DB::table('onlinepayoutcourses')->where('ref_id', '=', $value)->count();
	$checkservices = DB::table('onlinepayoutservices')->where('ref_id', '=', $value)->count();
	$checksub = DB::table('onlinepayoutsub')->where('ref_id', '=', $value)->count();
	$checkcast = DB::table('onlinepayoutcast')->where('ref_id', '=', $value)->count();
	$checkjob = DB::table('onlinepayoutjob')->where('refid', '=', $value)->count();

	if ($checkphotosession) {
	$offlinepayoutphotosession = DB::table('onlinepayoutphotosession')->where('ref_id', '=', $value)->update(array('status' => 'yes'));

	$getphoto = DB::table('onlinepayoutphotosession')->where('ref_id', '=', $value)->first();

	$photocoursebook = new bookphotosession;
	$photocoursebook->photoid = $getphoto->photosession_id;
	$photocoursebook->user_id = $getphoto->user_id;
	$photocoursebook->amount = $getphoto->amount;
	$photocoursebook->save();

	$users = User::find($key->user_id);

	if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
	$getphotosession = DB::table('photosession')->where('id', '=', $getphoto->photosession_id)->first();
	$getmail = User::find($key->user_id);

	Mail::send('emails.activeservice', array('user' => $name, 'castTitle' => $getphotosession->title), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

	$email = User::find($getphotosession->user_id);
	$users2 = User::find($getphotosession->user_id);

	if (empty($users2->NewModel->displayName)) {
				# code...
				$name2 = $users2->Others->agentName;
			}else{
				$name2 = $users2->NewModel->displayName;
			}

	Mail::send('emails.activeservice', array('user' => $name2, 'castTitle' => $getphotosession->name), function($message) use ($email)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($email->email)->subject('Welcome!');
		    
		});

	}elseif ($checkcourses > 0) {
			$offlinepayoutphotosession = DB::table('onlinepayoutcourses')->where('ref_id', '=', $value)->update(array('status' => 'yes'));

	$getphoto = DB::table('onlinepayoutcourses')->where('ref_id', '=', $value)->first();

	$photocoursebook = new bookcourse;
	$photocoursebook->coursesid = $getphoto->course_id;
	$photocoursebook->user_id = $getphoto->user_id;
	$photocoursebook->amount = $getphoto->amount;
	$photocoursebook->save();

	$users = User::find($key->user_id);

	if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
	$getphotosession = DB::table('courses')->where('id', '=', $getphoto->course_id)->first();
	$getmail = User::find($key->user_id);

	Mail::send('emails.activeservice', array('user' => $name, 'castTitle' => $getphotosession->title), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

	$email = User::find($getphotosession->user_id);
	$users2 = User::find($getphotosession->user_id);

	if (empty($users2->NewModel->displayName)) {
				# code...
				$name2 = $users2->Others->agentName;
			}else{
				$name2 = $users2->NewModel->displayName;
			}

	Mail::send('emails.activeservice', array('user' => $name2, 'castTitle' => $getphotosession->name), function($message) use ($email)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($email->email)->subject('Welcome!');
		    
		});

	}elseif ($checkservices > 0) {
			$offlinepayoutphotosession = DB::table('onlinepayoutservices')->where('ref_id', '=', $value)->update(array('status' => 'yes'));

	$getphoto = DB::table('onlinepayoutservices')->where('ref_id', '=', $value)->first();

	$photocoursebook = new bookservice;
	$photocoursebook->serviceid = $getphoto->service_id;
	$photocoursebook->user_id = $getphoto->user_id;
	$photocoursebook->amount = $getphoto->amount;
	$photocoursebook->save();

	$users = User::find($key->user_id);

	if (empty($users->NewModel->displayName)) {
				# code...
				$name = $users->Others->agentName;
			}else{
				$name = $users->NewModel->displayName;
			}
	$getphotosession = DB::table('servicemarketplace')->where('id', '=', $getphoto->course_id)->first();
	$getmail = User::find($key->user_id);

	Mail::send('emails.activeservice', array('user' => $name, 'castTitle' => $getphotosession->name), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

	$email = User::find($getphotosession->user_id);
	$users2 = User::find($getphotosession->user_id);

	if (empty($users2->NewModel->displayName)) {
				# code...
				$name2 = $users2->Others->agentName;
			}else{
				$name2 = $users2->NewModel->displayName;
			}

	Mail::send('emails.activeservice', array('user' => $name2, 'castTitle' => $getphotosession->name), function($message) use ($email)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($email->email)->subject('Welcome!');
		    
		});

	}elseif ($checksub > 0) {
		
		

		$getid = $value;

		$planstatus = 'active';
    	$startdate = time();

	$getphoto = DB::table('onlinepayoutsub')->where('ref_id', '=', $getid)->first();

	$offlinepayoutphotosession = DB::table('onlinepayoutsub')->where('ref_id', '=', $getphoto->ref_id)->update(array('status' => 'yes'));


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
	}elseif ($checkcast > 0) {

	$getphoto = DB::table('onlinepayoutcast')->where('ref_id', '=', $value)->first();

	$getdata = DB::table('modelscastpayment')->where('cast_id', '=', $getphoto->cast_id)->get();
	$id = $getphoto->cast_id;
	$getpaymentmethod = DB::table('casting')->where('id', '=', $id)->first();
	if ($getdata) {
	$offlinepayoutphotosession = DB::table('onlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->update(array('status' => 'yes'));
		
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

		$getnum = DB::table('models')->where('user_id', '=', $key->user_id)->first();
		$num = $getnum->phone;
		$displayName = $getnum->displayName;
		$castTitle = $getpaymentmethod->castTitle;
		$castcode = $getpaymentmethod->castcode;
		$getmail = User::find($key->user_id);

	$msg = "$getpaymentmethod->castTitle and $getpaymentmethod->castcode has been activated.";

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

		}else{
				# code...

			$getnum = DB::table('models')->where('user_id', '=', $key->user_id)->first();
		$num = $getnum->phone;
		$displayName = $getnum->displayName;
		$castTitle = $getpaymentmethod->castTitle;
		$castcode = $getpaymentmethod->castcode;
		$getmail = User::find($key->user_id);


	$msg = "$getpaymentmethod->castTitle and $getpaymentmethod->castcode has been activated.";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);


			
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
			
			Mail::send('emails.activecast', array('user' => $displayName, 'castTitle' => $castTitle, 'castcode' => $castcode), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

		}
	}

	}else{

	$getphotosession = DB::table('casting')->where('id', '=', $getphoto->cast_id)->first();

	$offlinepayoutphotosession = DB::table('onlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->update(array('status' => 'yes'));
	$updatecast = DB::table('casting')->where('id', '=', $getphoto->cast_id)->update(array('status' => 'finished'));
	$getcount = DB::table('onlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->count();

	$getuser = DB::table('onlinepayoutcast')->where('ref_id', '=', $getphoto->ref_id)->get();

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

			$getnum = DB::table('models')->where('user_id', '=', $key->model_id)->first();
		$num = $getnum->phone;
		$displayName = $getnum->displayName;
		$castTitle = $getpaymentmethod->castTitle;
		$castcode = $getpaymentmethod->castcode;
		$getmail = User::find($key->model_id);


	$msg = "$getpaymentmethod->castTitle and $getpaymentmethod->castcode has been activated.";

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

		}
		}
	}elseif ($checkjob > 0) {

	$getphoto = DB::table('onlinepayoutjob')->where('refid', '=', $value)->first();
	$getphotosession = DB::table('job')->where('id', '=', $getphoto->job_id)->first();

	$offlinepayoutphotosession = DB::table('onlinepayoutjob')->where('refid', '=', $getphoto->refid)->update(array('status' => 'yes'));
	$updatecast = DB::table('job')->where('id', '=', $getphoto->job_id)->update(array('status' => 'finished'));
	$getcount = DB::table('onlinepayoutjob')->where('refid', '=', $getphoto->refid)->count();

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


	

			$getnum = DB::table('others')->where('user_id', '=', $key->user_id)->first();
			$getmail = User::find($key->user_id);
			$num = $getnum->telephone;
			$displayName = $getnum->agentName;
			$jobtitle = $updatecast->title;
			$jobcode = $updatecast->jobcode;

			$msg = "$jobtitle and $jobcode has been activated.";

$client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => $num, 'text'=> $msg]
]);
 
			Mail::send('emails.activejob', array('user' => $displayName, 'castTitle' => $jobtitle, 'castcode' => $jobcode), function($message) use ($getmail)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to($getmail->email)->subject('Welcome!');
		    
		});

		}
	}
}

public function paycallback()
{
	# code...
	$btn = '';
	if (isset(Auth::user()->id)) {
				# code...
	if (Auth::user()->user_type == 'proModel' || Auth::user()->user_type == 'newFace') {
		$getcat = DB::table('distable')->where('user_id', '=', Auth::user()->id)->first();
		$getimage = DB::table('imagegallery')->where('user_id', '=', Auth::user()->id)->first();
					
				if (!isset($getcat) && !isset($getimage)) {
					$btn = "<a href='/models/photoupload' class='btn btn-success'>Click here and sign In to continue</a>";
				}
	}
			$getnotifyunseen = $this->getunseen();
			}else{
			$getnotifyunseen = '';
			}
	$paycallback = 'yes';
	return View::make('layouts.paycallback')->with(compact('getnotifyunseen', 'btnpay', 'paycallback'));
}

public function forgottenpassword()
{
	return View::make('layouts.forgottenpassword');
}

public function resetemail()
{
	$data = Input::all();

		$validator = Validator::make($data,  NewModel::$email_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}

	$getuser = DB::table('users')->where('email', '=', Input::get('email'))->first();

	if ($getuser) {
		$csdate = date('Y');
   		 $rand = mt_rand(1000000,9999999);

   		 $emailverification = new passwordverify;
   		 $emailverification->user_id = $getuser->id;
   		 $emailverification->code = $rand.$csdate;
   		 $emailverification->save();

   		 $code = $rand.$csdate;
   		 $url=$getuser->id."/".$code;

   		 Mail::send('emails.resetemail', array('url' => $url), function($message)
		{
			$message->from('info@afrodaisymodels.com', 'Afrodaisy');
		    $message->to(Input::get('email'))->subject('Welcome!');
		    
		});

   		 return Redirect::to('resent');
	}else{
		return Redirect::back();
	}

		
}

public function resetsent()
{
	return View::make('layouts.resetsent');
}

public function reset($id, $code)
{
	$id = $id;
	$code = $code;
	$getdata = DB::table('passwordverify')->where('user_id', '=', $id)->where('code', '=', $code)->where('status', '=', '')->get();
	if ($getdata) {

	return View::make('layouts.reset')->with(compact('id', 'code'));
}
}

public function resetpassword()
{
	$data = Input::all();

		$validator = Validator::make($data,  NewModel::$password_rules);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}else{
		$password = Hash::make(Input::get('password'));

		$getdata = DB::table('passwordverify')->where('user_id', '=', Input::get('id'))->where('code', '=', Input::get('code'))->update(array('status' => 'active'));	

		$user = DB::table('users')->where('id', '=', Input::get('id'))->update(array('password' => $password));
		return View::make('layouts.passwordreset');
	}

}

public function terms()
{
	$getnotifyunseen = '';
	return View::make('layouts.terms')->with(compact('getnotifyunseen'));
}

public function contactus()
{
	$getnotifyunseen = '';
	return View::make('layouts.contactus')->with(compact('getnotifyunseen'));
}

public function sendcontactus()
{
	$data = Input::all();

		$validator = Validator::make($data,  NewModel::$contact);

	if ($validator->fails()) {

	return Redirect::back()->withErrors($validator)->withInput();

	}else{
		Mail::send('emails.contactpage', array('name' => Input::get('Name'), 'from' => Input::get('email'), 'msg' => Input::get('contactus')), function($message)
		{
			$message->from(Input::get('email'), Input::get('Name'));
		    $message->to('info@afrodaisymodels.com')->subject('Welcome!');
		    
		});
		$sentmsg = 'Message sent';
		return View::make('layouts.contactus')->with(compact('sentmsg'));
	}
}

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

public function poll()
{
	$month = date('m');
	$year = date('Y');
	$getlikes = DB::table('castlikes')->where('month','=', $month)->where('year', '=', $year)->groupBy('likesreciever')->get();
	$myarray = array();
	foreach ($getlikes as $key) {
		$getnum = DB::table('castlikes')->where('likesreciever', '=', $key->likesreciever)->where('month','=', $month)->where('year', '=', $year)->count();
		$myarray[]  = array("id" => $key->likesreciever, "value" => $getnum);

	}

	$val = '';
	$num = 0;
	$myarray2 = $this->array_orderby($myarray, 'value', SORT_DESC, 'id', SORT_ASC);

$val .= "<ul class='paginate' style='list-style-type:none'>";
	foreach ($myarray2 as $key => $value) {
$val .= "<li>
		<div class='col-lg-12 col-sm-12 col-xs-12' style='border: 1px solid #000; margin-bottom: 20px'>";
		
		$users = User::find($value['id']);
		$getfoto = DB::table('photoupload')->where('user_id', '=', $value['id'])->first();
		if (empty($users->NewModel->displayName)) {
			# code...
			$name = $users->Others->agentName;
		}else{
			$name = $users->NewModel->displayName;
		}
		$num++;

		$val .= "	<div class='row'>
					<div class='col-lg-1 col-sm-1 col-xs-1'>
						<h3>$num</h3>
					</div>
					<div class='col-lg-5 col-sm-5 col-xs-4 text-left'>";
				if(!empty($getfoto->imagename)){
				 $val .=  $image = HTML::image($getfoto->imagename ,'cast picture', array('width' => '150px', 'Height' => '15px' , 'class' => 'img-responsive'));
				        }
				        else{
				$val .= $image = HTML::image('img/photo.jpg', 'profile picture', array('width' => '30px', 'Height' => '30px'));
						}
				$val .= "</div>
					<div class='col-lg-6 col-sm-6 col-xs-5'>
					<h4><strong style='color: #f47735;'> #</strong>: <strong>".$value['value']." </strong></h4>
					<hr>
					<h5><span class='glyphicon glyphicon-user'></span> <strong><a href=".$this->getProfile($value['id'])." style='color: #f47735;'>$name</a></strong></h5>
					<hr>
					<h6><span class='glyphicon glyphicon-certificate' style='color: #f47735;'></span> <strong>".$this->getUserType($value['id'])."</strong></h6>
				</div></div>";

		

	$val .= "</div></li>";
	}
	$val .= "</ul>
				<script type='text/javascript'>
		    $('.paginate').paginathing({
		    perPage: 10,
		    limitPagination: 10
			})
			</script>";

	$myval = $val;
			$getnotifyunseen = '';
	
	return View::make('layouts.poll')->with(compact('myval', 'getnotifyunseen'));
}

public function getrss()
{
  $xml=("http://blog.afrodaisy.com/feed/");

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo("<p><a href='//blog.afrodaisy.com'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=3; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  echo ("<p><a href='" . $item_link
  . "' target='_'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");
}

}

public function faq()
{
			$getnotifyunseen = '';
	return View::make('layouts.faq')->with(compact('getnotifyunseen'));
}

public function privacy()
{
			$getnotifyunseen = '';
	return View::make('layouts.privacy')->with(compact('getnotifyunseen'));
	
}

public function modellingadvice()
{
			$getnotifyunseen = '';
	return View::make('layouts.modellingadvice')->with(compact('getnotifyunseen'));
}

public function plans()
{
	$getnotifyunseen = '';
	return View::make('layouts.plan')->with(compact('getnotifyunseen'));
}

public function postcast()
{
	$getnotifyunseen = '';
	return View::make('layouts.postcast')->with(compact('getnotifyunseen'));

}

}

