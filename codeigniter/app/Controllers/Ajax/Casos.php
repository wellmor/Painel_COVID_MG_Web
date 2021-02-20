<?php

namespace App\Controllers\Ajax;

use App\Models\CasosModel;
use CodeIgniter\Controller;
use App\Models\LeitosModel;

class Casos extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados()
    {
        $model = new CasosModel();
        $model->select("caso.dataCaso, caso.fonteCaso, caso.auto, caso.idCaso, caso.idMunicipio, caso.confirmadosCaso, caso.suspeitosCaso, caso.obitosCaso, caso.descartadosCaso, caso.recuperadosCaso, caso.created_at, municipio.nomeMunicipio");
        //$model->select("caso.dataCaso, caso.fonteCaso, caso.auto, caso.idCaso, caso.idMunicipio, caso.confirmadosCaso, caso.suspeitosCaso, caso.obitosCaso, caso.descartadosCaso, caso.recuperadosCaso, caso.created_at, municipio.nomeMunicipio, leito.idLeito, leito.idMunicipio, leito.qntLeitosDisponiveis, leito.qntLeitosOcupados, leito.idCaso");
        $model->join('municipio', 'municipio.idMunicipio = caso.idMunicipio');
        //$model->join('leito', 'caso.idCaso = leito.idCaso', 'cross');
        $model->where("caso.idUsuario", session()->get('idUsuario'));

        $casos = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['id'] = $caso['idCaso'];
            $data[$i]['datax'] = $caso['dataCaso'];
            $data[$i]['fonte'] = $caso['fonteCaso'];
            $data[$i]['confirmados'] = $caso['confirmadosCaso'];
            $data[$i]['suspeitos'] = $caso['suspeitosCaso'];
            $data[$i]['obitos'] = $caso['obitosCaso'];
            $data[$i]['descartados'] = $caso['descartadosCaso'];
            $data[$i]['recuperados'] = $caso['recuperadosCaso'];
            $data[$i]['municipio'] = $caso['nomeMunicipio'];
            $data[$i]['idMunicipio'] = $caso['idMunicipio'];
            $data[$i]['auto'] = $caso['auto'];
            //$data[$i]['qntLeitosDisponiveis'] = $caso['qntLeitosDisponiveis'];
            //$data[$i]['qntLeitosOcupados'] = $caso['qntLeitosOcupados'];
            $i++;
        }
        $casos = [
            'data' => $data
        ];

        echo json_encode($casos);
    }

    public function getLastDados($idMunicipio = null)
    {
        $model = new CasosModel();
        $model->select("caso.dataCaso, caso.fonteCaso, caso.idCaso, caso.idMunicipio, caso.confirmadosCaso, caso.suspeitosCaso, caso.obitosCaso, caso.descartadosCaso, caso.recuperadosCaso, municipio.nomeMunicipio");
        $model->join('municipio', 'municipio.idMunicipio = caso.idMunicipio');
        $model->where("idUsuario", session()->get('idUsuario'));
        $model->where("caso.idMunicipio", $idMunicipio);
        $model->where("auto", 0);
        $model->orderBy('caso.dataCaso', 'DESC');
        $casos = $model->findAll(1);
        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['id'] = $caso['idCaso'];
            $data[$i]['datax'] = $caso['dataCaso'];
            $data[$i]['fonte'] = $caso['fonteCaso'];
            $data[$i]['confirmados'] = $caso['confirmadosCaso'];
            $data[$i]['suspeitos'] = $caso['suspeitosCaso'];
            $data[$i]['obitos'] = $caso['obitosCaso'];
            $data[$i]['descartados'] = $caso['descartadosCaso'];
            $data[$i]['recuperados'] = $caso['recuperadosCaso'];
            $data[$i]['municipio'] = $caso['nomeMunicipio'];
            $data[$i]['idMunicipio'] = $caso['idMunicipio'];
            //$data[$i]['qntLeitosDisponiveis'] = $caso['qntLeitosDisponiveis'];
            //$data[$i]['qntLeitosOcupados'] = $caso['qntLeitosOcupados'];
            $i++;
        }


        echo json_encode($data);
    }

    public function getDadosApp($idMunicipio = null)
    {
        $model = new CasosModel();
        $model->select("caso.dataCaso, caso.fonteCaso, caso.idCaso, caso.idMunicipio, caso.confirmadosCaso, caso.suspeitosCaso, caso.obitosCaso, caso.descartadosCaso, caso.recuperadosCaso, municipio.nomeMunicipio");
        $model->join('municipio', 'municipio.idMunicipio = caso.idMunicipio');
        $model->where("caso.idMunicipio", $idMunicipio);
        $model->where("auto", 0);
        $model->orderBy('caso.dataCaso', 'DESC');
        $casos = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['id'] = $caso['idCaso'];
            $data[$i]['datax'] = $caso['dataCaso'];
            $data[$i]['fonte'] = $caso['fonteCaso'];
            $data[$i]['confirmados'] = $caso['confirmadosCaso'];
            $data[$i]['suspeitos'] = $caso['suspeitosCaso'];
            $data[$i]['obitos'] = $caso['obitosCaso'];
            $data[$i]['descartados'] = $caso['descartadosCaso'];
            $data[$i]['recuperados'] = $caso['recuperadosCaso'];
            $data[$i]['municipio'] = $caso['nomeMunicipio'];
            $data[$i]['idMunicipio'] = $caso['idMunicipio'];
            //$data[$i]['qntLeitosDisponiveis'] = $caso['qntLeitosDisponiveis'];
            //$data[$i]['qntLeitosOcupados'] = $caso['qntLeitosOcupados'];
            $i++;
        }


        echo json_encode($data);
    }
}
