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

			return Redirect::route('home')
				->withMessage('Thanks for registering!');
		} else {
			return Redirect::route('register')->withErrors($validation)->withInput();
		}
	}

}