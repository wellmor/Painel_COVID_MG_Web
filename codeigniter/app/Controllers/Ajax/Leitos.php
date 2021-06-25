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
        $model->select("leito.idLeito, municipio.nomeMunicipio, leito.idMunicipio, leito.qntLeitosDisponiveisUTI, leito.qntLeitosOcupadosUTI, leito.qntLeitosDisponiveisClinico, leito.qntLeitosOcupadosClinico, leito.dataLeitos, leito.fonteLeitos");
        $model->join('municipio', 'municipio.idMunicipio = leito.idMunicipio');
        $model->join('usuario_municipio', 'usuario_municipio.idMunicipio = municipio.idMunicipio');
        $model->where("usuario_municipio.idUsuario", session()->get('idUsuario'));
        $leitos = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($leitos as $leito) {
            $data[$i]['idLeito'] = $leito['idLeito'];
            $data[$i]['qntLeitosDisponiveisClinico'] = $leito['qntLeitosDisponiveisClinico'];
            $data[$i]['qntLeitosOcupadosClinico'] = $leito['qntLeitosOcupadosClinico'];
            $data[$i]['qntLeitosDisponiveisUTI'] = $leito['qntLeitosDisponiveisUTI'];
            $data[$i]['qntLeitosOcupadosUTI'] = $leito['qntLeitosOcupadosUTI'];
            $data[$i]['idMunicipio'] = $leito['idMunicipio'];
            $data[$i]['dataLeitos'] = $leito['dataLeitos'];
            $data[$i]['municipio'] = $leito['nomeMunicipio'];
            $data[$i]['fonteLeitos'] = $leito['fonteLeitos'];
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
            $data[$i]['qntLeitosDisponiveisClinico'] = $leito['qntLeitosDisponiveisClinico'];
            $data[$i]['qntLeitosOcupadosClinico'] = $leito['qntLeitosOcupadosClinico'];
            $data[$i]['qntLeitosDisponiveisUTI'] = $leito['qntLeitosDisponiveisUTI'];
            $data[$i]['qntLeitosOcupadosUTI'] = $leito['qntLeitosOcupadosUTI'];
            $data[$i]['idMunicipio'] = $leito['idMunicipio'];
            $data[$i]['dataLeitos'] = $leito['dataLeitos'];
            $data[$i]['municipio'] = $leito['nomeMunicipio'];
            $data[$i]['fonteLeitos'] = $leito['fonteLeitos'];
            $i++;
        }
        echo json_encode($data);
    }
}
