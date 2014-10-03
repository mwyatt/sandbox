<?php 


/**
 * resources
 * @var array
 */
$panels = json_decode(file_get_contents('cv.json'));


/**
 * view
 */
include('CV - html.php');
