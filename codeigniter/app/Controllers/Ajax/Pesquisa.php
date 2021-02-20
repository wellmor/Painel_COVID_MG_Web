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
        $data = [];
        $uba = [];
        $jf = [];
        $entornos = [];

        $query = $model->query("SELECT nomeMunicipio, idMicrorregiao FROM municipio");
        $data = $query->getResult('array');
        $temp = [];
        foreach ($data as $x) {

            if ($x['idMicrorregiao'] == 1) {
                // $uba['nome'] = $x['nomeMunicipio'];
                // $uba['slug'] = $x['slugMunicipio'];
                $temp = $x['nomeMunicipio'];
                array_push($uba, $temp);
            } else if ($x['idMicrorregiao'] == 2) {
                $temp = $x['nomeMunicipio'];
                array_push($jf, $temp);
            } else if ($x['idMicrorregiao'] == 3 || $x['idMicrorregiao'] == 4) {
                $temp = $x['nomeMunicipio'];
                array_push($entornos, $temp);
            }
        }

        $source = [
            "entornos" => $entornos,
            "uba" => $uba,
            "jf" => $jf,
            
        ];
        echo json_encode($source);

        // echo json_encode($data);
    }

    public function getDadosMobile($term = null)
    {
        $model = new HomeModel();
        $data = [];
        $uba = [];
        $jf = [];
        $entornos = [];

        $query = $model->query("SELECT nomeMunicipio, idMicrorregiao, idMunicipio FROM municipio");
        $data = $query->getResult('array');
        $temp = [];
        foreach ($data as $x) {

            if ($x['idMicrorregiao'] == 1) {
                // $uba['nome'] = $x['nomeMunicipio'];
                // $uba['slug'] = $x['slugMunicipio'];
                $temp = array($x['nomeMunicipio'], $x['idMunicipio']);
                array_push($uba, $temp);
            } else if ($x['idMicrorregiao'] == 2) {
                $temp = $x['nomeMunicipio'];
                array_push($jf, array($temp, $x['idMunicipio']));
            } else if ($x['idMicrorregiao'] == 3 || $x['idMicrorregiao'] == 4) {
                $temp = $x['nomeMunicipio'];
                array_push($entornos, array($temp, $x['idMunicipio']));
            }
        }

        $source = [
            "entornos" => $entornos,
            "uba" => $uba,
            "jf" => $jf,

        ];
        echo json_encode($source);

        // echo json_encode($data);
    }
}
