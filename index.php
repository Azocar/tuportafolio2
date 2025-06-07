<?php
session_start();

// Sugerencia: Si usas Apache, agrega un .htaccess para redirigir todas las rutas a index.php
// RewriteEngine On
// RewriteCond %{REQUEST_FILENAME} !-f
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteRule ^ index.php [QSA,L]

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
echo "<h1 style='color:#e53935;text-align:center;margin-top:60px;font-family:Montserrat,sans-serif;'>Error 404: Página no encontrada</h1>";
