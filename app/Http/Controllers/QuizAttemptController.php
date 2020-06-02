<?php

namespace App\Http\Controllers;

use App\QuestionAttempt;
use App\QuizAttempt;
use Illuminate\Http\Request;

class QuizAttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->input();
        $user_id = $request->user()->id;
        $quiz_id = $request->input("quiz_id");
        $quizAttempt = QuizAttempt::create([
            'user_id' => $user_id,
            'quiz_id' => $quiz_id
        ]);

        $question_attempts = $request->input("question_attempts");
        foreach ($question_attempts as $attempt) {
            QuestionAttempt::create([
               'quiz_attempt_id' => $quizAttempt->id,
               'question_id' => $attempt['question_id'],
               'answer' => $attempt['answer']
            ]);
        }
        $quizAttempt = QuizAttempt::find($quizAttempt->id);
        return response($quizAttempt, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizAttempt  $quizAttempt
     * @return \Illuminate\Http\Response
     */
    public function show(QuizAttempt $quizAttempt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizAttempt  $quizAttempt
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizAttempt $quizAttempt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuizAttempt  $quizAttempt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizAttempt $quizAttempt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuizAttempt  $quizAttempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizAttempt $quizAttempt)
    {
        //
    }
}
