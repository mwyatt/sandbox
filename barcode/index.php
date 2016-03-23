<?php

include 'vendor/autoload.php';

$cacheDir = __DIR__."/cache/";

$snappy = new \Knp\Snappy\Pdf(__DIR__ . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386');
$snappy->setOption('margin-bottom', 2);
$snappy->setOption('margin-left', 2);
$snappy->setOption('margin-right', 2);
$snappy->setOption('margin-top', 5);
$snappy->setOption('page-width', 70);
$snappy->setOption('page-height', 40);

$barcodeGen = new \Milon\Barcode\DNS1D;
$barcodeGen->setStorPath($cacheDir);

$items = [
    ['sku' => 'FIS-JJI-200', 'barcode' => '5060182330833']
];

foreach ($items as $item) {
    ob_start();

    $barcode = $barcodeGen->getBarcodeSvg($item['barcode'], "EAN13", 2, 75);
    
    include 'barcode.php';

    $snappy->generateFromHtml(ob_get_contents(), $cacheDir . $item['sku'] . '.pdf');

    ob_end_clean();
}

echo "done! (perhaps)";


// $snappy = new \Knp\Snappy\Pdf('/usr/local/bin/wkhtmltopdf');
// $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', $cacheDir . 'bill-123.pdf');

// header('Content-Type: application/pdf');
// header('Content-Disposition: attachment; filename="file.pdf"');
// echo $snappy->getOutput(array('https://192.168.2.101/sandbox/barcode/?code=5060182338778&sku=HT-12322-22'));














// or

// $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
