<?php

class Question extends BaseModel {

	protected $fillable = ['question', 'user_id', 'solved'];

  public static $rules = array(
    'question' => 'required|min:10|max:255',
    'solved' => 'in:0,1'
  );

  public function user() {
    return $this->belongsTo('User');
  }

  public function answers() {
    return $this->hasMany('Answer');
  }

  public static function unsolved() {

    return Question::with(array('user', 'answers'))
      ->where('solved', '=', 0)
      ->orderBy('id', 'DESC')
      ->paginate(3);
  }

  public static function yourQuestions() {
    return Question::with(array('user', 'answers'))
      ->where('user_id', '=', Auth::user()->id)
      ->paginate(3);
  }

  public static function search($keyword) {
    return Question::with('user')
      ->where('question', 'LIKE', '%' . $keyword . '%')
      ->paginate(3);
  }
}