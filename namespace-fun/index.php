<?php

include 'vendor/autoload.php';

$system = new Sumo\System();
$controller = new Sumo\Site\Avo\Controller\Index();
$controller->test();
echo '<pre>';
print_r($controller);
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
