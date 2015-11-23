<?php

// The $route contains [ pcre (boolean), path (string), callback (callable), options (array) ]

include 'vendor/autoload.php';

// included files rely on mux being there
// always mount at the end
$mux = new \Pux\Mux;
$mux->get('/', ['\\PackageName\\Controller\\Index', 'home'], ['id' => 'home']);
$mux->get('/product/:name/:id/', ['\\PackageName\\Controller\\Index', 'product'], ['id' => 'product.single']);
$mux->post('/product/:name/:id/', ['\\PackageName\\Controller\\Index', 'product'], ['id' => 'product.single']);

$muxBar = new \Pux\Mux;
$muxBar->get('/bar/', ['\\PackageName\\Controller\\Index', 'bar'], ['id' => 'foo.bar']);
$muxBar->get('/bar/do/', ['\\PackageName\\Controller\\Index', 'bar'], ['id' => 'foo.bar.do']);

$mux->mount('/foo', $muxBar);

$mux->get('/asset/:path', ['\\PackageName\\Controller\\Index', 'asset'], ['id' => 'asset.single', 'require' => ['path' => '.+']]);

// 
$urlRoutes = [];
foreach ($mux->getRoutes() as $route) {
    $urlRoutes[$route[3]['id']] = empty($route[3]['pattern']) ? $route[1] : $route[3]['pattern'];
}

$route = $mux->dispatch('/asset/ok/something.jpg');

// auth
$path = empty($route[3]['pattern']) ? $route[1] : $route[3]['pattern'];
if (strpos($path, 'admin/')) {
    echo '<pre>';
    print_r('do auth');
    echo '</pre>';
}

$response = \Pux\Executor::execute($route);
echo '<pre>';
print_r($response);
echo '</pre>';
exit;
