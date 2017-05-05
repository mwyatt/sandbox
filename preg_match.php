<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$requestType = empty($_POST) ? 'get' : 'post';
$request = '/post/example-thing/';
$routes = [];
$routes[] = ['get', '/post/:slug/', '\\Acmefg\\Appraisal\\Controller::postSingle', ['rules' => ['slug' => '.?'], 'id' => 'fooBar', 'middleware' => ['common']]];
$routeCandidates = [];

foreach ($routes as $key => $route) {
    if ($requestType == $route[0]) {
        $routeCandidates = $route;
    }
}
foreach ($routeCandidates as $route) {
    
}

preg_match('/profile/:id/', '/profile/20/', $result);

echo '<pre>';
print_r($result);
echo '</pre>';
exit;

// swap out :thing for rules, if no rule then use mega matcher
