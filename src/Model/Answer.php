<?php

declare (strict_types = 1);

namespace Src\Model;

use PDO;
use PDOException;

class Answer extends BaseModel
{
    protected $table = 'answers';

    protected $fillable = [
        'content',
        'question_id',
        'is_correct',
    ];

    public function findByQuestionId(int $questionId)
    {
        $statement = "SELECT * FROM answers WHERE question_id = :question_id;";

        try {
            $statement = $GLOBALS['dbConnection']->prepare($statement);
            $statement->execute([
                'question_id' => $questionId,
            ]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}
