<?php

namespace App\Controllers;

class TelecomeService
{
	
    public function getPosts($request, $response){

          $rss = simplexml_load_file("http://www.prnewswire.com/rss/telecommunications/all-telecommunications-news.rss");

          $data=array();
            foreach ($rss->channel->item as $item) {
               $link = (string) $item->link;
               $title = (string) $item->title;
               $des = (string) $item->description;
               $fimg = "";
               $index = 0;
               $index = strpos($des, "/>");
               if($index === false){
                  $des_end = strpos($des, "</p>");
                  //take 1st hundred characters only
                  $description = substr($des, 0, 100);
               }else{
                  $fimg = substr($des, 0, $index+2);
                  $des_end = strpos($des, "</p>");
                  $description = substr($des, $index+2, $des_end- $index - 3);
                  //take 1st hundred characters only
                  //$description = substr($description, 0, 100);
               }

               $pub_date = (string) $item->pubDate;
               $uid = (string) $item->uid;

               $obj=array();
               if (preg_match('~src="(.*?)"~', $fimg, $display) === 1) {
               $obj['img']= $display[1];
               }else{
                $obj['img']= '';
               }
               $obj['title']= $title;
               $obj['description']= $des;
               $data[]=$obj;

            }

            return json_encode($data);
   
    }
}
