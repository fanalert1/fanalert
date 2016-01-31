<?php


require_once(__DIR__ . '/vendor/autoload.php');

//use MongoDB\Client;
//phpinfo();

$client = new MongoDB\Client;

$collection = (new MongoDB\Client)->firedb->config;

$document = $collection->find();
var_dump($document);

//$result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
//var_dump($result);


?>