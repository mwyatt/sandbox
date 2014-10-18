<?php

include 'vendor/autoload.php';

use Martin\Sumo;

$system = new Martin\Sumo\System();
echo '<pre>';
print_r($system);
echo '</pre>';
exit;


// use Orno\Http\Request;
// use Orno\Http\Response;

// $router = new Orno\Route\RouteCollection;

// $router->addRoute('unique', '/acme/route', function (Request $request, Response $response) {
//     // do some clever shiz
//     return $response;
// });

// $dispatcher = $router->getDispatcher();

// $response = $dispatcher->dispatch('GET', '/acme/route');

// $response->send();
