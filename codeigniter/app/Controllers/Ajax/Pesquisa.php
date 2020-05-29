<?php

namespace App\Controllers\Ajax;

use App\Models\HomeModel;
use CodeIgniter\Controller;

class Pesquisa extends Controller
{
    #http://localhost:8080/ajax/noticias/getdados
    public function getDados($term = null)
    {
        $model = new HomeModel();
        // $model->select("nomeMunicipio, idMunicipio, codMunicipio");
        $model->like("nomeMunicipio", urldecode($term));
        $pesquisas = $model->findAll(3);

        $i = 0;
        $data = array();
        foreach ($pesquisas as $pesquisa) {
            if (!empty($pesquisas)) {
                echo '<p><a style="text-decoration: none; color: black" href="/home/municipio/'.$pesquisa['idMunicipio'].'">'.($pesquisa["nomeMunicipio"]).'</a></p>';
            } else {
                echo "<p>Sem resultados</p>";
            }
        }
    }
}
