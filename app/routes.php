<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

Route::get('sms', function()
{
  $client = new Client();
  $response = $client->post("https://api.infobip.com/sms/1/text/single", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Basic S2FqYW5kaTp1Y2hlYmxpc3M0OQ=='],
    'json'    => ['from'=> 'Afrodaisy', 'to' => '2348146539245', 'text'=> 'ebere jkvg jghvghchfgc hgvghcvhgf']
]);

});

Route::post('pay/Photosession', function()
{

  $client = new Client();

  $user = User::find(Auth::user()->id);
  $id = $_POST['photo_id'];
  $email = $user->email;
  $amount = $_POST['amount'];
  $total = $amount * 100;

$csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-PHONL-".$rand."-".$csdate;

    $onlinepayoutphotosession = new onlinepayoutphotosession;
    $onlinepayoutphotosession->photosession_id = $id;
    $onlinepayoutphotosession->amount = $amount;
    $onlinepayoutphotosession->user_id = Auth::user()->id;
    $onlinepayoutphotosession->ref_id = $code;
    $onlinepayoutphotosession->save();

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $total, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);
    /** @var $response Response */
  

});

Route::post('pay/Course', function()
{

  $client = new Client();

  $user = User::find(Auth::user()->id);
  $id = $_POST['course_id'];
  $email = $user->email;
  $amount = $_POST['amount'];
  $total = $amount * 100;

$csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-CSONL-".$rand."-".$csdate;

    $onlinepayoutphotosession = new onlinepayoutcourses;
    $onlinepayoutphotosession->course_id = $id;
    $onlinepayoutphotosession->amount = $amount;
    $onlinepayoutphotosession->user_id = Auth::user()->id;
    $onlinepayoutphotosession->ref_id = $code;
    $onlinepayoutphotosession->save();

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $total, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);

});

Route::post('pay/Services', function()
{

  $client = new Client();

  $user = User::find(Auth::user()->id);
  $id = $_POST['course_id'];
  $email = $user->email;
  $amount = $_POST['amount'];
  $total = $amount * 100;

$csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-SVONL-".$rand."-".$csdate;

    $onlinepayoutphotosession = new onlinepayoutservices;
    $onlinepayoutphotosession->service_id = $id;
    $onlinepayoutphotosession->amount = $amount;
    $onlinepayoutphotosession->user_id = Auth::user()->id;
    $onlinepayoutphotosession->ref_id = $code;
    $onlinepayoutphotosession->save();

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $total, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);

});

Route::any('pay/afroplus', function()
{

  $client = new Client();

  $user = User::find(Auth::user()->id);
  $id = 2;
  $email = $user->email;
  $amount = 2850;
  $total = $amount * 100;

$csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-SUBONL-".$rand."-".$csdate;

    $onlinepayoutphotosession = new onlinepayoutsub;
    $onlinepayoutphotosession->sub_id = $id;
    $onlinepayoutphotosession->amount = $amount;
    $onlinepayoutphotosession->user_id = Auth::user()->id;
    $onlinepayoutphotosession->ref_id = $code;
    $onlinepayoutphotosession->save();

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $total, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);

});

Route::post('pay/afrounlimited', function()
{

  $client = new Client();

  $user = User::find(Auth::user()->id);
  $id = 3;
  $email = $user->email;
  $amount = 3500;
  $total = $amount * 100;

$csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-SUBONL-".$rand."-".$csdate;

    $onlinepayoutphotosession = new onlinepayoutsub;
    $onlinepayoutphotosession->sub_id = $id;
    $onlinepayoutphotosession->amount = $amount;
    $onlinepayoutphotosession->user_id = Auth::user()->id;
    $onlinepayoutphotosession->ref_id = $code;
    $onlinepayoutphotosession->save();

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $total, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);

});

Route::any('pay/cast', function()
{

  $client = new Client();

  $id = Input::get('cast_id');
    $csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-CSONL-".$rand."-".$csdate;
      $user = User::find(Auth::user()->id);
      $email = $user->email;
    $view = '';
    $no = '';

    $getcast = DB::table('casting')->where('id', '=', $id)->first();
    $getmodels = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->get();
  $getcount = DB::table('casttable')->where('cast_id', '=', $id)->where('castStatus', '=', 'confirmed')->count();

  $Amount = $getcast->payDesc * $getcount;
  $Amount = $Amount * 100;

    foreach ($getmodels as $key) {
      
    $offlinepayoutjob = new onlinepayoutcast;
    $offlinepayoutjob->cast_id = $id;
    $offlinepayoutjob->model_id = $key->user_id;
    $offlinepayoutjob->ref_id = $code;
    $offlinepayoutjob->save();      

    }

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $Amount, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);

});

Route::any('pay/job', function()
{

  $client = new Client();

      $id = Input::get('job_id');
    $csdate = date('Y');
    $rand = mt_rand(100000,999999);
    $code = "ADM-JBONL-".$rand."-".$csdate;
    $user = User::find(Auth::user()->id);
      $email = $user->email;

    $getdata = DB::table("job")->where('id', '=', $id)->first();

    $offlinepayoutjob = new onlinepayoutjob;
    $offlinepayoutjob->job_id = $id;
    $offlinepayoutjob->refid = $code;
    $offlinepayoutjob->save();

    $amount = $getdata->amount * 100;

$response = $client->post("https://api.paystack.co/transaction/initialize", [
    'headers' => ['Content-Type' => 'application/json',
                  'Authorization' => 'Bearer sk_live_04711c8322061ad4fb98d8cada9c97a4984893c3'],
    'json'    => ['reference'=> $code, 'amount' => $amount, 'email'=> $email]
]);
$data =  json_decode($response->getBody(true));
$url = $data->data->authorization_url;

$request = $client->post($url);

return Redirect::to($url);

});

Route::any('/paywebhook', array('as' => 'addUser', 'uses' => 'UsersController@paywebhook'));
Route::any('/paycallback', array('as' => 'addUser', 'uses' => 'UsersController@paycallback'));

