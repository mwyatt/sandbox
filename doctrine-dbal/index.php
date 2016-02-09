<?php

include 'vendor/autoload.php';

class Dude
{

	const TABLE = 'ok';

	protected $id;
}

$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
    'dbname' => 'test_1',
    'user' => 'root',
    'password' => '123',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$statement = $conn->prepare('SELECT * FROM shop_brands');
$statement->execute();
$brands = $statement->fetchAll(\PDO::FETCH_CLASS, '\\Dude');
echo '<pre>';
print_r($brands);
echo '</pre>';
exit;

$queryBuilder = $conn->createQueryBuilder();
$queryBuilder
    ->select('*')
    ->from('dude');

$queryBuilder
    ->select('*')
    ->from('dude')
    ->where("id = ?")
    ->setParameter(0, 'hi');





echo '<pre>';
print_r($queryBuilder->getSQL());
echo '</pre>';
exit;

$huh = $conn->update('foo', array('name' => 'boop'), array('id' => 2));

echo '<pre>';
print_r($huh);
echo '</pre>';
exit;
