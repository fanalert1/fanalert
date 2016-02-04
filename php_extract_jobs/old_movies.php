<?php

require_once(__DIR__ . '/vendor/autoload.php');

$client = new MongoDB\Client;
$movies_collection = (new MongoDB\Client)->firedb->movies;
$events_collection = (new MongoDB\Client)->firedb->events;

date_default_timezone_set("Asia/Calcutta");//SETTING TIME ZONE TO INDIA

$result = $movies_collection->find(array('type' => array('$in' => array("running","upcoming"))));

$current=date("Y/m/d H:i:s");

foreach($result as $key=> $document)
{
    $temp = json_encode($document);
    $json = json_decode($temp , true);

    $update=date_create($json["update_ts"]);
    $current=date_create(date("Y/m/d H:i:s"));
    $diff=date_diff($update,$current);
    $difference=$diff->format("%a");

    if($difference>2)
    {
        //echo $json["update_ts"]."--".$json["name"]."\n"; 
        $type="closed";
        $movies = $movies_collection->updateOne(
            ['name' => $json["name"]],
            ['$set' => array("type" => $type,"close_ts" => $current_ts)],
            ['upsert' => true]);
        
        $events = $events_collection->insertOne(
            array("movies_id"=>$json["id"],"event_type" => $type,"notify"=> 'true',"insert_ts" => $current_ts ));
    }
    
}
?>