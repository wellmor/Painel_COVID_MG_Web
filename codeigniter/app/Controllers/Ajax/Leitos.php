<?php

namespace App\Controllers\Ajax;

use App\Models\LeitosModel;
use CodeIgniter\Controller;

class Leitos extends Controller
{
    #http://localhost:8080/ajax/leitos/getdados
    public function getDados()
    {
        $model = new LeitosModel();
        $model->select("leito.idLeito, municipio.nomeMunicipio, leito.idMunicipio, leito.qntLeitosDisponiveis, leito.qntLeitosOcupados, leito.dataLeitos");
        $model->join('municipio', 'municipio.idMunicipio = leito.idMunicipio');
        $model->where("idUsuario", session()->get('idUsuario'));
        $leitos = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($leitos as $leito) {
            $data[$i]['idLeito'] = $leito['idLeito'];
            $data[$i]['qntLeitosDisponiveis'] = $leito['qntLeitosDisponiveis'];
            $data[$i]['qntLeitosOcupados'] = $leito['qntLeitosOcupados'];
            $data[$i]['idMunicipio'] = $leito['idMunicipio'];
            $data[$i]['datax'] = $leito['dataLeitos'];
            $data[$i]['municipio'] = $leito['nomeMunicipio'];
            $i++;
        }
        $leitos = [
            'data' => $data
        ];

        echo json_encode($leitos);
    }

    public function getLastDados($idMunicipio = null)
    {
        $model = new LeitosModel();
        $model->select("*");
        $model->where("leito.idMunicipio", $idMunicipio);
        $model->orderBy('leito.idLeito', 'DESC');
        $leitos = $model->findAll(1);
        $i = 0;
        $data = array();
        foreach ($leitos as $leito) {
            $data[$i]['idLeito'] = $leito['idLeito'];
            $data[$i]['qntLeitosDisponiveis'] = $leito['qntLeitosDisponiveis'];
            $data[$i]['qntLeitosOcupados'] = $leito['qntLeitosOcupados'];
            $data[$i]['idMunicipio'] = $leito['idMunicipio'];
            $i++;
        }
        echo json_encode($data);
    }
}
