<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAttempt extends Model
{
    protected $fillable = ['quiz_attempt_id', 'question_id', 'question_choice_id', 'answer'];
    protected $with = ['question'];

    /**
     * Question
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
