<?php

namespace App\Controllers\Ajax;

use CodeIgniter\Controller;
use App\Models\MunicipiosModel;


class Municipios extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados()
    {
        $model = new MunicipiosModel();
        $query = $model->query("SELECT municipio.idMunicipio, municipio.nomeMunicipio FROM usuario_municipio INNER JOIN municipio ON usuario_municipio.idMunicipio = municipio.idMunicipio WHERE usuario_municipio.idUsuario=" . session()->get('idUsuario') . " ORDER BY municipio.nomeMunicipio");
        $municipios = $query->getResult('array');
        echo json_encode($municipios);
    }
}
