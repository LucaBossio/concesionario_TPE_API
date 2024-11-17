<?php 

require_once './libs/router.php';
require_once './app/controller/cars-api-controller.php';
require_once './app/controller/user-api-controller.php';
require_once './app/middleware/jwt-auth-middleware.php';

$router = new Router();

$router->addMiddleware(new JWTAuthMiddleware());

$router->addRoute("vehicles", "GET", "CarsController", "getAll");
$router->addRoute("vehicles/:id", "GET", "CarsController", "get");
$router->addRoute("vehicles/:id", "PUT", "CarsController", "update");
$router->addRoute("vehicles", "POST", "CarsController", "addCar");

$router->addRoute("usuario/token", "GET", "UserApiControler", "getToken");

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
