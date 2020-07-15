<?php

namespace App\Controllers\Ajax;

use CodeIgniter\Controller;
use App\Models\MunicipiosModel;


class Municipios extends Controller
{
    #http://localhost/ajax/municipios/getdados
    public function getDados()
    {
        $model = new MunicipiosModel();
        $query = $model->query("SELECT municipio.idMunicipio, municipio.nomeMunicipio FROM usuario_municipio INNER JOIN municipio ON usuario_municipio.idMunicipio = municipio.idMunicipio WHERE usuario_municipio.idUsuario='" . session()->get('idUsuario') . "' ORDER BY municipio.nomeMunicipio");
        $municipios = $query->getResult('array');
        echo json_encode($municipios);
    }

    public function getDadosMunicipioResponsavel()
    {
        $model = new MunicipiosModel();
        $query = $model->query("SELECT municipio.idMunicipio FROM usuario_municipio INNER JOIN municipio ON usuario_municipio.idMunicipio = municipio.idMunicipio WHERE usuario_municipio.idUsuario='" . session()->get('idUsuario') . "' ORDER BY municipio.nomeMunicipio");
        $municipios = $query->getResult('array');
        echo json_encode($municipios);
    }

    #http://localhost/ajax/municipios/casos
    public function casos()
    {
        $model = new MunicipiosModel();
        $query = $model->query("SELECT municipio.nomeMunicipio, caso.dataCaso, caso.confirmadosCaso, caso.recuperadosCaso, caso.obitosCaso,caso.suspeitosCaso,caso.descartadosCaso FROM caso INNER JOIN municipio ON caso.idMunicipio = municipio.idMunicipio");
        die(json_encode($query->getResult('array'), JSON_PRETTY_PRINT));
    }
}
