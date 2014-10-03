<?php 
    // 130
    // 338
    // 770

    'images' => Array
        (
            '0' => Array
                (
                    'pid' => 2704
                    'type' => image
                    'url' => media/example_image_small_1.png
                    'title' => example_image_small_1
                )

            '1' => Array
                (
                    'pid' => 2704
                    'type' => image
                    'url' => media/Desert.jpg
                    'title' => Desert
                )

            '2' => Array
                (
                    'pid' => 2704
                    'type' => image
                    'url' => media/Koala.jpg
                    'title' => Koala
                )

        )

$images[] = 'http://192.168.1.135/images-skin/small.jpg';
$images[] = 'http://192.168.1.135/images-skin/medium.jpg';
$images[] = 'http://192.168.1.135/images-skin/large.jpg';
$images[] = 'http://192.168.1.135/images-skin/misc.png';

foreach ($images as $image) {
    list($width, $height, $type, $attr) = getimagesize($image);
    if ($type == 3 /*png*/) {
        $gallery['misc'][] = $image;
    } elseif ($width > 769) {
        $gallery['large'][] = $image;
    } elseif ($width > 337) {
        $gallery['medium'][] = $image;
    } elseif ($width > 0) {
        $gallery['small'][] = $image;
    }
}

echo '<pre>';
print_r($gallery);
echo '</pre>';
