<?php
/*
* @Package: EndpointUser
*/

declare(strict_types=1);
namespace Inc;

class EndpointUser
{
     private $url;
     private $cachedFile;
    public function __construct(string $url)
    {

         $this->url=$url;
         $dir=dirname(__FILE__, 2)."/data";
        if (!file_exists($dir)) {
             mkdir($dir, 0777, true);
        }
         $this->cached_file=$dir."/all.cache.json";
    }

    public function all(): string
    {

         return $this->Result();
    }

    public function byId(int $id): string
    {

         $this->cached_file=dirname(__FILE__, 2)."/data/".$id.'.cache.json';
         $this->url.="/".$id;
         return $this->Result();
    }

    private function result(): string
    {

         $res=(new Httpget($this->url))->data();
        if ($res['status'] ===200 && !empty($res['body'])) {
             file_put_contents($this->cached_file, $res['body']);
             return $res['body'];
        }
        if (file_exists($this->cached_file)) {
            return file_get_contents($this->cached_file);
        }
    }
}
