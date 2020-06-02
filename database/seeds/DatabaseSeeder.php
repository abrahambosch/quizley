<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Quiz;
use App\Question;
use App\QuestionChoice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $faker = Faker::create();

        $user = factory(App\User::class)->create();

        $quiz = Quiz::create([
            'name' => 'Test for ' . $faker->jobTitle,
            'description' => $faker->sentence
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => 'What is 2 + 2?',
            'question_type' => 'TEXT',
            'question_answer' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => 'What is 5 x 5?',
            'question_type' => 'TEXT',
            'question_answer' => 25
        ]);

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question' => 'Whats the capital of New York State?',
            'question_type' => 'SELECT',
            'question_answer' => 'Albany'
        ]);

        QuestionChoice::create([
            'question_id' => $question->id,
            'choice' => 'Albany',
            'choice_value' => 'Albany'
        ]);
        QuestionChoice::create([
            'question_id' => $question->id,
            'choice' => 'New York',
            'choice_value' => 'New York'
        ]);

        //

        $quiz = Quiz::create([
            'name' => 'Test for Monty Python',
            'description' => "Stop! Who would cross the bridge of death must answer me these questions three. "
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => 'What is your name?',
            'question_type' => 'TEXT',
            'question_answer' => 8
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => 'What is your quest?',
            'question_type' => 'TEXT',
            'question_answer' => 36
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => 'What is the airspeed velocity of an unladen swallow?',
            'question_type' => 'TEXT',
            'question_answer' => ''
        ]);

    }
}
