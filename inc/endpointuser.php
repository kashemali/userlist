<?php
/*
* @Package: UserList
*/
namespace Inc;

class EndpointUser{
     var $url;
     var $cached_file;
     function __construct($url){
          $this->url=$url;
          $dir=dirname(__FILE__,2)."/data";
          if (!file_exists($dir)) {
               mkdir($dir, 0777, true);
          }
          $this->cached_file=$dir."/all.cache.json";
     }
     function GetAll(){
          return $this->Result();
          
     }
     function GetbyId($id){
          $this->cached_file=dirname(__FILE__,2)."/data/".$id.'.cache.json';
          $this->url.="/".$id;
          return $this->Result();
     }
     function Result(){
          $r=(new Httpget($this->url))->data();
          if($r->status ===200 && !empty($r->body)){
               file_put_contents($this->cached_file, $r->body);
               return $r->body;
          }else{
               if(file_exists($this->cached_file)){
                return file_get_contents($this->cached_file);
               }
               
          }
     }
}