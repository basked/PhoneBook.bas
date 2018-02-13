<?php

namespace App\Http\Controllers;

use Symfony\Component\DomCrawler\Crawler;
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
        $proxy = ['proxy' => ['http' => 'http://gt-asup6:teksab@172.16.15.33:3128', 'https' => 'http://gt-asup6:teksab@172.16.15.33:3128']];
        $request = $client->request('GET', '/katalog.php', $proxy,
            ['headers' => [
                'Connection' => 'keep-alive',
                'Cache-Control' => 'max-age=0',
                'Upgrade-Insecure-Requests' => '1',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
            ]
            ]);
        echo 'Размер:' . $request->getBody()->getSize() . '<br>';
        $html = iconv("windows-1251", "utf-8", $request->getBody()->getContents());
        echo '<pre>';
        print_r($html);
        echo '</pre>';
    }

    /** парсим Candylady
     * @return string
     */
    public function parseCandylady ()
    {
        $client = new Client([
            'base_uri' => 'https://candylady.by/search/',
            'timeout' => 60.0
        ]);
        // параметры запроса
        $form_params =
            ['form_params' => [
                'maker' => [],   // производитель
                // 'maker' => json_encode(["BUTER", "ALANI"]),   // производитель
                'type' => [],                                 // тип
                'size' => [],                // размеры
                //  'size' => json_encode(["42"]),                // размеры
                'model' => [],                                // модели
                'limit' => 5,                                // лимит  по выборке
                'priceFrom' => 0,                             // цена с
                'priceTo' => 241                              // цена по
            ]
            ];
        $request = $client->request('POST', 'view.php', $this->getProxy() + $form_params);
        $html = $request->getBody()->getContents();
        $this->parseProductsJson($html, '');
        // return $html;
    }

    /** Set Proxy Connect
     * @param bool $isActive
     * @return array
     */
    private function getProxy ($isActive = true)
    {
        $proxy = [];
        if ($isActive == true) {
            $proxy = ['proxy' => ['http' => 'http://gt-asup6:teksab@172.16.15.33:3128',
                'https' => 'http://gt-asup6:teksab@172.16.15.33:3128']];
        }
        return $proxy;
    }

    private function parseProductsJson ($html)
    {
        $products = [];
        $response = '';
        $kurs = $this->getCurs();
        try {
            $crawler = new Crawler($html);
            $filter = $crawler->filter('li');
            foreach ($filter as $i => $domElement) {
                $_crawler = new Crawler($domElement);
                if ($_crawler->filter('.description>p')->count() == 4) {
                    $products[$i] = array(
                        'prodUrl' => $_crawler->filter('a')->first()->attr('href'),
                        'ProdImage' => $_crawler->filter('img')->attr('src'),
                        'prodModel' => $_crawler->filter('.description>p')->eq(0)->text(),
                        'prodMaker' => $_crawler->filter('.description>p')->eq(1)->text(),
                        'prodCategory' => $this->categoryToArray($_crawler->filter('.description>p')->eq(2)->text()),
                        'prodSize' => $this->sizeToArray($_crawler->filter('.description>p')->eq(3)->text()),
                        'prodPriceUSD' => $_crawler->filter('.price')->attr('data-val'),
                        'prodPriceRUR' => $_crawler->filter('.price>span')->text(),
                        'prodPriceBYN' => $_crawler->filter('.price')->attr('data-val') * $kurs
                    );
                }
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        echo '<pre>';
        print_r($products);
        echo '</pre>';
    }

    /**
     * @return null|string
     */
    private function getCurs ()
    {
        $client = new Client([
            'base_uri' => 'https://candylady.by/',
            'timeout' => 2.0
        ]);
        $request = $client->request('GET', 'currency.php', $this->getProxy());
        $res = $request->getBody()->getContents();
        $crawler = new Crawler($res);
        $kurs = $crawler->filter('option')->attr('index');
        return $kurs;
    }

    /**  Переводим строку категорий в массив и заполням значениями
     * @param string $category
     * @return array
     */
    private function categoryToArray ($category = '')
    {
        $categories = [];
        if ($category != '') {
            $category = str_replace('Категория: ', '', $category);
            $categories = explode(',', $category);
        }
        return $categories;
    }

    /** Переводим строку размеров в массив и заполням значениями
     * @param string $size
     * @return array
     */
    private function sizeToArray ($size = '')
    {
        $sizes = [];
        if ($size != '') {
            $size = str_replace('Размеры: ', '', $size);
            $arrSize = explode('-', $size);
            if (count($arrSize) > 1) {
                for ($i = $arrSize[0]; $i <= $arrSize[1]; $i += 2) {
                    $sizes[] = $i;
                }
            } else {
                $size[0] = $arrSize[0];
            }
        }
        return $sizes;
    }

    public function test ()
    {
        print_r($this->sizeToArray('42-48'));
        print_r($this->categoryToArray('костюмы, комплекты'));
    }
}
