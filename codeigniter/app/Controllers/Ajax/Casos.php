<?php

namespace App\Controllers\Ajax;

use App\Models\CasosModel;
use CodeIgniter\Controller;


class Casos extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados()
    {
        $model = new CasosModel();
        $model->select("casos.dataCaso, casos.fonteCaso, casos.idCaso, casos.idMunicipio, casos.confirmadosCaso, casos.suspeitosCaso, casos.obitosCaso, casos.descartadosCaso, casos.recuperadosCaso, casos.created_at, municipios.nomeMunicipio");
        $model->join('municipios', 'municipios.idMunicipio = casos.idMunicipio');
        $model->where("idUsuario", session()->get('id'));
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
        $casos = [
            'data' => $data
        ];

        echo json_encode($casos);
    }
}
