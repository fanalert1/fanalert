<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();

$crawler = $client->request('GET', 'http://www.ticketnew.com/Movie-Ticket-Online-booking/C/Chennai');

//$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);


$crawler->filter('div[id$="overlay-tab-booking-open"]')->each(function ($node) {
    
    $content = $node->text();
    
    $items = explode("\n",$content);
   

    foreach ($items as $item) {
        
        
        
    
        $item = trim($item); //remove items without any content or only whitespaces or empty lines
        
        if (strlen($item)>0)
        {
        //echo $item."\n";
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
         
         
        // array_push($movie[$key],$item);
        
        $movie[$key][] = $item;
        
        }
    
    }
    
    print_r($movie);

    
   
});


//$link = $crawler->selectLink('Coming Soon')->link();
//$crawler = $client->click($link);

// [id$="overlay-tab-coming-soon"]

/*


$crawler->filter('div[id$="overlay-tab-coming-soon"]')->children()->each(function ($node) {
   // print $node->text()."\n";
   
   //$content = $node->text();
    
    print $node->nodeName();

   
    
});

   */
   //code for coming soon movie
   
   
   $scrap="";
   
   
   $nodeValues = $crawler->filter('div[id$="overlay-tab-coming-soon"]')->each(function (Crawler $node, $i) {
       
       
            
            $node->filter('.titled-cornered-block')->each(function ($node,$j) {
                
//$content = $node->text();
$node->filter('h3')->each(function ($node){ 
    
             $item .= $node->text();
             
         $item.="\n";
         
         global $scrap;
$scrap .=$item;         
            
            }); 
               
              $node->filter('li')->each(function ($node){  
    
            $item .= $node->text();
            $item.="\n";
            global $scrap;
$scrap .=$item;
            }); 
            $node->filter('a')->each(function (Crawler $node){ 
    
             $link = $node->link();
             $uri = $link->getUri();
             echo $uri;
         //$item.="\n";
         
         //global $scrap;
//$scrap .=$item;         
            
            }); 
            });
            
   });
   
  $content = explode("\n",$scrap);
   

    foreach ($content as $content) {
        
      $item = trim($content); //remove items without any content or only whitespaces or empty lines
        
        if (strlen($content)>0)
        {
        //echo $item."\n";
        if ($content=="Tamil")
        {
            $key="Tamil";
        }
        else if($content=="English")
        {
            $key="English";
        }
        else if($content=="Hindi")
        {
            $key="Hindi";
        }
        else if($content=="Telugu")
        {
            $key="Telugu";
        }
        else
        {
            $movie[$key][] = $content;
        }
         
        // array_push($movie[$key],$item);
        
        }
    
    }
    
    print_r($movie);
   
   
   //print_r($nodeValues);

?>