<?php

declare (strict_types = 1);

namespace Src\Model;

class Question extends BaseModel
{
    protected $table = 'questions';

    protected $fillable = [
        'content',
    ];
}