Route::get('uploadprofile', function()
{
  $file = Input::file('filedata');
   
  $destinationPath = public_path('img/profile/');
  $filename  = str_random(16);
  $extension = $file->getClientOriginalExtension(); 
  $size      = $file->getSize(); 
  $fullName  = $filename.'.'.$extension;
  $imagename = 'img/profile/'.$fullName;
  $upload_success = $file->move($destinationPath, $fullName);

  $notify = DB::table('notification')->where('name', '=', 'photoupload')->first();
  $notifyId = $notify->id;

  $dates = date('d-m-Y');

if (!is_null($imagename)) {
    # code...

    $getphoto = DB::table('photoupload')->where('user_id', '=', Auth::user()->id)->get();

    if ($getphoto) {
      $update = DB::table('photoupload')->where('user_id', '=', Auth::user()->id)->update(array('imagename' => $imagename));
    }else{
    $imagegallery = new photoupload;
     $imagegallery->user_id = Auth::user()->id;
     $imagegallery->image_type = 'profileImage';
     $imagegallery->imagename = $imagename;
     $imagegallery->save();
    }

    $imagegallery = new imagegallery;
     $imagegallery->user_id = Auth::user()->id;
     $imagegallery->imagename = $imagename;
     $imagegallery->save();
     $img_id = $imagegallery->id;

     $ModelNotify = new ModelNotify;
    $ModelNotify->NotId = $notifyId;
    $ModelNotify->user = Auth::user()->id;
    $ModelNotify->status = 'active';
    $ModelNotify->date = $dates;
    $ModelNotify->save();
    $ModelNotifyId = $ModelNotify->id;

        $notify = new notifyuploadphoto;
        $notify->NotId = $ModelNotifyId;
        $notify->user_id = Auth::user()->id;
        $notify->img_id = $img_id;
        $notify->date = $dates;
        $notify->save();

}
  
   
  if( $upload_success ) {
     return Response::json(['name' => $fullName, 'size' => $size], 200);

  } else {
     return Response::json('error', 400);
  }
});

Route::post('upload', function()
{
  $file = Input::file('filedata');
   
  $destinationPath = public_path('img/profile/');
  $filename  = str_random(16);
  $extension = $file->getClientOriginalExtension(); 
  $size      = $file->getSize(); 
  $fullName  = $filename.'.'.$extension;
  $imagename = 'img/profile/'.$fullName;
  $upload_success = $file->move($destinationPath, $fullName);

  $notify = DB::table('notification')->where('name', '=', 'photoupload')->first();
  $notifyId = $notify->id;

  $dates = date('d-m-Y');

if (!is_null($imagename)) {
    # code...
    $imagegallery = new imagegallery;
     $imagegallery->user_id = Auth::user()->id;
     $imagegallery->imagename = $imagename;
     $imagegallery->save();
     $img_id = $imagegallery->id;

     $ModelNotify = new ModelNotify;
    $ModelNotify->NotId = $notifyId;
    $ModelNotify->user = Auth::user()->id;
    $ModelNotify->status = 'active';
    $ModelNotify->date = $dates;
    $ModelNotify->save();
    $ModelNotifyId = $ModelNotify->id;

        $notify = new notifyuploadphoto;
        $notify->NotId = $ModelNotifyId;
        $notify->user_id = Auth::user()->id;
        $notify->img_id = $img_id;
        $notify->date = $dates;
        $notify->save();

}
  
   
  if( $upload_success ) {
     return Response::json(['name' => $fullName, 'size' => $size], 200);

  } else {
     return Response::json('error', 400);
  }
});

Route::get('/', function()
{
	return View::make('hello');
});

Route::get("/", function()
{
    # code...

    $dates = date('d-m-Y');
    $day = date('j');
    $month = date('n');

    $notify = DB::table('notification')->where('name', '=', 'userBirth')->first();
    $notifyId = $notify->id;

    $userbithday = DB::table('modelnofity')->where('NotId', '=', $notifyId)->where('date', '=', $dates)->count();
    if ($userbithday < 1) {
        # code...
    $selectuser = DB::table('models')->where('DayofBirth', '=', $day)->where('MonthOfBirth', '=', $month)->get();
    if ($selectuser) {
        # code...
        foreach ($selectuser as $key) {
            # code...
            $ModelNotify = new ModelNotify;
            $ModelNotify->NotId = $notifyId;
            $ModelNotify->user = $key->user_id;
            $ModelNotify->status = 'active';
            $ModelNotify->date = $dates;
            $ModelNotify->save();
            $ModelNotifyId = $ModelNotify->id;

        $notify = new notificationbirthday;
        $notify->NotId = $ModelNotifyId;
        $notify->celebrant = $key->user_id;
        $notify->date = $dates;
        $notify->save();
        }
    }
    
    }

    $getnotifyunseen = '';
    return View::make('page.index')->with(compact('getnotifyunseen'));
});

