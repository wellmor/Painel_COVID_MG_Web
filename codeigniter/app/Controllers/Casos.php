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
        $id = session()->get('id');
        $query = $model->query("SELECT users_municipio.idMunicipio FROM users_municipio INNER JOIN users ON users.id = users_municipio.idUser INNER JOIN municipios ON idUsers_municipio = municipios.idMunicipio WHERE users_municipio.idUser=" . $id);
        $data = $query->getResult('array');
        return view('admin/casos', $data);
    }

    public function storeDt()
    {
        $model = new CasosModel();
        $model->save([
            'idCaso' => $this->request->getVar('id'),
            'idMunicipio' => $this->request->getVar('idMunicipio'),
            'confirmadosCaso' => $this->request->getVar('confirmados'),
            'suspeitosCaso' => $this->request->getVar('suspeitos'),
            'descartadosCaso' => $this->request->getVar('descartados'),
            'obitosCaso' => $this->request->getVar('obitos'),
            'recuperadosCaso' => $this->request->getVar('recuperados'),
            'dataCaso' => date("Y-m-d"),
            'idUsuario' => session()->get('id'),
            'dataCaso' => $this->request->getVar('data-caso'),
            'fonteCaso' => $this->request->getVar('fonte')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new CasosModel();
        $model->delete($id);
    }
}
