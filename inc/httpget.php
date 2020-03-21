<?php
/*
* @Package: Httpget
*/

declare(strict_types=1);
namespace Inc;

class Httpget
{
    private $fpI;        // HTTP socket
    private $url;        // full URL
    private $host;        // HTTP host
    private $protocol;    // protocol (HTTP/HTTPS)
    private $uri;        // request URI
    private $port;        // port

    // constructor
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->parseUrl();
    }

    // scan url
    private function parseUrl():int
    {
        $req = $this->url;

        $pos = strpos($req, '://');
        $this->protocol = strtolower(substr($req, 0, $pos));

        $req = substr($req, $pos+3);
        $pos = strpos($req, '/');
        if ($pos === false) {
            $pos = strlen($req);
        }
        $host = substr($req, 0, $pos);

        $this->uri = substr($req, $pos);
        if ($this->uri === '') {
            $this->uri = '/';
        }
        if (strpos($host, ':') !== false) {
            list($this->host, $this->port) = explode(':', $host);
            return 1;
        }
        $this->host = $host;
        $this->port = ($this->protocol === 'https') ? 443 : 80;
        return 1;
    }

    // download URL to string
    public function data():array
    {
        $crlf = "\r\n";

        // generate request
        $req = 'GET ' . $this->uri . ' HTTP/1.0' . $crlf
            .    'Host: ' . $this->host . $crlf
            .    $crlf;

        // fetch
        $this->fpI = fsockopen(($this->protocol === 'https' ? 'ssl://' : '') . $this->host, $this->port);
        fwrite($this->fpI, $req);
        $response="";
        while (is_resource($this->fpI) && $this->fpI && !feof($this->fpI)) {
            $response .= fread($this->fpI, 1024);
        }
        fclose($this->fpI);

        // split header and body
        $pos = strpos($response, $crlf . $crlf);
        if ($pos === false) {
            return($response);
        }
        $header = substr($response, 0, $pos);
        $body = substr($response, $pos + 2 * strlen($crlf));

        // parse headers
        $res = [];
        $lines = explode($crlf, $header);
        foreach ($lines as $key => $line) {
            if ($key===0) {
                $res['status']=(int)substr($line, 9, 3);
            }
            $pos = strpos($line, ':');
            if ($pos !== false) {
                $res[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos+1));
            }
        }

        // redirection?
        if (isset($res['location'])) {
            $http = new httpget($res['location']);
            return($http->data($http));
        }
        $res['body']=$body;
        return $res;
    }
}
