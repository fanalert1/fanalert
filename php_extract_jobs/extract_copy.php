<?php

require_once(__DIR__ . '/vendor/autoload.php');
include('db.php');

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$crawler = $client->request('GET', 'http://www.ticketnew.com/Movie-Ticket-Online-booking/C/Chennai');
$running_movies=array();
$running_links=array();
$key="";
$item="";
$i=0;
$crawler->filter('div[id$="overlay-tab-booking-open"]')->each(function (Crawler $node, $i) {
             
             
             $node->filter('div[class$="titled-cornered-block"]')->each(function (Crawler $node, $i) {
                     
                           $node->filter('h3,li')->each(function ($node) {
                                        global $i;
                                        global $item;
                                        $content = $node->text();
                                        $item = trim($content);
                                        global $key;
                                        global $running_movies;
                                       
                                        if ($item=="Tamil")
                                        {
                                           $key="Tamil";
                                           $i=0;
                                        }
                                        else if($item=="English")
                                        {
                                            $key="English";
                                            $i=0;
                                        }
                                        else if($item=="Hindi")
                                        {
                                            $key="Hindi";
                                            $i=0;
                                        }
                                        else if($item=="Telugu")
                                        {
                                            $key="Telugu";
                                            $i=0;
                                        }
                                        else if($item=="Malayalam")
                                        {
                                            $key="Malayalam";
                                            $i=0;
                                        }
                                        else{
                                       $running_movies[$key][$i]["name"] = $item;
                                        $i++;
                                        }
                                        
                            });
                            //to get link for respective language movies
                            
                            global $i;
                           $i=0;
                            
                        $node->filter('a')->each(function (Crawler $node){ 
                        global $key;
                        global $running_movies;
                        global $i;
                       // $i=0;
                        $link = $node->link();
                        $uri = $link->getUri();
                        $running_movies[$key][$i]["uri"] = $uri;
                        $i++;
                        }); 
            }); 
    });

print_r($running_movies);
print_r($running_links);



//$document = $collection->insertOne($running_movies);
//var_dump($document);

//code for coming soon movie
//$movie1=array();
$upcoming_movies=array();
$upcoming_links=array();
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
                                    }else if($item=="Malayalam")
                                        {
                                            $key="Malayalam";
                                        }
                                        else{
                                       $upcoming_movies[$key][] = $item;}
                                    
                         });
                //to get link for respective language movies
                $node->filter('a')->each(function (Crawler $node){ 
                global $key;
                global $upcoming_links;
                $link = $node->link();
                $uri = $link->getUri();
                $upcoming_links[$key][] = $uri;
                }); 
      
        }); 
            
});
  
print_r($upcoming_movies);
print_r($upcoming_links);
?>