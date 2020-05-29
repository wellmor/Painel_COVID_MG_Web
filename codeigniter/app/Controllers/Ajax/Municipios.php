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
        $query = $model->query("SELECT municipios.idMunicipio, municipios.nomeMunicipio FROM users_municipio INNER JOIN municipios ON users_municipio.idMunicipio = municipios.idMunicipio WHERE users_municipio.idUser=" . session()->get('id') . " ORDER BY municipios.nomeMunicipio");
        $municipios = $query->getResult('array');
        echo json_encode($municipios);
    }
}
