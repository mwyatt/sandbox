<?php

require 'vendor/autoload.php';

$url = \League\Url\Url::createFromUrl('http://192.168.1.185/foo/bar/');

echo '<pre>';
print_r($url);
print_r($url->getQuery());
print_r($url->getRelativeUrl());
print_r($url->getBaseUrl());
echo '</pre>';
exit;
