<?php

include 'vendor/autoload.php';

$container = new \Pimple\Container;

$container['path.base'] = (string) __DIR__ . '/';

$container['cache'] = function ($container) {
	$fun = new stdClass;
	$fun->name = 'billy';
	$fun->age = 22;
	echo '<pre>';
	print_r('here');
	echo '</pre>';
	
    return $fun;
};

$cache = $container['cache'];
echo '<pre>';
print_r($cache);
$cache->name = 'steve';
print_r($container['cache']);
$cache->age = 50;
print_r($container['cache']);
$cache->age = 50;
echo '</pre>';
exit;
