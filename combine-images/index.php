<?php


define('BASE_PATH', (string) (__DIR__ . '/'));


function merge($paths, $pathNew) {

	// no need to build
	if (file_exists($pathNew)) {
		return;
	}

	// resource
	$widthHeight = 130;
	$tabX = 0 - $widthHeight;
	$columns = 2;
	$column = 0;
	$totalWidth = $widthHeight * count($paths);

	// create new image with desired dimensions
	$imageNew = imagecreatetruecolor($totalWidth, $widthHeight);

	// sets background
	$backgroundColor = imagecolorallocate($imageNew, 255, 255, 255);
	imagefill($imageNew, 0, 0, $backgroundColor);

	// create instances of the existing images and copy into the new image
	foreach ($paths as $path) {
		$tabX += $widthHeight;
		
		$tabY = $column * $widthHeight;
		$image = imagecreatefromjpeg($path);
		imagecopy($imageNew, $image, $tabX, $tabY, 0, 0, $widthHeight, $widthHeight);
		imagedestroy($image);
	}

	// save the resulting image to disk
	imagejpeg($imageNew, $pathNew);
}

$newThing = 'merged-fun.jpg';
merge(
	[
		'zensor1_5-1_black_s_1.jpg',
		'aqcablepk_s_1.jpg',
		'rx-a2030-blk_small_1.jpg'
	],
	$newThing
);

// output
$type = 'image/jpeg';
header('Content-Type:' . $type);
header('Content-Length: ' . filesize($newThing));
readfile($newThing);
