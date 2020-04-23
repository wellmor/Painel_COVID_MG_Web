<?php

require_once 'vendor/autoload.php';

$client = new \GuzzleHttp\Client();

$site = 'https://tabuleiro.mg.gov.br/';

$response = $client->get($site);
$html = $response->getBody()->getContents();
$crawler = new \Symfony\Component\DomCrawler\Crawler($html);

$links = $crawler->filter('a')->each(function ($node) {
    $href  = $node->attr('href');
    return $href;
});


$i = 50;

$linkNoticia = $site . '' . $links[$i];

$imagem = $crawler->filter('img')->each(function ($node) {
    $src  = $node->attr('src');
    return $src;
});

$imagemNoticia = $site . '' . substr($imagem[20], 6);

die('<img src="'.$imagemNoticia.'" width="500px">');
