<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/quiz', 'HomeController@quiz')->name('quiz');

    Route::resource('/api/quizzes', 'QuizController');
    Route::resource('/api/quizzes/{quiz}/questions', 'QuestionController');
    Route::resource('/api/quizzes/{quiz}/questions/{question}/question_choices', 'QuestionChoiceController');
    Route::resource('/api/quizzes/{quiz}/quiz_attempts', 'QuizAttemptController');
    Route::resource('/api/quizzes/{quiz}/quiz_attempts/{quiz_attempt}/question_attempts', 'QuestionAttemptController');
});
