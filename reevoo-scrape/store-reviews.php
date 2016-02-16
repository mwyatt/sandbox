<?php

$reviews = json_decode(file_get_contents('./scraped-reviews.json'));
$sourceRowCount = count($reviews);

$credentials = [
	'database.host' => '',
	'database.port' => '',
	'database.basename' => 'store_1',
	'database.username' => 'root',
	'database.password' => '123'
];

$dataSourceName = [
    'mysql:host' => $credentials['database.host'],
    'dbname' => $credentials['database.basename'],
    'charset' => 'utf8'
];

foreach ($dataSourceName as $key => $value) {
    $dataSourceNameStrings[] = $key . '=' . $value;
}

$dataSourceName = implode(';', $dataSourceNameStrings);

$connection = new \PDO(
    $dataSourceName,
    $credentials['database.username'],
    $credentials['database.password']
);

$sql = ["INSERT INTO shop_products_review (
    isHappy,
    productId,
    customerName,
    customerLocation,
    comment,
    timeCreated
)
VALUES (
    ?,
    ?,
    ?,
    ?,
    ?,
    ?
    )"];
$sth = $connection->prepare(implode(' ', $sql));

$savedRowCount = 0;

foreach ($reviews as $review) {
    $sth->execute([
        $review->isHappy,
        $review->productId,
        $review->customerName,
        $review->customerLocation,
        $review->comment,
        $review->timeCreated
    ]);
    $savedRowCount += $sth->rowCount();
}

echo '<pre>';
print_r("source: $sourceRowCount");
print_r("saved: $savedRowCount");
echo '</pre>';
exit;
