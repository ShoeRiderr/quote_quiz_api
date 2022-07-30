<?php

declare (strict_types = 1);

namespace Src\Model;

interface Modelnterface
{
    public function findAll();
    public function find(int $id);
    public function insert(array $input);
    public function update(int $id, array $input);
    public function delete(int $id);
}
