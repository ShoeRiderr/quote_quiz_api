<?php

use Src\Controller\Api\QuestionController;
use Src\Support\Router\Request;
use Src\Support\Router\Router;

$router = new Router(new Request);

/**
 * To define a route you need to pass route path as first element and callback or array with 
 * controller path as first element and the name of the controller method as the second.
 */

//Questions
$router->get('/api/questions', [QuestionController::class, 'index']);
$router->get('/api/questions-with-answers', [QuestionController::class, 'getWithAnswers']);
