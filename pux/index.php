<?php

define('BASE_PATH', (string) (__DIR__ . '/'));
require 'vendor/autoload.php'; // use PCRE patterns you need Pux\PatternCompiler class.
use Pux\Executor;

$mux = new Pux\Mux;
$mux->get('/', ['AppName\\Controller\\Index', 'home']);
$mux->get('/admin/', ['AppName\\Controller\\Index', 'home']);
$muxContent = new Pux\Mux;
$muxContent->get('/:type/', ['AppName\\Controller\\Content', 'all']);
$mux->mount('/admin', $muxContent);

$route = $mux->dispatch('/admin/');

// route
try {
    echo Executor::execute($route);
} catch (Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
}

exit;


// example generator plan
// normal get routes can be defined here
// this is to aid the url generator
$plans = [
    'content/all' => [
        'path' => '/:type/',
        'controller' => ['AppName\\Controller\\Content', 'all']
    ],
    'content/single' => [
        'path' => '/:type/',
        'controller' => ['AppName\\Controller\\Content', 'single']
    ]
];


/**
 * builds a url based on the plans stored
 * @param  string $key    
 * @param  array $config key, value
 * @return string         url/path/
 */
function getUrl($key, $config)
{
    $path = $this->getPath();
    foreach ($config as $key => $value) {
        $path = str_replace(':' . $key, $value, $path);
    }
    return $path;
}

// template
$this->getUrl('content/all', ['type' => 'post']);

// during controller process
$this->redirect('content/all', ['type' => 'post']);

$this->response('html', 200);


function response($string, $code = 200)
{
    // set code here?
    return $string;
}
