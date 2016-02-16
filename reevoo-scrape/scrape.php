<h1>Reevooalizer</h1>

<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

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

$sql = ["select * from shop_products_idsku"];
$sth = $connection->query(implode(' ', $sql));

$products = $sth->fetchAll();

// echo '<pre>';
// print_r('+--------------+------------------+------+-----+---------+----------------+
// | Field        | Type             | Null | Key | Default | Extra          |
// +--------------+------------------+------+-----+---------+----------------+
// | id           | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
// | isHappy      | int(1)           | YES  |     | NULL    |                |
// | productId    | int(11) unsigned | NO   |     | NULL    |                |
// | orderId      | int(11)          | YES  |     | NULL    |                |
// | customerName | varchar(100)     | YES  |     | NULL    |                |
// | timeCreated  | int(11) unsigned | NO   |     | NULL    |                |
// | comment      | longtext         | YES  |     | NULL    |                |
// +--------------+------------------+------+-----+---------+----------------+
// ');
// echo '</pre>';

include 'vendor/autoload.php';

// read cache
$data = file_get_contents('./cache-done.json');
$cacheDone = json_decode($data);

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// find next product
foreach ($products as $product) {
	if (empty($nextProduct)) {
		if (!in_array($product['id'], $cacheDone)) {
			$nextProduct = $product;
			$cacheDone[] = $product['id'];
		}
	}
}

if (empty($nextProduct)) {
	exit('all products done');
}

curl_setopt($curl, CURLOPT_URL, 'https://mark.reevoo.com/reevoomark/en-GB/product?sku=' . $nextProduct['sku'] . '&trkref=ADU&__utma=1.1454805203.1454606511.1455037013.1455121305.11&__utmb=1.17.9.1455122892978&__utmc=1&__utmx=-&__utmz=1.1455121305.11.6.utmcsr=header%2Bnav%2Bfeatured%2Bproduct|utmccn=header%20nav%20featured%20product|utmcmd=referral|utmcct=Wireworld%20Luna%207%20Bi-Wire%20Speaker%20Cable&__utmv=-&__utmk=72350739');
$html = curl_exec($curl);

$delay = rand(3,6);

// unable to find skip
if (strpos($html, "Sorry, we can't find what you're looking for.")) {
	header('location:https://192.168.2.101/sandbox/reevoo-scrape/scrape.php');
}

$document = phpQuery::newDocument($html);

// $reviews = json_decode(file_get_contents('./scraped-reviews.json'));
$reviews = [];

foreach ($document['[id^="review_].reevoo_review'] as $article) {
	$article = pq($article);
	$rating = $article['.rating .value']->html() + 0;
	$comment = trim($article['dd.pros']->html());
	$timeCreated = strtotime($article['.date_publish']->html());

	$reviews[] = [
		'rating' => $rating,
		'productId' => $nextProduct['id'],
		'customerName' => trim($article['.attribution-name']->html()),
		'customerLocation' => trim($article['.location']->html()),
		'comment' => strpos($comment, 'Reviewer left no comment') !== false ? null : $comment,
		'timeCreated' => $timeCreated === false ? null : $timeCreated
	];
}

// store reviews in db
$sql = ["INSERT INTO shop_products_review (
    rating,
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
        $review['rating'],
        $review['productId'],
        $review['customerName'],
        $review['customerLocation'],
        $review['comment'],
        $review['timeCreated']
    ]);
    $savedRowCount += $sth->rowCount();
}

// remember what was done
file_put_contents('./cache-done.json', json_encode($cacheDone, JSON_PRETTY_PRINT));

// how many left?
$productsRemainingCount = 0;
foreach ($products as $product) {
	if (!in_array($product['id'], $cacheDone)) {
		$productsRemainingCount++;
	}
}

?>

<script>
	var delay = <?php echo $delay ?> * 1000;
	setTimeout(function() {
		window.location.href = 'https://192.168.2.101/sandbox/reevoo-scrape/scrape.php';
	}, delay);
</script>

<p><strong>product id</strong> <?php echo $nextProduct['id'] ?></p>
<p><strong>product sku</strong> <?php echo $nextProduct['sku'] ?></p>
<p><strong>scraped rows</strong> <?php echo count($reviews) ?></p>
<p><strong>saved rows</strong> <?php echo $savedRowCount ?></p>
<p><strong>rows left</strong> <?php echo $productsRemainingCount ?></p>
