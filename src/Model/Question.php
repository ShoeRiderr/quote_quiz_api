<?php

declare (strict_types = 1);

namespace Src\Model;

class Question extends BaseModel
{
    protected $findAllStatement = "SELECT * FROM questions;";

    protected $findStatement = "SELECT * FROM questions WHERE id = ?;";

    protected $insertStatement = "INSERT INTO questions (content) VALUES (:content);";

    protected $updateStatement = "UPDATE questions SET content = :content WHERE id = :id;";

    protected $deleteStatement = "DELETE FROM questions WHERE id = :id;";
}
