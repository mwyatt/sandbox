<?php

include 'vendor/autoload.php';
$router_factory = new \Aura\Router\RouterFactory;
$router = $router_factory->newInstance();
$routes = [
    'foo.bar' => [
        'type' => 'get',
        'path' => 'foo/{bar}/',
        'controller' => 'Index',
        'method' => 'home'
    ]
];

// add a simple named route without params
foreach ($routes as $id => $route) {
    $router->add($id, $route['path'])->setValues($route);
}

$router
	->add('foo.bar-tree', '/product/{id}/')
    ->setValues(array(
        'controller' => 'Index',
        'method' => 'foo'
    ));

// get the incoming request URL path
$installDir = 'sandbox/aura-router/';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!empty($installDir)) {
	$path = str_replace($installDir, '', $path);
}

// get the route based on the path and server
if (!$route = $router->match($path, $_SERVER)) {
	// 404
	
}

$controller = '\\OriginalThing\\Controller\\' . $route->params['controller'];
$controller = new $controller;
$controller->{$route->params['method']}($route->params);





call_user_func_array(function($name = 'sample', $id = 1) {
    echo '<pre>';
    print_r($name);
    print_r($id);
    echo '</pre>';
    exit;
    
}, [/*'foo' => 'bar', 'name' => 'mr music', 'id' => 290*/]);
