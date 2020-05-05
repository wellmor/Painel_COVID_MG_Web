<?php

require_once 'vendor/autoload.php';

$client = new \GuzzleHttp\Client();

$response = $client->get('http://portal.riopomba.mg.gov.br/noticias');
$html = $response->getBody()->getContents();
$crawler = new \Symfony\Component\DomCrawler\Crawler($html);

$links = $crawler->filter('a')->each(function ($node) {
    $href  = $node->attr('href');
    return $href;
});

$i = 90;
while (!strpos($links[$i], 'boletim-diorio-coronavorus')) {
    $i++;
}

$linkNoticia = $links[$i];

$response = $client->get($linkNoticia);
$html = $response->getBody()->getContents();
$crawler = new \Symfony\Component\DomCrawler\Crawler($html);

$att = $crawler->filter('span[class="acessar"]')->first();

foreach ($att as $text)
    $att =  $text->textContent;

$data = substr($att, 0, 11);
$hour = substr($att, 18);

$texts = $crawler->filter('div[class="textonoticia"]')->first();

foreach ($texts as $text)
    $noticia = $text->textContent;

$notificados = preg_replace('/[^0-9]/', '', preg_split('#(?<!\\\)Dos | casos notificados#', $noticia, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[1]);
$descartados = preg_replace('/[^0-9]/', '', preg_split('#(?<!\\\)notificados | foram descartados#', $noticia, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[1]);

$dados = array(

    'data' => $data,
    'hora' => $hour,
    'notificados' => $notificados,    
    'descartados' => $descartados,
    'fonte' => $linkNoticia

);

echo json_encode($dados);