Route::get('post-a-cast', array('as' => 'signup', 'uses' => 'UsersController@postcast'));
Route::get('faq', array('as' => 'signup', 'uses' => 'UsersController@faq'));
Route::get('contact-us', array('as' => 'signup', 'uses' => 'UsersController@contactus'));
Route::get('terms-and-conditions', array('as' => 'signup', 'uses' => 'UsersController@terms'));
Route::post('user/contactus', array('as' => 'resetpassword', 'uses' => 'UsersController@sendcontactus'));
Route::post('user/resetpassword', array('as' => 'resetpassword', 'uses' => 'UsersController@resetpassword'));
Route::get('resent', array('as' => 'signup', 'uses' => 'UsersController@resetsent'));
Route::get('reset/{id}/{code}', array('as' => 'signup', 'uses' => 'UsersController@reset'));
Route::get('forgottenpassword', array('as' => 'signup', 'uses' => 'UsersController@forgottenpassword'));
Route::get('users/sendemail', array('as' => 'signup', 'uses' => 'UsersController@sendemail'));
Route::get('activate/{id}/{code}', array('as' => 'signup', 'uses' => 'UsersController@activate'));
Route::get('plans', array('as' => 'signup', 'uses' => 'UsersController@plans'));
Route::get('signup', array('before' => 'signin', 'as' => 'signup', 'uses' => 'UsersController@newAccount'));
Route::get('signin', array('before' => 'signin', 'as' => 'signin', 'uses' => 'UsersController@signin'));
Route::get('about', array('as' => 'signup', 'uses' => 'UsersController@about'));
Route::post('user/addUser', array('as' => 'addUser', 'uses' => 'UsersController@addUser'));
Route::get('models/welcome', array('before' => 'authuser', 'as' => 'welcome', 'uses' => 'ModelController@welcome'));
Route::post('user/LoginUser', array('as' => 'signin', 'uses' => 'UsersController@LoginUser'));
Route::get('user/plan/{id}', array('as' => 'plan', 'uses' => 'UsersController@planinsert'));
Route::post('model/create', array('as' => 'create', 'uses' => 'ModelController@create'));
Route::post('models/uploadImage', array('as' => 'uploadphoto', 'uses' => 'ModelController@uploadImage'));
Route::get('signout', array('as' => 'signout', 'uses' => 'UsersController@signout'));
Route::get('models/uploadphoto', array('as' => 'create', 'uses' => 'ModelController@uploadphoto'));
Route::get('models/dashboard', array('before'=>'models', 'as' => 'create', 'uses' => 'ModelController@dashboard'));
Route::get('models/profile/{id}', array('as' => 'create', 'uses' => 'ModelController@profile'));
Route::get('models/edit', array('before'=>'models', 'as' => 'create', 'uses' => 'ModelController@edit'));
Route::get('models/setprofile', array('as' => 'create', 'uses' => 'ModelController@setprofile'));
Route::get('models/delpix', array('as' => 'create', 'uses' => 'ModelController@delpix'));
Route::get('models/bankdetails', array('as' => 'create', 'uses' => 'ModelController@bankdetails'));
Route::get('models/regplan', array('as' => 'welcome', 'uses' => 'ModelController@regplan'));
Route::get('models/changeplans', array('as' => 'welcome', 'uses' => 'ModelController@changeplans'));
Route::get('models/payofflinesub/{id}', array('as' => 'welcome', 'uses' => 'ModelController@payofflinesub'));
Route::get('models/editpix', array('as' => 'welcome', 'uses' => 'ModelController@editpix'));



