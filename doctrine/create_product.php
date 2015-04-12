<?php
// create_product.php
require_once "bootstrap.php";

$product = new Product();
$product->setName($argv[1]);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";