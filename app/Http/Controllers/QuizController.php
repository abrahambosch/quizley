<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return ['foo' => 'bar'];
        return response(Quiz::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function create()
    {
        throw new \Exception("method not implemented. ");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string|min:2|max:100|unique:quizzes,name',
           'description' => 'required|string|nullable',
        ]);
        $quiz = Quiz::create([
            'name' => $request->input("name"),
            'description' => $request->input("description"),
        ]);
        return response($quiz, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return $quiz;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @throws \Exception
     */
    public function edit(Quiz $quiz)
    {
        throw new \Exception("method not implemented. ");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->fill([
            'name' => $request->input("name"),
            'description' => $request->input("description"),
        ]);
        $quiz->save();
        return $quiz;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return response("", 204); // 204 == no response
    }
}
