<?php

include 'vendor/autoload.php';

$cacheDir = __DIR__."/cache/";

$snappy = new \Knp\Snappy\Pdf(__DIR__ . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386');
$snappy->setOption('page-width', 5);
$snappy->setOption('page-height', 5);
$snappy->setOption('margin-bottom', 1);
$snappy->setOption('margin-left', 1);
$snappy->setOption('margin-right', 1);
$snappy->setOption('margin-top', 1);

$barcodeGen = new \Milon\Barcode\DNS1D;
$barcodeGen->setStorPath($cacheDir);

$items = [
    ['sku' => 'FIS-ENSB-150-GLS', 'barcode' => '5060182338846'],
    ['sku' => 'FIS-ENSB-300-GLS', 'barcode' => '5060182338839'],
    ['sku' => 'FIS-ENSB-BASE-GLS', 'barcode' => '5060182338853'],
    ['sku' => 'FIS-ENSB-150-MAT', 'barcode' => '5060182338792'],
    ['sku' => 'FIS-ENSB-300-MAT', 'barcode' => '5060182338808'],
    ['sku' => 'FIS-ENSB-BASE-MAT', 'barcode' => '5060182338785'],

    ['sku' => 'FIS-DYN-DUO-600-GLS-BLK', 'barcode' => '5060182338778'],
    ['sku' => 'FIS-DYN-DUO-600-MAT-BLK', 'barcode' => '5060182338761'],
    ['sku' => 'FIS-DYN-UNO-1000-GLS-BLK', 'barcode' => '5060182338822'],
    ['sku' => 'FIS-DYN-UNO-1000-MAT-BLK', 'barcode' => '5060182338815'],
    ['sku' => 'FIS-DYN-UNO-600-MAT-BLK', 'barcode' => '5060182338747']
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
