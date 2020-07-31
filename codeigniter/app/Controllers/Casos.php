<?php

namespace App\Controllers;

use App\Models\CasosModel;
use CodeIgniter\Controller;
use App\Models\MunicipiosModel;

class Casos extends Controller
{

    public function index()
    {
        $data = [];
        $model = new MunicipiosModel();
        $id = session()->get('idUsuario');
        $query = $model->query("SELECT usuario_municipio.idMunicipio FROM usuario_municipio INNER JOIN usuario ON usuario.idUsuario = usuario_municipio.idUsuario INNER JOIN municipio ON idusuario_municipio = municipio.idMunicipio WHERE usuario_municipio.idUsuario=" . $id);
        $data = $query->getResult('array');
        return view('admin/casos', $data);
    }

    public function storeDt()
    {
        $model = new CasosModel();
        $model->save([
            'idCaso' => $this->request->getVar('idCaso'),
            'idMunicipio' => $this->request->getVar('idMunicipio'),
            'confirmadosCaso' => $this->request->getVar('confirmados'),
            'suspeitosCaso' => $this->request->getVar('suspeitos'),
            'descartadosCaso' => $this->request->getVar('descartados'),
            'obitosCaso' => $this->request->getVar('obitos'),
            'recuperadosCaso' => $this->request->getVar('recuperados'),
            'dataCaso' => date("Y-m-d"),
            'idUsuario' => session()->get('idUsuario'),
            'dataCaso' => $this->request->getVar('data-caso'),
            'fonteCaso' => $this->request->getVar('fonte')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new CasosModel();
        $model->delete($id);
    }

    public function lastCasosId($id = null)
    {
        $model = new CasosModel();
        $query = $model->query("Select * FROM caso c WHERE c.idMunicipio = '" . $id . "'  AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1");
        $data = $query->getRowArray();
        return $data['idCaso'];
    }

    

}