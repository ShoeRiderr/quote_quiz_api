<?php

declare (strict_types = 1);

namespace Src\Model;

use PDO;
use PDOException;

class Question extends BaseModel
{
    protected $table = 'questions';

    protected $fillable = [
        'content',
    ];

    public function getInRandomOrder(int $limit = 10)
    {
        $statement = "SELECT * FROM " . $this->table . " ORDER BY rand() LIMIT :limit;";

        try {
            $statement = $GLOBALS['dbConnection']->prepare($statement);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}
