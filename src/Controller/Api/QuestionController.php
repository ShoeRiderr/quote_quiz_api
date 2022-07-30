<?php

declare (strict_types = 1);

namespace Src\Controller\Api;

use Src\Model\Answer;
use Src\Model\Question;
use Throwable;

class QuestionController
{
    public function index()
    {
        try {
            $questions = (new Question)->findAll();

            return json_encode($questions);
        } catch (Throwable $e) {
            var_dump($e);
        }
    }

    public function getWithAnswers()
    {
        try {
            $questions = (new Question)->findAll();
            $questions = array_map(function ($question) {
                $question['answers'] = Answer::findByQuestionId((int) $question['id']);

                return $question;
            }, $questions);

            return json_encode($questions);
        } catch (Throwable $e) {
            var_dump($e);
        }
    }
}
