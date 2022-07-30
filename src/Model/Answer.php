<?php

declare (strict_types = 1);

namespace Src\Model;

class Answer extends BaseModel
{
    protected $findAllStatement = "SELECT * FROM answers;";

    protected $findStatement = "SELECT * FROM answers WHERE id = ?;";

    protected $insertStatement = "INSERT INTO answers (content, question_id, is_correct) VALUES (:content, :question_id, :is_correct);";

    protected $updateStatement = "UPDATE answers
        SET
            content = :content,
            question_id = :question_id,
            is_correct = :is_correct
        WHERE id = :id;";

    protected $deleteStatement = "DELETE FROM answers WHERE id = :id;";
}
