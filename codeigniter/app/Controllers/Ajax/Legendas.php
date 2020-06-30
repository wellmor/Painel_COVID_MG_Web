<?php

namespace App\Controllers\Ajax;

use App\Models\LegendasModel;
use CodeIgniter\Controller;


class Legendas extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados()
    {
      
        
        $model = new LegendasModel();

        $query = $model->query(
            "SELECT l.idLegenda as id, l.conteudolegenda as conteudo, m.idMunicipio as idMunicipio, m.nomeMunicipio nomeMunicipio 
            FROM legenda l, municipio m, usuario_municipio um WHERE um.idUsuario = ".session()->get('idUsuario')." AND um.idMunicipio = m.idMunicipio AND l.idMunicipio = um.idMunicipio");
        $legendas = $query->getResult('array');


    
        $i = 0;
        $data = array();
        foreach ($legendas as $caso) {
            $data[$i]['id'] = $caso['id'];
            $data[$i]['conteudo'] = $caso['conteudo'];
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
