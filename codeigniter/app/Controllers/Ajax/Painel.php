<?php

namespace App\Controllers\Ajax;

use App\Models\PainelModel;
use CodeIgniter\Controller;


class Painel extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados()
    {
        $model = new PainelModel();
        $query = $model->query("SELECT m.nomeMunicipio as nome, c.idMunicipio as id, 
        IF(IFNULL(c.idCaso, '') = '', '-', c.idCaso) AS idCaso, 
        IF(IFNULL(v.idVerificacao, '') = '', '-', v.idVerificacao) AS idVerificacao, 
        IF(IFNULL(c.dataCaso, '') = '', '-', max(c.dataCaso)) AS maxDataCaso,
        IF(IFNULL(v.dataVerificacao, '') = '', '-', max(v.dataVerificacao)) AS maxDataVerificacao,
        IF(IFNULL(c.confirmadosCaso, '') = '', '-', c.confirmadosCaso) AS confirmados,
        IF(IFNULL(c.suspeitosCaso, '') = '', '-', c.suspeitosCaso) AS suspeitos,
        IF(IFNULL(c.descartadosCaso, '') = '', '-', c.descartadosCaso) AS descartados,
        IF(IFNULL(c.recuperadosCaso, '') = '', '-', c.recuperadosCaso) AS recuperados,
        IF(IFNULL(c.obitosCaso, '') = '', '-', c.obitosCaso) AS obitos
        FROM (
           caso c
           JOIN municipio m ON c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00')
        LEFT JOIN verificacao v ON v.idMunicipio = c.idMunicipio
        GROUP BY c.idMunicipio");
        $data = $query->getResult('array');
        $i = 0;
        // foreach ($data as $x) {
        //     $data[$i]['id'] = $caso['idCaso'];
        //     $data[$i]['datax'] = $caso['dataCaso'];
        //     $data[$i]['fonte'] = $caso['fonteCaso'];
        //     $data[$i]['confirmados'] = $caso['confirmadosCaso'];
        //     $data[$i]['suspeitos'] = $caso['suspeitosCaso'];
        //     $data[$i]['obitos'] = $caso['obitosCaso'];
        //     $data[$i]['descartados'] = $caso['descartadosCaso'];
        //     $data[$i]['recuperados'] = $caso['recuperadosCaso'];
        //     $data[$i]['municipio'] = $caso['nomeMunicipio'];
        //     $data[$i]['idMunicipio'] = $caso['idMunicipio'];
        //     $i++;
        // }

        $dados = [
            'data' => $data
        ];

        echo json_encode($dados);
    }
}
