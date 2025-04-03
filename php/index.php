<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/includes/Db.php';

$app = AppFactory::create();

// curl -X GET http://localhost:8080/alunni
$app->get('/alunni', "AlunniController:index");

// curl -X GET http://localhost:8080/alunni/1
$app->get('/alunni/{id:\d+}', "AlunniController:view");

//curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome":"claudio","cognome":"benve"}'
$app->post('/alunni', "AlunniController:create");

//curl -X PUT http://localhost:8080/alunni/4 -H "Content-Type: application/json" -d '{"nome":"claudio","cognome":"benve"}'
$app->put('/alunni/{id}', "AlunniController:update");
//curl -X DELETE http://localhost:8080/alunni/4 
$app->delete('/alunni/{id}', "AlunniController:destroy");
//curl -X GET http://localhost:8080/alunni/searchNome/parola
$app->get('/alunni/searchNome/{nome}', "AlunniController:searchN");

//curl -X GET http://localhost:8080/alunni/searchCognome/parola
$app->get('/alunni/searchCognome/{cognome}', "AlunniController:searchC");

//curl -X GET http://localhost:8080/alunni/order/parola
$app->get('/alunni/order/{col}', "AlunniController:order");

//curl -X GET http://localhost:8080/alunni/order/parola --con controllo
$app->get('/alunni/sort/{col}', "AlunniController:sort");


$app->run();
