<?php

$installDir = 'sandbox/aura-router/';
include 'vendor/autoload.php';
$router_factory = new \Aura\Router\RouterFactory;
$router = $router_factory->newInstance();

// add a simple named route without params
$router->add('home', '/');

$router->add('foo.bar-tree', '/product/{id}/')
    ->setValues(array(
        'controller' => 'Index',
        'method' => 'home'
    ));

// get the incoming request URL path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!empty($installDir)) {
	$path = str_replace($installDir, '', $path);
}

// get the route based on the path and server
$route = $router->match($path, $_SERVER);
$controller = '\\OriginalThing\\Controller\\' . $route->params['controller'];
$controller = new $controller;
$controller->{$route->params['method']}($route->params);
