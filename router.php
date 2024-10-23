<?php 

require_once './libs/router.php';
require_once './app/controller/cars-controller.php';

$router = new Router();

$router->addRoute("vehicles", "GET", "CarsController", "getAll");
$router->addRoute("vehicles/:id", "GET", "CarsController", "get");
$router->addRoute("vehicles/:id", "PUT", "CarsController", "update");

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
