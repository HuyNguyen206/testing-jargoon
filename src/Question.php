<?php

namespace App;

class Question
{
    public $isCorrect = false;
    public $isAnswered = false;

    public function __construct(protected string $question, protected string $solution)
    {

    }

    public function answer($answer)
    {
        $this->isAnswered = true;

        return $this->isCorrect = $this->solution == $answer;
    }



}