Route::get('others/applyjob', array('before' => 'others', 'as' => 'welcome', 'uses' => 'OthersController@applyjob'));
Route::get('jobdetails/{id}', array('as' => 'welcome', 'uses' => 'OthersController@jobdetails'));
Route::get('job', array('as' => 'welcome', 'uses' => 'OthersController@job'));
Route::get('others/checkout', array('as' => 'welcome', 'uses' => 'OthersController@checkout'));
Route::get('others/offlinepayoutservices/{id}', array('as' => 'welcome', 'uses' => 'OthersController@offlinepayoutservices'));
Route::get('others/offlinepayoutcourses/{id}', array('as' => 'welcome', 'uses' => 'OthersController@offlinepayoutcourses'));
Route::get('others/offlinepayoutphotosession/{id}', array('as' => 'welcome', 'uses' => 'OthersController@offlinepayoutphotosession'));
Route::get('others/paycheckoutpost/{id}', array('as' => 'welcome', 'uses' => 'OthersController@paycheckoutpost'));
Route::get('others/changecastmodel', array('as' => 'welcome', 'uses' => 'OthersController@changecastmodel'));
Route::get('others/modelchange', array('as' => 'welcome', 'uses' => 'OthersController@changemodel'));
Route::get('others/changemodel', array('as' => 'welcome', 'uses' => 'OthersController@changemodel'));
Route::get('others/payofflinejob/{id}', array('as' => 'welcome', 'uses' => 'OthersController@payofflinejob'));
Route::get('others/paycheckout/{id}', array('as' => 'welcome', 'uses' => 'OthersController@paycheckout'));
Route::get('others/checkout', array('as' => 'welcome', 'uses' => 'OthersController@checkout'));
Route::get('others/checkoutjob', array('as' => 'welcome', 'uses' => 'OthersController@checkoutjob'));
Route::get('others/checkoutpost', array('as' => 'welcome', 'uses' => 'OthersController@checkoutpost'));
Route::get('others/getdatainvite', array('as' => 'welcome', 'uses' => 'OthersController@getdatainvite'));
Route::get('others/payofflinecast2/{id}', array('as' => 'welcome', 'uses' => 'OthersController@payofflinecast2'));
Route::get('others/payofflinecast/{id}', array('as' => 'welcome', 'uses' => 'OthersController@payofflinecast'));
Route::get('others/welcome', array('before' => 'authuser', 'as' => 'welcome', 'uses' => 'OthersController@welcome'));
Route::post('others/create', array('as' => 'create', 'uses' => 'OthersController@create'));
Route::post('others/uploadImage', array('as' => 'uploadphoto', 'uses' => 'OthersController@uploadImage'));
Route::get('others/uploadphoto', array('as' => 'create', 'uses' => 'OthersController@uploadphoto'));
Route::get('others/dashboard', array('before' => 'others', 'as' => 'create', 'uses' => 'OthersController@dashboard'));
Route::get('others/profile/{id}', array('as' => 'create', 'uses' => 'OthersController@profile'));
Route::get('others/edit', array('before' => 'others', 'as' => 'create', 'uses' => 'OthersController@edit'));
Route::get('others/newcasting', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@newcasting'));
Route::get('others/newjob', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@newjob'));
Route::get('others/joblisting', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@joblisting'));
Route::get('others/bookjob', array('as' => 'create', 'uses' => 'OthersController@bookjob'));
Route::post('others/createjob', array('before' => 'authuser', 'as' => 'create', 'uses' => 'OthersController@createjob'));
Route::post('others/createcast', array('before' => 'authuser', 'as' => 'create', 'uses' => 'OthersController@createcast'));
Route::get('others/castlisting', array('before' => 'others', 'as' => 'create', 'uses' => 'OthersController@castlisting'));
Route::get('others/showjob/{id}', array('as' => 'create', 'uses' => 'OthersController@showjob'));
Route::get('others/showcast/{id}', array('as' => 'create', 'uses' => 'OthersController@showcast'));
Route::post('others/updatejob/{id}', array('as' => 'create', 'uses' => 'OthersController@jobupdate'));
Route::post('others/updatecast/{id}', array('as' => 'create', 'uses' => 'OthersController@castupdate'));
Route::get('others/invitemodels', array('as' => 'create', 'uses' => 'OthersController@invitemodels'));
Route::get('others/invitepro', array('as' => 'create', 'uses' => 'OthersController@invitepro'));
Route::get('others/linktojob', array('as' => 'create', 'uses' => 'OthersController@linktojob'));
Route::get('others/sendinvitation', array('as' => 'create', 'uses' => 'OthersController@sendinvitation'));
Route::get('others/processconfirm', array('as' => 'processconfirm', 'uses' => 'OthersController@processconfirm'));
Route::get('others/processextconfirm', array('as' => 'processconfirm', 'uses' => 'OthersController@processextconfirm'));
Route::get('others/discardform2', array('as' => 'discardform', 'uses' => 'OthersController@discardform2'));
Route::get('others/discardform', array('as' => 'discardform', 'uses' => 'OthersController@discardform'));
Route::get('others/discardextform', array('as' => 'discardform', 'uses' => 'OthersController@discardextform'));
Route::get('others/processconfirm2', array('as' => 'processconfirm', 'uses' => 'OthersController@processconfirm2'));
Route::get('others/getall2', array('as' => 'create', 'uses' => 'OthersController@getall2'));
Route::get('others/sendmsg', array('as' => 'create', 'uses' => 'OthersController@sendmsg'));
Route::get('others/getdisc2', array('as' => 'create', 'uses' => 'OthersController@getdisc2'));
Route::get('others/getapplicant', array('as' => 'create', 'uses' => 'OthersController@getapplicant'));
Route::get('others/getall', array('as' => 'create', 'uses' => 'OthersController@getall'));
Route::get('others/getdisc', array('as' => 'create', 'uses' => 'OthersController@getdisc'));
Route::get('others/showprofile/{id}', array('as' => 'create', 'uses' => 'OthersController@showprofile'));
Route::get('others/showcastdetail/{id}', array('as' => 'create', 'uses' => 'OthersController@showcastdetail'));
Route::get('models/likeuser', array('as' => 'create', 'uses' => 'ModelController@likeuser'));
Route::get('models/dislikeuser', array('as' => 'create', 'uses' => 'ModelController@dislikeuser'));
Route::get('models/following', array('as' => 'create', 'uses' => 'ModelController@following'));
Route::get('models/unfollow', array('as' => 'create', 'uses' => 'ModelController@unfollow'));
Route::get('models/setcategory', array('as' => 'create', 'uses' => 'ModelController@setcategory'));
Route::get('models/castdecline', array('as' => 'create', 'uses' => 'ModelController@castdecline'));
Route::get('models/declinecast', array('as' => 'create', 'uses' => 'ModelController@declinecast'));
Route::get('other/updatedetails', array('as' => 'create', 'uses' => 'OthersController@updatedetails'));
Route::get('other/editcast', array('as' => 'create', 'uses' => 'OthersController@editcast'));
Route::get('others/mymodelbook', array('as' => 'create', 'uses' => 'OthersController@mymodelbook'));
Route::get('others/castadded', array('as' => 'create', 'uses' => 'OthersController@castadded'));
Route::get('others/jobadded', array('as' => 'create', 'uses' => 'OthersController@jobadded'));

Route::get('users/others', array('as' => 'create', 'uses' => 'UsersController@others'));

Route::get('users/searchothers', array('as' => 'create', 'uses' => 'UsersController@searchothers'));

Route::get('users/photographers', array('as' => 'create', 'uses' => 'UsersController@photographers'));

Route::get('users/agency', array('as' => 'create', 'uses' => 'UsersController@agency'));

Route::get('users/artist', array('as' => 'create', 'uses' => 'UsersController@artist'));

Route::get('users/searchartist', array('as' => 'create', 'uses' => 'UsersController@searchartist'));

Route::get('users/fashion', array('as' => 'create', 'uses' => 'UsersController@fashion'));

Route::get('users/searchfashion', array('as' => 'create', 'uses' => 'UsersController@searchfashion'));

Route::get('users/searchphoto', array('as' => 'create', 'uses' => 'UsersController@searchphoto'));

Route::get('users/searchresult', array('as' => 'create', 'uses' => 'UsersController@searchresult'));

Route::get('users/selcountry', array('as' => 'create', 'uses' => 'UsersController@selcountry'));

Route::get('users/unlikeimages', array('as' => 'create', 'uses' => 'UsersController@unlikeimages'));

Route::get('photosession/course/{id}', array('as' => 'create', 'uses' => 'UsersController@photocourse'));

Route::get('courses/details/{id}', array('as' => 'create', 'uses' => 'UsersController@coursesdetails'));

Route::get('services/details/{id}', array('as' => 'create', 'uses' => 'UsersController@servicedetails'));

Route::get('photocoursebook/{id}', array('as' => 'create', 'uses' => 'UsersController@photocoursebook'));

Route::get('coursebook/{id}', array('as' => 'create', 'uses' => 'UsersController@coursebook'));

Route::get('servicebook/{id}', array('as' => 'create', 'uses' => 'UsersController@servicebook'));

Route::post('others/createphotosession', array('as' => 'create', 'uses' => 'OthersController@createphotosession'));

Route::get('others/coursesadded', array('as' => 'create', 'uses' => 'OthersController@coursesadded'));

Route::get('others/photoadded', array('as' => 'create', 'uses' => 'OthersController@photoadded'));

Route::post('others/createcourses', array('as' => 'create', 'uses' => 'OthersController@createcourses'));

Route::get('others/getphotosession', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@getphotosession'));

Route::get('others/coursespage', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@coursespage'));

Route::get('/photosession', array('as' => 'create', 'uses' => 'UsersController@photosession'));

Route::get('/services', array('as' => 'create', 'uses' => 'UsersController@services'));

Route::get('/courses', array('as' => 'create', 'uses' => 'UsersController@courses'));

Route::get('others/followings', array('as' => 'create', 'uses' => 'OthersController@followings'));

Route::get('others/declineopt', array('as' => 'create', 'uses' => 'OthersController@declineopt'));

Route::get('others/acknoledge/{id}', array('as' => 'create', 'uses' => 'OthersController@acknoledge'));

Route::get('others/sendack', array('as' => 'create', 'uses' => 'OthersController@sendack'));

Route::get('others/sendcast', array('as' => 'create', 'uses' => 'OthersController@sendcast'));

Route::get('others/manage/{id}', array('as' => 'create', 'uses' => 'OthersController@manage'));

Route::get('others/servicemgt/{value}/{id}', array('as' => 'create', 'uses' => 'OthersController@servicemgt'));

Route::post('others/createservice', array('as' => 'create', 'uses' => 'OthersController@createservice'));

Route::get('others/servicesadded', array('as' => 'create', 'uses' => 'OthersController@servicesadded'));

Route::get('others/servicemktplace', array('before' => 'others', 'as' => 'create', 'uses' => 'OthersController@servicemktplace'));

Route::get('others/creatjob', array('as' => 'create', 'uses' => 'OthersController@creatjob'));

Route::get('others/jobview', array('as' => 'create', 'uses' => 'OthersController@jobview'));

Route::get('others/jobviews', array('as' => 'create', 'uses' => 'OthersController@jobviews'));

Route::get('others/jobapplyProcess', array('as' => 'create', 'uses' => 'OthersController@jobapplyProcess'));

Route::get('others/jobinvitation', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@jobinvitation'));

Route::get('others/contactothers', array('as' => 'create', 'uses' => 'OthersController@contactothers'));
Route::get('others/mymodelaccept', array('as' => 'create', 'uses' => 'OthersController@mymodelaccept'));
Route::get('others/mymodeldecline', array('as' => 'create', 'uses' => 'OthersController@mymodeldecline'));
Route::get('others/plan', array('as' => 'create', 'uses' => 'OthersController@plan'));
Route::get('others/category', array('as' => 'create', 'uses' => 'OthersController@category'));
Route::get('models/castapplication', array('before'=>'models', 'as' => 'create', 'uses' => 'ModelController@castapplication'));
Route::get('models/castview2', array('as' => 'create', 'uses' => 'ModelController@castview2'));
Route::get('models/castview', array('as' => 'create', 'uses' => 'ModelController@castview'));
Route::get('models/castviews', array('as' => 'create', 'uses' => 'ModelController@castviews'));
Route::get('models/castapplyProcess', array('as' => 'create', 'uses' => 'ModelController@castapplyProcess'));
Route::get('models/castapply', array('as' => 'create', 'uses' => 'ModelController@castapplybutton'));
Route::post('models/edituser', array('as' => 'create', 'uses' => 'ModelController@edituser'));
Route::get('models/editprofile', array('as' => 'create', 'uses' => 'ModelController@editprofile'));
Route::get('models/message', array('as' => 'create', 'uses' => 'ModelController@message'));
Route::get('models/mynetwork', array('as' => 'create', 'uses' => 'ModelController@mynetwork'));

Route::get('dropzone/uploadFiles', 'DropzoneController@uploadFiles');

Route::get('users/unfollow', array('as' => 'create', 'uses' => 'UsersController@unfollow'));

Route::get('users/getrss', array('as' => 'create', 'uses' => 'UsersController@getrss'));

Route::get('users/applycast2', array('as' => 'create', 'uses' => 'UsersController@applycast2'));
Route::get('users/applycast', array('as' => 'create', 'uses' => 'UsersController@applycast'));

Route::get('users/mymessage', array('before' => 'authuser', 'as' => 'create', 'uses' => 'UsersController@mymessage'));

Route::get('users/favorite', array('before'=>'others', 'as' => 'create', 'uses' => 'UsersController@favorite'));

Route::get('users/updatepassword', array('as' => 'create', 'uses' => 'UsersController@updatepassword'));

Route::get('users/updateemail', array('as' => 'create', 'uses' => 'UsersController@updateemail'));

Route::get('users/message', array('as' => 'create', 'uses' => 'UsersController@message'));

Route::get('users/sendreplyimg', array('as' => 'create', 'uses' => 'UsersController@sendReplyimg'));

Route::get('users/sendreply', array('as' => 'create', 'uses' => 'UsersController@sendReply'));

Route::get('users/likeimages', array('as' => 'create', 'uses' => 'UsersController@likeimages'));

Route::get('users/likeimage', array('as' => 'create', 'uses' => 'UsersController@likeimage'));

Route::get('users/likeStatus', array('as' => 'create', 'uses' => 'UsersController@likeStatus'));

Route::get('users/likecommimg', array('as' => 'create', 'uses' => 'UsersController@likecommimg'));

Route::get('users/likecomm', array('as' => 'create', 'uses' => 'UsersController@likecomm'));

Route::get('users/likereplycommimg', array('as' => 'create', 'uses' => 'UsersController@likereplycommimg'));

Route::get('users/likereplycomm', array('as' => 'create', 'uses' => 'UsersController@likereplycomm'));

Route::get('users/unlikereplycommimg', array('as' => 'create', 'uses' => 'UsersController@unlikereplycommimg'));

Route::get('users/unlikereplycomm', array('as' => 'create', 'uses' => 'UsersController@unlikereplycomm'));

Route::get('users/unlikecommimg', array('as' => 'create', 'uses' => 'UsersController@unlikecommimg'));

Route::get('users/unlikecomm', array('as' => 'create', 'uses' => 'UsersController@unlikecomm'));

Route::get('users/replycommentimg', array('as' => 'create', 'uses' => 'UsersController@replycommentimg'));

Route::get('users/replycomment', array('as' => 'create', 'uses' => 'UsersController@replycomment'));

Route::get('users/sendcommimg', array('as' => 'create', 'uses' => 'UsersController@sendcommimg'));

Route::get('users/sendcomm', array('as' => 'create', 'uses' => 'UsersController@sendcomm'));

Route::get('users/sendnews', array('as' => 'create', 'uses' => 'UsersController@sendnews'));

Route::get('users/newspage', array('before' => 'authuser', 'as' => 'create', 'uses' => 'UsersController@newspage'));

Route::get('users/comment/{id}', array('before' => 'authuser', 'as' => 'create', 'uses' => 'UsersController@comment'));

Route::get('users/imagecomment/{id}', array('before' => 'authuser', 'as' => 'create', 'uses' => 'UsersController@imagecomment'));

Route::get('users/sents', array('as' => 'create', 'uses' => 'UsersController@sents'));

Route::get('users/showmsgdtl', array('as' => 'create', 'uses' => 'UsersController@showmsgdtl'));

Route::get('users/save', array('as' => 'create', 'uses' => 'UsersController@save'));
Route::post('user/resetemail', array('as' => 'create', 'uses' => 'UsersController@resetemail'));


Route::get('poll', array('as' => 'create', 'uses' => 'UsersController@poll'));

Route::get('users/bookmodel/{id}', array('before' => 'others', 'as' => 'create', 'uses' => 'UsersController@bookmodel'));
Route::get('users/sendbookings', array('as' => 'create', 'uses' => 'UsersController@sendbookings'));
Route::get('users/sendbooking', array('as' => 'create', 'uses' => 'UsersController@sendbooking'));
Route::get('users/viewcasts', array('as' => 'create', 'uses' => 'UsersController@viewcasts'));
Route::get('users/viewcast', array('as' => 'create', 'uses' => 'UsersController@viewcast'));
Route::get('users/sendcast', array('as' => 'create', 'uses' => 'UsersController@sendcast'));

Route::get('users/subscriptionstatus', array('before'=>'models', 'as' => 'create', 'uses' => 'UsersController@subscription'));
Route::get('users/changesubscription', array('before'=>'models', 'as' => 'create', 'uses' => 'UsersController@changesubscription'));

Route::get('models/changesubscription', array('before'=>'models', 'as' => 'create', 'uses' => 'ModelController@changesubscription'));
Route::get('models/photoupload', array('before'=>'models', 'as' => 'create', 'uses' => 'ModelController@uploadphoto'));
Route::get('models/btnlk', array('as' => 'create', 'uses' => 'ModelController@btnlk'));
Route::get('models/btndis', array('as' => 'create', 'uses' => 'ModelController@btnlk'));

Route::get('models/btnfl', array('as' => 'create', 'uses' => 'ModelController@btnfl'));
Route::get('models/btnunfl', array('as' => 'create', 'uses' => 'ModelController@btnfl'));

Route::get('models/changeplan/{id}', array('as' => 'create', 'uses' => 'ModelController@changeplan'));

Route::get('users/changeplan/{id}', array('as' => 'create', 'uses' => 'UsersController@changeplan'));

Route::get('models/random', array('as' => 'create', 'uses' => 'AdminController@randomnumber'));

Route::get('users/verifynumber', array('as' => 'create', 'uses' => 'UsersController@smsVerification'));

Route::get('models/shownotify', array('as' => 'create', 'uses' => 'ModelController@getnotice'));

Route::get('models/displayfol', array('as' => 'create', 'uses' => 'ModelController@displayfol'));
Route::get('models/displayflwer', array('as' => 'create', 'uses' => 'ModelController@displayflwer'));

Route::get('models/userunfollow', array('as' => 'create', 'uses' => 'ModelController@userunfollow'));
Route::get('models/userfollow', array('as' => 'create', 'uses' => 'ModelController@userfollow'));

Route::get('models/castdisc', array('as' => 'create', 'uses' => 'ModelController@castdisc'));

Route::get('models/castdisccheck', array('as' => 'create', 'uses' => 'ModelController@castdisccheck'));

Route::get('modelsearch', array('as' => 'create', 'uses' => 'UsersController@modelsearch'));
//facebook login linking and creation of users

Route::get('user/castsearchcode', array('as' => 'create', 'uses' => 'UsersController@castsearchcode'));


Route::get('casting', array('as' => 'create', 'uses' => 'UsersController@casting'));

Route::post('users/sendmsg', array('as' => 'create', 'uses' => 'UsersController@sendmsg'));

Route::get('messagedetails/{id}', array('before' => 'authuser', 'as' => 'create', 'uses' => 'UsersController@messagedetails'));

Route::get('user/castingdetail', array('as' => 'create', 'uses' => 'UsersController@castingdetail'));

Route::get('user/viewsearch', array('as' => 'create', 'uses' => 'UsersController@viewsearch'));

Route::get('test', array('as' => 'create', 'uses' => 'UsersController@test'));

Route::get('users/searchmodel', array('as' => 'create', 'uses' => 'UsersController@searchmodel'));

Route::get('users/searchmodeltext', array('as' => 'create', 'uses' => 'UsersController@searchmodeltext'));

Route::get('users/mymodels', array('before'=>'others', 'as' => 'create', 'uses' => 'OthersController@mymodels'));

Route::get('account/approvephoto', array('as' => 'welcome', 'uses' => 'AccountController@approvephoto'));

Route::get('account/getverifyphoto', array('as' => 'welcome', 'uses' => 'AccountController@getverifyphoto'));

Route::get('account/approvecourse', array('as' => 'welcome', 'uses' => 'AccountController@approvecourse'));

Route::get('account/getverifycourses', array('as' => 'welcome', 'uses' => 'AccountController@getverifycourses'));

Route::get('account/offcourses', array('as' => 'welcome', 'uses' => 'AccountController@offcourses'));

Route::get('account/offphoto', array('as' => 'welcome', 'uses' => 'AccountController@offphoto'));

Route::get('account/getverifyservice', array('as' => 'welcome', 'uses' => 'AccountController@getverifyservice'));

Route::get('account/approveservice', array('as' => 'welcome', 'uses' => 'AccountController@approveservice'));

Route::get('account/offservice', array('as' => 'welcome', 'uses' => 'AccountController@offservice'));

Route::get('account/offcast', array('as' => 'welcome', 'uses' => 'AccountController@offcast'));

Route::get('account/getverifycast', array('as' => 'welcome', 'uses' => 'AccountController@getverifycast'));

Route::post('account/createadvert', array('as' => 'create', 'uses' => 'AccountController@createadvert'));

Route::get('account/approvecast', array('as' => 'welcome', 'uses' => 'AccountController@approvecast'));

Route::get('account/offjobs', array('as' => 'welcome', 'uses' => 'AccountController@offjobs'));

Route::get('account/getverifyjob', array('as' => 'welcome', 'uses' => 'AccountController@getverifyjob'));

Route::get('account/offsub', array('as' => 'welcome', 'uses' => 'AccountController@offsub'));

Route::get('account/getverifysub', array('as' => 'welcome', 'uses' => 'AccountController@getverifysub'));

Route::get('account/approvesub', array('as' => 'welcome', 'uses' => 'AccountController@approvesub'));

Route::get('account/advert', array('as' => 'create', 'uses' => 'AccountController@advert'));

Route::get('account/expenses', array('as' => 'create', 'uses' => 'AccountController@expenses'));

Route::get('account/summary', array('as' => 'create', 'uses' => 'AccountController@summary'));

Route::get('account/getincome', array('as' => 'create', 'uses' => 'AccountController@getincome'));

Route::get('account/income', array('as' => 'create', 'uses' => 'AccountController@income'));

Route::get('account/afroplus', array('as' => 'create', 'uses' => 'AccountController@afroplus'));

Route::get('account/free', array('as' => 'create', 'uses' => 'AccountController@free'));

Route::get('account/afrounlimited', array('as' => 'create', 'uses' => 'AccountController@afrounlimited'));

Route::get('account/changeType', array('as' => 'create', 'uses' => 'AccountController@changeType'));

Route::get('account/booked', array('as' => 'create', 'uses' => 'AccountController@booked'));

Route::get('account/services', array('as' => 'create', 'uses' => 'AccountController@services'));

Route::get('account/photosession', array('as' => 'create', 'uses' => 'AccountController@photosession'));

Route::get('account/courses', array('as' => 'create', 'uses' => 'AccountController@courses'));

Route::get('account/application', array('as' => 'create', 'uses' => 'AccountController@castapplication'));

Route::get('account/outstanding/{cast}/{id}', array('as' => 'create', 'uses' => 'AccountController@outstandingview'));

Route::get('account/castrefund/{cast}/{dtl}/{id}', array('as' => 'create', 'uses' => 'AccountController@castrefund'));

Route::get('account/refund', array('as' => 'create', 'uses' => 'AccountController@refund'));

Route::get('account/outstanding', array('as' => 'create', 'uses' => 'AccountController@outstanding'));

Route::get('account/popjobpayslip', array('as' => 'create', 'uses' => 'AccountController@popjobpayslip'));

Route::get('account/poppayslip', array('as' => 'create', 'uses' => 'AccountController@poppayslip'));

Route::get('account/viewjobpayslip/{id}', array('as' => 'create', 'uses' => 'AccountController@viewjobpayslip'));

Route::get('account/viewpayslip/{id}', array('as' => 'create', 'uses' => 'AccountController@viewpayslip'));

Route::get('account/filterReport', array('as' => 'create', 'uses' => 'AccountController@filterReport'));

Route::post('account/createjobpayment', array('as' => 'create', 'uses' => 'AccountController@createjobpayment'));

Route::post('account/createpayment', array('as' => 'create', 'uses' => 'AccountController@createpayment'));

Route::get('account/', array('before' => 'account', 'as' => 'create', 'uses' => 'AccountController@account'));

Route::get('account/printjobpaymentslip/{cast}', array('as' => 'create', 'uses' => 'AccountController@printjobpaymentslip'));

Route::get('account/printpaymentslip/{cast}/{ackid}', array('as' => 'create', 'uses' => 'AccountController@printpaymentslip'));

Route::get('account/viewpaid', array('as' => 'create', 'uses' => 'AccountController@viewpaid'));

Route::get('account/viewjobreceipt', array('as' => 'create', 'uses' => 'AccountController@viewjobreceipt'));

Route::get('account/viewreceipt', array('as' => 'create', 'uses' => 'AccountController@viewreceipt'));

Route::get('account/jobpay/{id}', array('as' => 'create', 'uses' => 'AccountController@jobpay'));

Route::get('account/jobpayment', array('as' => 'create', 'uses' => 'AccountController@jobpayment'));

Route::get('account/payment', array('as' => 'create', 'uses' => 'AccountController@castpayment'));

Route::get('account/unpaid', array('as' => 'create', 'uses' => 'AccountController@unpaidcast'));

Route::get('account/paid', array('as' => 'create', 'uses' => 'AccountController@paidcast'));

Route::get('account/castpayment/{id}', array('as' => 'create', 'uses' => 'AccountController@payment'));

Route::get('account/jobreceipt', array('as' => 'create', 'uses' => 'AccountController@jobreceipt'));

Route::get('account/reciept', array('as' => 'create', 'uses' => 'AccountController@castreceipt'));

Route::get('account/report', array('as' => 'create', 'uses' => 'AccountController@report'));

Route::get('account/approvejob', array('as' => 'create', 'uses' => 'AccountController@approvejob'));

Route::post('user/Logincpanel', array('as' => 'create', 'uses' => 'UsersController@Logincpanel'));

Route::get('/users/logout', array('as' => 'create', 'uses' => 'UsersController@logout'));

Route::get('/afrodiasycpanel/login', array('as' => 'create', 'uses' => 'UsersController@login'));

Route::get('admin/sendmsgservice', array('as' => 'create', 'uses' => 'AdminController@sendmsgservice'));

Route::get('admin/modalservice', array('as' => 'create', 'uses' => 'AdminController@modalservice'));

Route::get('admin/acceptservice', array('as' => 'create', 'uses' => 'AdminController@acceptservice'));

Route::get('admin/services', array('as' => 'create', 'uses' => 'AdminController@services'));

Route::post('admin/sendservice', array('as' => 'create', 'uses' => 'AdminController@sendservice'));

Route::get('admin/addservice', array('as' => 'create', 'uses' => 'AdminController@addservice'));

Route::get('admin/addtype', array('as' => 'create', 'uses' => 'AdminController@addtype'));

Route::post('admin/sendtype', array('as' => 'create', 'uses' => 'AdminController@sendtype'));

Route::get('admin/addcategory', array('as' => 'create', 'uses' => 'AdminController@addcategory'));

Route::post('admin/addcat', array('as' => 'create', 'uses' => 'AdminController@addcat'));

Route::get('admin/', array('before' => 'admin', 'as' => 'create', 'uses' => 'AdminController@index'));

Route::get('admin/courses', array('as' => 'create', 'uses' => 'AdminController@courses'));

Route::get('admin/photosession', array('as' => 'create', 'uses' => 'AdminController@photosession'));

Route::get('admin/viewserviceinfo', array('as' => 'create', 'uses' => 'AdminController@viewserviceinfo'));

Route::get('admin/newface', array('as' => 'create', 'uses' => 'AdminController@newface'));

Route::get('admin/promodel', array('as' => 'create', 'uses' => 'AdminController@promodel'));

Route::get('admin/photo', array('as' => 'create', 'uses' => 'AdminController@photo'));

Route::get('admin/agency', array('as' => 'create', 'uses' => 'AdminController@agency'));

Route::get('admin/fashion', array('as' => 'create', 'uses' => 'AdminController@fashion'));

Route::get('admin/artist', array('as' => 'create', 'uses' => 'AdminController@artist'));

Route::get('admin/tattoo', array('as' => 'create', 'uses' => 'AdminController@tattoo'));

Route::get('admin/others', array('as' => 'create', 'uses' => 'AdminController@others'));

Route::get('admin/viewprofile', array('as' => 'create', 'uses' => 'AdminController@viewprofile'));

Route::get('admin/viewothers', array('as' => 'create', 'uses' => 'AdminController@viewothers'));

Route::get('admin/viewapplicant', array('as' => 'create', 'uses' => 'AdminController@viewapplicant'));

Route::get('admin/pending', array('as' => 'create', 'uses' => 'AdminController@pendingapplicant'));

Route::get('admin/verify', array('as' => 'create', 'uses' => 'AdminController@verify'));

Route::get('admin/decline', array('as' => 'create', 'uses' => 'AdminController@decline'));

Route::get('admin/modelsview/{id}', array('as' => 'create', 'uses' => 'AdminController@modelsview'));

Route::get('admin/othersview/{id}', array('as' => 'create', 'uses' => 'AdminController@othersview'));

Route::get('admin/declineuser', array('as' => 'create', 'uses' => 'AdminController@declineduser'));

Route::get('admin/accepteduser', array('as' => 'create', 'uses' => 'AdminController@accepteduser'));

Route::get('admin/pendingjob', array('as' => 'create', 'uses' => 'AdminController@pendingjob'));

Route::get('admin/pendingcast', array('as' => 'create', 'uses' => 'AdminController@pendingcast'));

Route::get('admin/pendingdtlsjobs/{id}', array('as' => 'create', 'uses' => 'AdminController@pendingdtlsjobs'));

Route::get('admin/pendingdtls/{id}', array('as' => 'create', 'uses' => 'AdminController@pendingdtls'));

Route::get('admin/acceptjob', array('as' => 'create', 'uses' => 'AdminController@acceptjob'));

Route::get('admin/jobdeclined', array('as' => 'create', 'uses' => 'AdminController@jobdeclined'));

Route::get('admin/acceptcast', array('as' => 'create', 'uses' => 'AdminController@acceptcast'));

Route::get('admin/castdeclined', array('as' => 'create', 'uses' => 'AdminController@castdeclined'));

Route::get('admin/showdeclinedjob', array('as' => 'create', 'uses' => 'AdminController@showdeclinedjob'));

Route::get('admin/showdeclined', array('as' => 'create', 'uses' => 'AdminController@showdeclined'));

Route::get('admin/jobdetails/{id}', array('as' => 'create', 'uses' => 'AdminController@showdeclinedjobdtl'));

Route::get('admin/castdetails/{id}', array('as' => 'create', 'uses' => 'AdminController@showdeclineddtl'));

Route::get('admin/jobtracking', array('as' => 'create', 'uses' => 'AdminController@jobtracking'));

Route::get('admin/jobevent/{id}', array('as' => 'create', 'uses' => 'AdminController@jobevent'));

Route::get('admin/casttracking', array('as' => 'create', 'uses' => 'AdminController@casttracking'));

Route::get('admin/castevent/{id}', array('as' => 'create', 'uses' => 'AdminController@castevent'));

Route::get('users/sendsms', array('as' => 'create', 'uses' => 'UsersController@sendsms'));
Route::get('/privacy', array('as' => 'create', 'uses' => 'UsersController@privacy'));
Route::get('/modelling-advice', array('as' => 'create', 'uses' => 'UsersController@modellingadvice'));

Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::get('login/fb/callback', function() {


  $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
    
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();
     
    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
     
    $me = $facebook->api('/me', ['fields' => [
    'id',
    'first_name',
    'last_name',
    'picture',
    'email',
  ]]);

  $profile = Profile::whereUid($uid)->first();
    if (empty($profile)) {

      $getverify = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->get();
  if ($getverify) {
    $send = DB::table('verificationtable')->where('user_id', '=', Auth::user()->id)->update(array('social' => 'yes'));
  }else{
      $verify = new verificationtable;
      $verify->user_id = Auth::user()->id;
      $verify->social = 'yes';
      $verify->mobile = '';
      $verify->email = '';
      $verify->save();
  }

      $user = User::find(Auth::user()->id);

        $profile = new Profile();
        $profile->uid = $uid;
      $profile->username = $me['id'];
      $profile = $user->profiles()->save($profile);

      
    }
     
    $profile->access_token = $facebook->getAccessToken();
    $profile->save();

    return Redirect::to('models/edit');
});


Route::get('/success', ['uses' => 'HomeController@success']);
Route::get('/popular', ['uses' => 'HomeController@popular']);
