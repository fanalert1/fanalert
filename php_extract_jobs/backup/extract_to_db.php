<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$crawler = $client->request('GET', 'http://www.ticketnew.com/Movie-Ticket-Online-booking/C/Chennai');
$running_movies=array();
$key="";

$crawler->filter('div[id$="overlay-tab-booking-open"]')->each(function (Crawler $node, $i) {
             
             
             $node->filter('div[class$="titled-cornered-block"]')->each(function (Crawler $node, $i) {
                     
                           $node->filter('h3,li')->each(function ($node) {
                                   
                                        $content = $node->text();
                                        $item = trim($content);
                                        global $key;
                                        global $running_movies;
                                       
                                        if ($item=="Tamil")
                                        {
                                           $key="Tamil";
                                        }
                                        else if($item=="English")
                                        {
                                            $key="English";
                                        }
                                        else if($item=="Hindi")
                                        {
                                            $key="Hindi";
                                        }
                                        else if($item=="Telugu")
                                        {
                                            $key="Telugu";
                                        }
                                       $running_movies[$key][] = $item;
                            });
      
              }); 
            
         
   });

//print_r($running_movies);

//code for coming soon movie
$upcoming_movies=array();
$key="";
   
$crawler->filter('div[id$="overlay-tab-coming-soon"]')->each(function (Crawler $node, $i) {
             
             
             $node->filter('div[class$="titled-cornered-block"]')->each(function (Crawler $node, $i) {
                 
                         $node->filter('h3,li')->each(function ($node) {
                         
                                   $content = $node->text();
                                   $item = trim($content);
                                   global $key;
                                   global $upcoming_movies;
                                   if ($item=="Tamil")
                                    {
                                       $key="Tamil";
                                    }
                                    else if($item=="English")
                                    {
                                        $key="English";
                                    }
                                    else if($item=="Hindi")
                                    {
                                        $key="Hindi";
                                    }
                                    else if($item=="Telugu")
                                    {
                                        $key="Telugu";
                                    }
                                    $upcoming_movies[$key][] = $item;
                         });
      
             }); 
            
         
});
  
//print_r($upcoming_movies);

//open connection into mongodb

$client = new MongoDB\Client;

$collection = (new MongoDB\Client)->firedb->movies;


//insert upcoming movies into database

//need insert date and update date

$current_ts = date("Y/m/d H:i:s");

foreach ($upcoming_movies as $key => $value) {
    
    $lang=$key;
    
        foreach ($value as $key => $value)
        {
            $flag=isPresent($value,$collection);
            $type="upcoming";
            if($flag)
            {
                $result = $collection->updateOne(
                ['name' => $value],
                ['$set' => array("lang"=> $lang , "name" => $value, "type" => $type, "update_ts" => $current_ts )],
                ['upsert' => true]);
            }
            else
            {
                $result = $collection->insertOne(
                array("lang"=> $lang , "name" => $value, "type" => $type, "insert_ts" => $current_ts ));
                
            }
        
   
    //var_dump($result);
    }
    
}


//insert running movies into database
//$current_ts = date("Y/m/d h:i:sa");

foreach ($running_movies as $key => $value) {
    
        $lang=$key;
    
        foreach ($value as $key => $value)
        {
            
            $upcoming=isUpcoming($value,$collection);
            $type="running";
            if($upcoming)
            {
                $result = $collection->updateOne(
                ['name' => $value],
                ['$set' => array("lang"=> $lang , "name" => $value, "type" => $type, "prev_type" => "upcoming", "notify" => "true", "update_ts" => $current_ts )],
                ['upsert' => true]
                );
            }
            else
            {
                $running=isRunning($value,$collection);
                if($running)
                {
                   $result = $collection->updateOne(
                    ['name' => $value],
                    ['$set' => array("lang"=> $lang , "name" => $value, "type" => $type, "update_ts" => $current_ts )],
                    ['upsert' => true]);
                }
                else
                {
                   $result = $collection->insertOne(
                   array("lang"=> $lang , "name" => $value, "type" => $type, "notify" => "true", "insert_ts" => $current_ts ));
                }
            }
   
    }
    
}


function isUpcoming($value,$collection)
{
     $count = $collection->count(["name"=>$value,"type"=>"upcoming"]);
     if($count>0) 
     {
         return true;
     }
     else
     {
         return false;
     }
}


function isRunning($value,$collection)
{
     $count = $collection->count(["name"=>$value,"type"=>"running"]);
     if($count>0) 
     {
         return true;
     }
     else
     {
         return false;
     }
}



function isPresent($value,$collection)
{
     $count = $collection->count(["name"=>$value]);
     if($count>0) 
     {
         return true;
     }
     else
     {
         return false;
     }
}



$cursor = $collection->find();
//var_dump($document);

foreach ($cursor as $doc) {
//print_r($doc);
}

  
?>