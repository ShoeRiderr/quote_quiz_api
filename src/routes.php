<?php

use Src\Controller\Api\QuestionController;
use Src\Support\Router\Request;
use Src\Support\Router\Router;

$router = new Router(new Request);

//Questions
$router->get('/questions', [QuestionController::class, 'index']);
$router->get('/questions-with-answers', [QuestionController::class, 'getWithAnswers']);
