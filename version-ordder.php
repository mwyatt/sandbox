<?php

$curr = $_GET['curr'];

$arr = [
	'0.0.1',
	'0.0.2',
	'0.0.3',
	'0.0.7',
	'0.1.7'
];

foreach ($arr as $ar) {
	if ($ar > $curr) {
		var_dump($ar);

	}
}
