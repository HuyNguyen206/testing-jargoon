<?php

namespace App;

use App\Exception\UnanswerQuestionException;

class Quiz
{
    public QuestionCollection $questionCollection;

    public function __construct()
    {
        $this->questionCollection = new QuestionCollection();
    }

    public function grade()
    {
        $answerQuestions = array_filter($this->questionCollection->questions, fn($question) => $question->isAnswered);
        if ($this->isNotCompleted($answerQuestions)) {
            throw new UnanswerQuestionException('All questions need to be answered!');
        }

        $this->questionCollection->correctAnswers = array_filter($this->questionCollection->questions, fn($question) => $question->isCorrect);

        return $this->getPoints();
    }

    /**
     * @return float|int
     */
    public function getPoints(): int|float
    {
        return round(count($this->questionCollection->correctAnswers) / count($this->questionCollection)) * 100;
    }

    /**
     * @param mixed $answerQuestions
     * @return bool
     */
    public function isNotCompleted(mixed $answerQuestions): bool
    {
        return count($answerQuestions) < count($this->questionCollection);
    }
}
