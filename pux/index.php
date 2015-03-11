<?php

define('BASE_PATH', (string) (__DIR__ . '/'));
require 'vendor/autoload.php'; // use PCRE patterns you need Pux\PatternCompiler class.
use Pux\Executor;

$mux = new Pux\Mux;

// admin content
$mux->get('/admin/:type/', ['AppName\\Controller\\Content', 'all']);
$mux->get('/admin/:type/:id/', ['AppName\\Controller\\Content', 'single']);
$mux->get('/admin/:type/create/', ['AppName\\Controller\\Content', 'create']);
$mux->post('/admin/:type/create/', ['AppName\\Controller\\Content', 'singleUpdate']);
$mux->post('/admin/:type/:id/', ['AppName\\Controller\\Content', 'singleUpdate']);
$mux->delete('/admin/:type/:id/', ['AppName\\Controller\\Content', 'delete']);

// home
$mux->any('/', ['AppName\\Controller\\Index', 'home']);

// asset
$mux->get('asset/:path', ['AppName\\Controller\\Asset', 'single'], [
    'require' => ['path' => '.+']
]);

echo '<pre>';
print_r($mux->getRoutes());
echo '</pre>';
exit;


$route = $mux->dispatch('/admin/post/create/');

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
