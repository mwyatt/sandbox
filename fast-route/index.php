<?php

include 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    include 'routes.php';
    foreach ($routes as $route) {
        $r->addRoute('GET', '/sandbox/fast-route/', 'homeindex');
    }
    // $r->addRoute('GET', '/sandbox/fast-route/', 'homeindex');
    // $r->addRoute('GET', '/sandbox/fast-route/users', 'get_all_users_handler');
    // $r->addRoute('GET', '/sandbox/fast-route/user/{id:\d+}/', ['various', 'options']);
    // $r->addRoute('GET', '/sandbox/fast-route/articles/{id:\d+}/[{title}/]', 'get_article_handler');
    // $r->addRoute('GET', '/sandbox/fast-route/asset/{path:.*}', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

echo '<pre>';
print_r($routeInfo);
echo '</pre>';
exit;

// url generate
// find all {key:.*} and replace with value
