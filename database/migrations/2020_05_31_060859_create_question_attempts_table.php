<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("quiz_attempt_id");
            $table->unsignedBigInteger("question_id");
            $table->unsignedBigInteger("question_choice_id")->nullable();
            $table->text("answer");
            $table->timestamps();
        });
        Schema::table('question_attempts', function (Blueprint $table) {
            $table->foreign('quiz_attempt_id')->references('id')->on('quiz_attempts');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('question_choice_id')->references('id')->on('question_choices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_attempts');
    }
}
