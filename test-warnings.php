<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


trigger_error('hi there error', E_USER_NOTICE);

$emptyArray = [];

foreach ($emptyArray as $thing) {
	echo '<pre>';
	print_r($thing);
	echo '</pre>';
	exit;
	
}

echo '<pre>';
print_r('hi');
echo '</pre>';
exit;
