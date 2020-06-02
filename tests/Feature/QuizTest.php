<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class QuizTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testQuizListing()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->getJson('/api/quizzes');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testQuizCreate()
    {
        $user = factory(User::class)->create();

        $quizName = $this->faker->jobTitle();
        $quizDescription = $this->faker->paragraph();
        $response = $this->actingAs($user)->postJson('/api/quizzes', [
            'name' => $quizName,
            'description' => $quizDescription
        ]);
        $response->assertStatus(201)
            ->assertJsonPath("name", $quizName);

        $response = $this->actingAs($user)->getJson('/api/quizzes');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                "*" => ['name', "description"]
            ]
        ]);
        $response->assertJsonPath("data.0.name", $quizName);
//        $data = $response->baseResponse->content();
//        Log::debug(print_r(json_decode($data), true));
    }
}
