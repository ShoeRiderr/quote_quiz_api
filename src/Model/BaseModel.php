<?php

declare (strict_types = 1);

namespace Src\Model;

use PDO;
use PDOException;

class BaseModel implements Modelnterface
{
    protected $table;

    protected $fillable = [];

    public function findAll()
    {
        $statement = "SELECT * FROM " . $this->table . ";";

        try {
            $statement = $GLOBALS['dbConnection']->query($statement);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        $statement = "SELECT * FROM " . $this->table . " WHERE id = ?;";

        try {
            $statement = $GLOBALS['dbConnection']->prepare($statement);
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(array $input)
    {
        $statement = "INSERT INTO " . $this->table . " (" . implode(', ', $this->fillable) . ") VALUES (:" . implode(', :', $this->fillable) . ");";

        try {
            $statement = $GLOBALS['dbConnection']->prepare($statement);
            $statement->execute($input);
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, array $input)
    {
        $modelFields = array_map(function ($column) {
            return sprintf('%s = :%s', $column, $column);
        }, $this->fillable);

        $statement = "UPDATE " . $this->table . " SET " . implode(', ', $modelFields) . " WHERE id = :id;";

        try {
            $statement = $GLOBALS['dbConnection']->prepare($statement);
            $statement->execute(array_merge(['id' => $id], $input));
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $statement = "DELETE FROM " . $this->table . " WHERE id = :id;";

        try {
            $statement = $GLOBALS['dbConnection']->prepare($statement);
            $statement->execute(['id' => $id]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}
