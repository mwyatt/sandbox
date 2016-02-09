<?php

include 'vendor/autoload.php';

try {
    var_dump(\Assert\Assertion::numeric('123'));
} catch (\Assert\AssertionFailedException $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
	exit;
}
