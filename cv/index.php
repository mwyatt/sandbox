<?php 

if (! isset($_GET['name'])) {
	exit('name GET needed');
}
$name = $_GET['name'];
$nameDir = $name . '/';

/**
 * resources
 * @var array
 */
$panels = json_decode(file_get_contents($nameDir . 'cv.json'));
$config = json_decode(file_get_contents($nameDir . 'config.json'));


/**
 * view
 */
include('CV - html.php');
