<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GuzzleController extends Controller
{
    public function parse ()
    {
        $client = new Client([
            'base_uri' => 'https://brestmoda.com',
            'timeout' => 2.0
        ]);

        $request = $client->request('GET', '/katalog.php',
            ['proxy' => ['http' => 'http://gt-asup6:teksab@172.16.15.33:3128', 'https' => 'http://gt-asup6:teksab@172.16.15.33:3128'],
                ['headers' => [
                    'Connection' => 'keep-alive',
                    'Cache-Control' => 'max-age=0',
                    'Upgrade-Insecure-Requests' => '1',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                    'Accept-Encoding' => 'gzip, deflate, br',
                    'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
                ]]
            ]);

        echo iconv("windows-1251","utf-8",$request->getBody()->getContents());
    }
}
