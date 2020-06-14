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
        $model->orderby('nomeMunicipio', 'ASC');
        $pesquisas = $model->findAll();

        $microrregiao = null;
        foreach ($pesquisas as $pesquisa) {
            if ($pesquisa['idMicrorregiao'] == 1)
                $microrregiao = "uba";
            else if ($pesquisa['idMicrorregiao'] == 2)
                $microrregiao = "jf";
            else if ($pesquisa['idMicrorregiao'] == 3)
                $microrregiao = "outras";

            echo '<li class="btn dropdown-item list-item" id="test" style="padding-left: 10px;" data-microrregiao="microrregiao-' . $microrregiao . '">
                <a href="/home/pesquisa/' . $pesquisa['slugMunicipio'] . '" style="text-decoration: none; color: black;">
                    <h5 class="name text-center">' . $pesquisa['nomeMunicipio'] . '</h5>
                </a>
            </li>';
        }
    }
}
