<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CasosModel;
use App\Models\MunicipiosModel;
use App\Models\LeitosModel;
use App\Models\VacinometroModel;


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
        if (!empty($this->request->getVar('confirmados')) && !empty($this->request->getVar('data-caso'))) {
            $model = new CasosModel();
            $model->save([
                'idCaso' => $this->request->getVar('idCaso'),
                'idMunicipio' => $this->request->getVar('idMunicipio'),
                'confirmadosCaso' => $this->request->getVar('confirmados'),
                'suspeitosCaso' => $this->request->getVar('suspeitos'),
                'descartadosCaso' => $this->request->getVar('descartados'),
                'obitosCaso' => $this->request->getVar('obitos'),
                'recuperadosCaso' => $this->request->getVar('recuperados'),
                'idUsuario' => session()->get('idUsuario'),
                'dataCaso' => $this->request->getVar('data-caso'),
                'fonteCaso' => $this->request->getVar('fonte'),
                'auto' => 0
            ]);
        }

        if ((!empty($this->request->getVar('qntLeitosDisponiveisUTI')) || !empty($this->request->getVar('qntLeitosDisponiveisClinico'))) && !empty($this->request->getVar('dataLeitos'))) {
            $model = new LeitosModel();
            $model->save([
                'idUsuario' => session()->get('idUsuario'),
                'idMunicipio' => $this->request->getVar('idMunicipio'),
                'dataLeitos' => $this->request->getVar('dataLeitos'),
                'qntLeitosDisponiveisClinico' => $this->request->getVar('qntLeitosDisponiveisClinico'),
                'qntLeitosOcupadosClinico' => $this->request->getVar('qntLeitosOcupadosClinico'),
                'qntLeitosDisponiveisUTI' => $this->request->getVar('qntLeitosDisponiveisUTI'),
                'qntLeitosOcupadosUTI' => $this->request->getVar('qntLeitosOcupadosUTI'),
                'fonteLeitos' => $this->request->getVar('fonteLeitos')
            ]);
        }

        if (!empty($this->request->getVar('qnt1Dose')) && !empty($this->request->getVar('qnt2Dose')) && !empty($this->request->getVar('dataVacinometro'))) {
            $model = new VacinometroModel();
            $model->save([
                'idUsuario' => session()->get('idUsuario'),
                'idMunicipio' => $this->request->getVar('idMunicipio'),
                'dataVacinometro' => $this->request->getVar('dataVacinometro'),
                'fonteVacinometro' => $this->request->getVar('fonteVacinometro'),
                'qnt1Dose' => $this->request->getVar('qnt1Dose'),
                'qnt2Dose' => $this->request->getVar('qnt2Dose')
            ]);
        }
    }

    public function deleteDt($id = null)
    {
        $model = new CasosModel();
        $model->delete($id);
    }

    public function lastCasosId($id = null)
    {
        $model = new CasosModel();
        $query = $model->query("Select * FROM caso c WHERE c.idMunicipio = '" . $id . "'  AND c.deleted_at = '0000-00-00' AND auto = 0 ORDER BY c.dataCaso DESC LIMIT 1");
        $data = $query->getRowArray();
        return $data['idCaso'];
    }
}
