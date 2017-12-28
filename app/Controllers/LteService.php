<?php

namespace App\Controllers;

class LteService
{
	
    public function getFourGPosts($request, $response){

          $rss = simplexml_load_file("http://www.lteto5g.com/category/4g/feed/");

          $data=array();
            foreach ($rss->channel->item as $item) {
               $title = (string) $item->title;
               $link = (string) $item->link;
               $des = (string) $item->description;

               $e_content     = $item->children("content", true);
               $content     = (string)$e_content->encoded; 

               
               $pub_date = (string) $item->pubDate;
               $uid = (string) $item->uid;

               $obj=array();
               $obj['title']= $title;
               $obj['description']= substr($content, 0, 700) . '...';
               $data[]=$obj;

            }

            return json_encode($data);
   
    }
}
