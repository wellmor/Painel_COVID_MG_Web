<?php

namespace App\Controllers\Ajax;

use App\Models\CasosModel;
use CodeIgniter\Controller;
use App\Models\LeitosModel;
use App\Models\VacinometroModel;

class Casos extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados()
    {
        $model = new CasosModel();
        $model->select("caso.dataCaso, caso.fonteCaso, caso.auto, caso.idCaso, caso.idMunicipio, caso.confirmadosCaso, caso.suspeitosCaso, caso.obitosCaso, caso.descartadosCaso, caso.recuperadosCaso, caso.created_at, municipio.nomeMunicipio");
        $model->join('municipio', 'municipio.idMunicipio = caso.idMunicipio');
        $model->join('usuario_municipio', 'usuario_municipio.idMunicipio = municipio.idMunicipio');
        $model->where("usuario_municipio.idUsuario", session()->get('idUsuario'));

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
        //$model->where("idUsuario", session()->get('idUsuario'));
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
            $i++;
        }

        echo json_encode($data);
    }

    public function getLastDadosLeitos($idMunicipio = null)
    {
        $model = new LeitosModel();
        $model->select("*");
        $model->join('municipio', 'municipio.idMunicipio = leito.idMunicipio');
        //$model->where("idUsuario", session()->get('idUsuario'));
        $model->where("leito.idMunicipio", $idMunicipio);
        $model->orderBy('leito.dataLeitos', 'DESC');
        $leitos = $model->findAll(1);
        $i = 0;
        $data = array();
        foreach ($leitos as $leito) {
            $data[$i]['qntLeitosOcupadosClinico'] = $leito['qntLeitosOcupadosClinico'];
            $data[$i]['qntLeitosDisponiveisClinico'] = $leito['qntLeitosDisponiveisClinico'];
            $data[$i]['qntLeitosOcupadosUTI'] = $leito['qntLeitosOcupadosUTI'];
            $data[$i]['qntLeitosDisponiveisUTI'] = $leito['qntLeitosDisponiveisUTI'];
            $data[$i]['fonteLeitos'] = $leito['fonteLeitos'];
            $i++;
        }

        echo json_encode($data);
    }

    public function getLastDadosVacinometro($idMunicipio = null)
    {
        $model = new VacinometroModel();
        $model->select("*");
        $model->join('municipio', 'municipio.idMunicipio = vacinometro.idMunicipio');
        //$model->where("idUsuario", session()->get('idUsuario'));
        $model->where("vacinometro.idMunicipio", $idMunicipio);
        $model->orderBy('vacinometro.dataVacinometro', 'DESC');
        $vacinometros = $model->findAll(1);
        $i = 0;
        $data = array();
        foreach ($vacinometros as $vacinometro) {
            $data[$i]['qnt1Dose'] = $vacinometro['qnt1Dose'];
            $data[$i]['qnt2Dose'] = $vacinometro['qnt2Dose'];
            $data[$i]['qnt3Dose'] = $vacinometro['qnt3Dose'];
            $data[$i]['fonteVacinometro'] = $vacinometro['fonteVacinometro'];
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
            $i++;
        }


        echo json_encode($data);
    }
}
