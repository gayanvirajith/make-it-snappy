<?php

class QuestionsController extends \BaseController {

	/**
	 * Enable csrf authenticity on post
	 */
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => ['post', 'put']));
	}

	/**
	 * Display a listing of the resource.
	 * GET /questions
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('questions.index')
			->withTitle('Make It Snappy Q&A - Home')
			->withQuestions(Question::unsolved());
	}


	/**
	 * Store a newly created question in storage.
	 * POST /create
	 *
	 * @return Response
	 */
	public function create()
	{
		$validator = Question::validate(Input::all());

		if ($validator->passes()) {
			Question::create(array(
					'question' => Input::get('question'),
					'user_id' => Auth::user()->id
			));

			return Redirect::route('home')
				->withMessage('Your question has been posted!');
		} else {
			return Redirect::route('home')
				->withErrors($validator)
				->withInput();
		}
	}

	public function question($id = null) {
		return View::make('questions.view')
			->withTitle(Lang::get('messages.appName') . '- View Question')
			->withQuestion(Question::with('user')->where('id', '=', $id)->first());
	}

	public function yourQuestions() {
		return View::make('questions.your-questions')
			->withTitle(Lang::get('messages.appName') . ' - Your Q\'s')
			->withUsername(Auth::user()->username)
			->withQuestions(Question::yourQuestions());
	}

	public function edit($id = null) {
		$question = $this->findQuestion($id);
		if (!$this->questionBelongsToUser($id)){
			return Redirect::route('yourQuestions')
							->withMessage('Invalid Question');
		}
		return View::make('questions.edit')
				->withTitle(Lang::get('messages.appName') . ' - Edit')
				->withQuestion($question);
	}

	public function update($id) {

		$question = $this->findQuestion($id);
		
		if (!$this->questionBelongsToUser($id)){
			return Redirect::route('yourQuestions')
							->withMessage('Invalid Question');
		}

		$validator = Question::validate(Input::all());

		if ($validator->passes()) {
			$question->question = Input::get('question');
			$question->solved = Input::get('solved');
			$question->update();

			return Redirect::route('question', $id)
				->withMessage('Your Question has been updated!');
		} else {
			return Redirect::route('editQuestion', $id)
				->withErrors($validator)
				->withInput();
		}
	}
  
	private function findQuestion($id) {
		return Question::find($id);
	}

	private function questionBelongsToUser($id) {
		$question = $this->findQuestion($id);

		if ($question->user_id == Auth::user()->id) {
			return true;
		}

		return false;
	}
}