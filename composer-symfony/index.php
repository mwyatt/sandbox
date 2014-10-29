<?php

include 'vendor/autoload.php';

use Orno\Http\Request;
use Orno\Http\Response;

$router = new Orno\Route\RouteCollection;

$router->addRoute('unique_key', '/acme', function (Request $request, Response $response) {
    $response->setContent('unique_key');
    return $response;
});

$router->addRoute('another_key', '/acme/{id}', function (Request $request, Response $response, $args) {
	echo '<pre>';
	print_r($args);
	echo '</pre>';
	exit;
	
    $response->setContent('another_key');
    return $response;
});

$dispatcher = $router->getDispatcher();

$uri = str_replace('/github/sandbox/composer-symfony', '', $_SERVER['REQUEST_URI']);

try {
	$response = $dispatcher->dispatch('unique_key', $uri);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
	exit;
	
}

$response->send();
