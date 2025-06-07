<?php
session_start();

$route = $_GET['route'] ?? 'home';
$routes = require __DIR__ . '/config/routes.php';

// Autocarga simple de controladores
foreach ([
    'HomeController',
    'FormController',
    'AuthController'
] as $ctrl) {
    require_once __DIR__ . "/app/controllers/{$ctrl}.php";
}

if (isset($routes[$route])) {
    [$controllerName, $methodName] = $routes[$route];
    if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
        $controller = new $controllerName();
        $controller->$methodName();
        exit;
    }
}

http_response_code(404);
echo "<h1>Error 404: Página no encontrada</h1>";
