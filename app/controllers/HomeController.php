<?php

use MetzWeb\Instagram\Instagram;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	private $apiKey;
	private $apiSecret;
	private $apiCallback;

	public function __construct()
	{
		$this->apiKey      = 'cc13a2b2978245f1a0cfb9af464e9a37';
		$this->apiSecret   = '8af81fa99a7c4d90959145131291a798';
		$this->apiCallback = 'http://localhost:8000/success';
	}

	// https://github.com/cosenary/Instagram-PHP-API/blob/master/example/success.php
	public function success()
	{
		$instagram = new Instagram([
		  'apiKey'      => $this->apiKey,
		  'apiSecret'   => $this->apiSecret,
		  'apiCallback' => $this->apiCallback,
		]);

		// receive OAuth code parameter
		$code = Input::get('code');

		// check whether the user has granted access
		if ($code) {
			// receive OAuth token object
			$data = $instagram->getOAuthToken($code);
			$username = $username = $data->user->username;
			// store user access token
			$instagram->setAccessToken($data);
			// now you have access to all authenticated user methods
			$result = $instagram->getUserMedia();

			$data = compact(
				'code',
				'data',
				'instagram',
				'result',
				'username'
			);

			return View::make('success', $data);
		} else {
			// check whether an error occurred
			if (Input::get('error')) {
			    return 'An error occurred: ' . Input::get('error_description');
			} else {
				return "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";
			}
		}
	}

	// https://github.com/cosenary/Instagram-PHP-API/blob/master/example/popular.php
	public function popular()
	{
		$instagram = new Instagram($this->apiKey);
		$result = $instagram->getPopularMedia();

		$data = compact(
			'result'
		);

		return View::make('popular', $data);
	}

	public function showWelcome()
	{
		return View::make('hello');
	}



}
