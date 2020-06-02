<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question', 'question_type', 'question_answer'];
    protected $with = 'choices';
    /**
     * Get the comments for the blog post.
     */
    public function choices()
    {
        return $this->hasMany('App\QuestionChoice');
    }
}
