<?php
session_start();
require 'vendor/autoload.php';


$publicRoutes = ['auth/login', 'auth/registration'];

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

//checks if the value of $action exists in the $publicRoutes array.
if (!in_array($action, $publicRoutes) && !isset($_SESSION['email'])) {
    header('Location: ./auth/login.php');
    exit;
}


$routes = [
    //auth
    'auth/login' => ['controller' => 'App\Controllers\AuthController', 'method' => 'processLogin'],
    'auth/registration' => ['controller' => 'App\Controllers\AuthController', 'method' => 'processRegistration'],
    'auth/logout' => ['controller' => 'App\Controllers\AuthController', 'method' => 'processLogout'],

    //items
    'items/create' => ['controller' => 'App\Controllers\ItemController', 'method' => 'create'], 
    'index' => ['controller' => 'App\Controllers\ItemController', 'method' => 'index'],
    'items/update' => ['controller' => 'App\Controllers\ItemController', 'method' => 'update'],
    'items/delete' => ['controller' => 'App\Controllers\ItemController', 'method' => 'delete'],

    //category
    'category/index' => ['controller' => 'App\Controllers\CategoryController', 'method' => 'index'],
    'category/create' => ['controller' => 'App\Controllers\CategoryController', 'method' => 'categoryCreate'],
    'category/update' => ['controller' => 'App\Controllers\CategoryController', 'method' => 'categoryUpdate'],
    'category/delete' => ['controller' => 'App\Controllers\CategoryController', 'method' => 'categoryDelete'],
];

try{

// Check if the action exists in the routes
if (array_key_exists($action, $routes)) {
    $controllerName = $routes[$action]['controller'];
    $methodName = $routes[$action]['method'];

    if(!class_exists($controllerName)){
        throw new Exception($controllerName. ' class not found');
    }

    $controller = new $controllerName();

    if(!method_exists($controller, $methodName)){
        throw new Exception('Method not found');
    }
        $controller->$methodName();
} else {
        // Action not found - send 404 header and show 404 page
        http_response_code(404);
        require_once './views/404.php';
        exit;
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(404);
    require_once './views/404.php';
    exit;
}

