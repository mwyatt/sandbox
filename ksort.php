<?php

$images = [];
$images[2] = 'hi';
$images[22] = 'hi';
$images[15] = 'hi';
$images[10] = 'hi';

ksort($images);

echo '<pre>';
print_r($images);
echo '</pre>';
exit;
