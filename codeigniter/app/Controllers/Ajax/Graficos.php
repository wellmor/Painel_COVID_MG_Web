<?php

namespace App\Controllers\Ajax;

use App\Models\CasosModel;
use CodeIgniter\Controller;


class Graficos extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados($id = null)
    {
        $model = new CasosModel();
        $query = $model->query("SELECT c.idCaso as id, c.dataCaso as dat, c.confirmadosCaso as conf, c.suspeitosCaso as susp, c.obitosCaso as ob, c.descartadosCaso as desca, c.recuperadosCaso as recu, m.nomeMunicipio as nome FROM caso c, municipio m WHERE m.idMunicipio = c.idMunicipio AND c.idMunicipio = " . $id . " ORDER BY dataCaso ASC");
        $casos = $query->getResult('array');

        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['id'] = $caso['id'];
            $data[$i]['datax'] = $caso['dat'];
            $data[$i]['confirmados'] = $caso['conf'];
            $data[$i]['suspeitos'] = $caso['susp'];
            $data[$i]['obitos'] = $caso['ob'];
            $data[$i]['descartados'] = $caso['desca'];
            $data[$i]['recuperados'] = $caso['recu'];
            $data[$i]['municipio'] = $caso['nome'];
            $i++;
        }


        echo json_encode($data);
    }
}
