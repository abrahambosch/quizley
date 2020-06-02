<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class QuizAttemptsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSubmitQuizAttempt()
    {
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->getJson('/api/quizzes/2/questions');
        $response->assertStatus(200);

        $json = <<<__THIS
{"quiz_id":"2","question_attempts":[{"question_id":4,"answer":"King Arthur"},{"question_id":5,"answer":"to seek the holy grail"},{"question_id":6,"answer":"WHat do you mean? Is that a European or African swallow?"}]}
__THIS;

        $response = $this->actingAs($user)->postJson('/api/quizzes/2/quiz_attempts', json_decode($json, true));
        $response->assertStatus(201);
    }
}
