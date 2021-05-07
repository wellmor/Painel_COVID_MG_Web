<?php

namespace App\Controllers\Ajax;

use App\Models\VacinometroModel;
use CodeIgniter\Controller;

class Vacinas extends Controller
{
    #http://localhost:8080/ajax/leitos/getdados
    public function getDados()
    {
        $model = new VacinometroModel();
        $model->select("municipio.nomeMunicipio, vacinometro.idVacinometro, vacinometro.idMunicipio, vacinometro.dataVacinometro, vacinometro.qnt1Dose, vacinometro.qnt2Dose");
        $model->join('municipio', 'municipio.idMunicipio = vacinometro.idMunicipio');
        $model->where("idUsuario", session()->get('idUsuario'));
        $vacinometros = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($vacinometros as $vacinometro) {
            $data[$i]['idVacinometro'] = $vacinometro['idVacinometro'];
            $data[$i]['qnt1Dose'] = $vacinometro['qnt1Dose'];
            $data[$i]['qnt2Dose'] = $vacinometro['qnt2Dose'];
            $data[$i]['idMunicipio'] = $vacinometro['idMunicipio'];
            $data[$i]['datax'] = $vacinometro['dataVacinometro'];
            $data[$i]['municipio'] = $vacinometro['nomeMunicipio'];

            $i++;
        }
        $vacinometros = [
            'data' => $data
        ];

        echo json_encode($vacinometros);
    }


}
