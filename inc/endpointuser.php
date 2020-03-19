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
          $this->cached_file=dirname(__FILE__,2)."/data/all.cache.json";
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
          $r=(new httpget($this->url))->data();
          if($r->status ===200){
               file_put_contents($this->cached_file, $r->body);
               return $r->body;
          }else{
               if(file_exists($this->cached_file)){
                return file_get_contents($this->cached_file);
               }
               
          }
     }
}