<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = ['user_id', 'quiz_id'];
    protected $with = ['question_attempts'];

    /**
     * Quiz
     */
    public function quiz()
    {
        return $this->hasOne('App\Quiz');
    }

    /**
     * Get question attempts
     */
    public function question_attempts()
    {
        return $this->hasMany('App\QuestionAttempt');
    }
}
