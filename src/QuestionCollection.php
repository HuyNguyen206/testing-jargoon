<?php

namespace App;

class QuestionCollection implements \Countable
{
    public array $questions = [];
    public $correctAnswers = [];

    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    public function nextQuestion()
    {
        $question = current($this->questions);
        next($this->questions);
        
        return $question;
    }

    public function currentQuestion()
    {
        return current($this->questions);
    }

    public function count(): int
    {
        return count($this->questions);
    }
}
