<?php

namespace Tests;

use App\Exception\UnanswerQuestionException;
use App\Question;
use App\Quiz;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    protected Quiz $quiz;

    protected function setUp(): void
    {
      $this->quiz = new Quiz();
    }

    /**
     * @return void
     */
    public function test_it_consist_of_questions()
    {
        $this->quiz->questionCollection->addQuestion(new Question('What is 2 + 2?', 4));

        $this->assertCount(1, $this->quiz->questionCollection);
    }

    public function test_it_can_graded_perfect_quiz()
    {
        $this->quiz->questionCollection->addQuestion(new Question('What is 2 + 2?', 4));

        $question = $this->quiz->questionCollection->nextQuestion();
        $question->answer(4);

        $this->assertEquals(100, $this->quiz->grade());
    }

    public function test_it_can_graded_fail_quiz()
    {
        $this->quiz->questionCollection->addQuestion(new Question('What is 2 + 2?', 4));

        $question = $this->quiz->questionCollection->nextQuestion();
        $question->answer(2);

        $this->assertEquals(0, $this->quiz->grade());
    }

    public function test_it_can_track_correctly_the_next_question_in_the_queue()
    {
        $this->quiz->questionCollection->addQuestion($firstQuestion = new Question('What is 2 + 2?', 4));
        $this->quiz->questionCollection->addQuestion($nextQuestion = new Question('What is 1 + 4?', 5));
//
//        $question = $this->>quiz->$this->questionCollection->nextQuestion();
//        $question->answer(4);

        $this->assertEquals($firstQuestion, $this->quiz->questionCollection->nextQuestion());
        $this->assertEquals($nextQuestion, $this->quiz->questionCollection->nextQuestion());
    }

    public function test_it_can_return_null_if_the_current_question_is_the_last_in_the_queue()
    {
        $this->quiz->questionCollection->addQuestion($firstQuestion = new Question('What is 2 + 2?', 4));
        $this->quiz->questionCollection->addQuestion($nextQuestion = new Question('What is 1 + 4?', 5));
//
//        $question = $this->>quiz->$this->questionCollection->nextQuestion();
//        $question->answer(4);

        $this->assertEquals($firstQuestion, $this->quiz->questionCollection->nextQuestion());
        $this->assertEquals($nextQuestion, $this->quiz->questionCollection->nextQuestion());
        $this->assertEquals(null, $this->quiz->questionCollection->nextQuestion());
    }

    public function test_it_can_not_grade_until_all_the_question_in_the_queue_were_resolved()
    {
        $this->quiz->questionCollection->addQuestion(new Question('What is 2 + 2?', 4));
        $this->quiz->questionCollection->addQuestion($nextQuestion = new Question('What is 1 + 4?', 5));
        $this->quiz->questionCollection->addQuestion($anotherNextQuestion = new Question('What is 2 * 2?', 4));
//
        $question = $this->quiz->questionCollection->nextQuestion();
        $question->answer(4);

        $this->expectException(UnanswerQuestionException::class);

        $this->quiz->grade();
    }

}
