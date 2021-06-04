<?php

namespace App\Controllers;

use App\Models\LeitosModel;
use CodeIgniter\Controller;
use App\Models\MunicipiosModel;

class Leitos extends Controller
{
    public function index()
    {
        $data = [];
        $model = new MunicipiosModel();
        $id = session()->get('idUsuario');
        $query = $model->query("SELECT usuario_municipio.idMunicipio FROM usuario_municipio INNER JOIN usuario ON usuario.idUsuario = usuario_municipio.idUsuario INNER JOIN municipio ON idusuario_municipio = municipio.idMunicipio WHERE usuario_municipio.idUsuario=" . $id);
        $data = $query->getResult('array');
        return view('admin/Leitos', $data);
    }

    public function storeDt()
    {
        $model = new LeitosModel();
        $model->save([
            'idLeito' => $this->request->getVar('idLeito'),
            'idUsuario' => session()->get('idUsuario'),
            'idMunicipio' => $this->request->getVar('idMunicipio2'),
            'qntLeitosDisponiveisClinico' => $this->request->getVar('disponiveisClinico'),
            'qntLeitosOcupadosClinico' => $this->request->getVar('ocupadosClinico'),
            'qntLeitosDisponiveisUTI' => $this->request->getVar('disponiveisUTI'),
            'qntLeitosOcupadosUTI' => $this->request->getVar('ocupadosUTI'),
            'fonteLeitos' => $this->request->getVar('fonteLeitos2'),
            'dataLeitos' => $this->request->getVar('dataLeitos2')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new LeitosModel();
        $model->delete($id);
    }

    public function lastLeitosId($id = null)
    {
        $model = new LeitosModel();
        $query = $model->query("Select * FROM leito c WHERE c.idMunicipio = '" . $id . "'  AND c.deleted_at = '0000-00-00' ORDER BY c.idLeito DESC LIMIT 1");
        $data = $query->getRowArray();
        return $data['idLeito'];
    }
}
