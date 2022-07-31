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
            exit($e->getMessage());
        }
    }

    public function getWithAnswers()
    {
        $limit = $_GET['limit'] ? intval($_GET['limit']) : 10;

        try {
            $questions = (new Question)->getInRandomOrder($limit);
            $answer = new Answer();
            $questions = array_map(function ($question) use ($answer) {
                $question['answers'] = $answer->findByQuestionId((int) $question['id']);

                return $question;
            }, $questions);

            return json_encode($questions);
        } catch (Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function create()
    {
        try {
            $question = new Question;
            $answer = new Answer;

            $question->insert([
                'content' => $_POST['content'],
            ]);

            foreach ($_POST['answers'] as $record) {
                $answer->insert([
                    'content' => $record['content'],
                    'question_id' => $question['id'],
                    'is_correct' => $record['is_correct'],
                ]);
            }

            return 'Success!';
        } catch (Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function update($id)
    {
        try {
            $question = new Question;

            $question->update($id, [
                'content' => $_POST['content'],
            ]);

            return 'Success!';
        } catch (Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
