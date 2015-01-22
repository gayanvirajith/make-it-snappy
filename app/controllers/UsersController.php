<?php

class UsersController extends \BaseController {

	/**
	 * Enable csrf authenticity on post
	 */
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => ['post']));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /register
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.new')->withTitle('Make It Snappy Q&A - Register');
	}

	/**
	 * Store a newly created user in storage.
	 * POST /store
	 *
	 * @return Response
	 */
	public function store()
	{

		$validation = User::validate(Input::all());

		if ($validation->passes()) {
			
			User::create(array(
				'username' => Input::get('username'),
				'password' => Hash::make(Input::get('password'))
			));

			$user = User::whereUsername(Input::get('username'))->first();

			Auth::login($user);

			return Redirect::route('home')
				->withMessage('Thanks for registering. You are now logged in!');
		} else {
			return Redirect::route('register')->withErrors($validation)->withInput();
		}
	}


	public function login() {
		return View::make('users.login')
			->withTitle('Make It Snappy Q&A - Login');
	}

	public function auth() {

		$user = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if ( Auth::attempt($user, true) ) {
			return Redirect::route('home')->withMessage('You are logged in!');
		} else {
			return Redirect::route('login')
				->withMessage('Your username/password combination was incorrect!')
				->withInput();
		}
	}

	public function logout() {

		if ( Auth::check()) {
			Auth::logout();
			return Redirect::route('login')->withMessage('You are now logged out!');
		}else {
			return Redirect::route('home');
		}
	}
}