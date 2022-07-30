<?php

declare (strict_types = 1);

namespace Src\Model;

use PDO;
use PDOException;

class BaseModel implements Modelnterface
{
    protected $findAllStatement;

    protected $findStatement;

    protected $insertStatement;

    protected $updateStatement;

    protected $deleteStatement;

    public function findAll()
    {
        try {
            $statement = $GLOBALS['dbConnection']->query($this->findAllStatement);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $statement = $GLOBALS['dbConnection']->prepare($this->findStatement);
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(array $input)
    {
        try {
            $statement = $GLOBALS['dbConnection']->prepare($this->insertStatement);
            $statement->execute($input);
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, array $input)
    {
        try {
            $statement = $GLOBALS['dbConnection']->prepare($this->updateStatement);
            $statement->execute($input);
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $statement = $GLOBALS['dbConnection']->prepare($this->deleteStatement);
            $statement->execute(['id' => $id]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}
