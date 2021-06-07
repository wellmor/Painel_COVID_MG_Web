<?php

namespace App\Controllers;

use App\Models\VacinometroModel;
use CodeIgniter\Controller;

class Vacinas extends Controller
{

    public function storeDt()
    {
        $model = new VacinometroModel();
        $model->save([
            'idVacinometro' => $this->request->getVar('idVacina'),
            'idUsuario' => session()->get('idUsuario'),
            'idMunicipio' => $this->request->getVar('idMunicipio3'),
            'qnt1Dose' => $this->request->getVar('1adose'),
            'qnt2Dose' => $this->request->getVar('2adose'),
            'fonteVacinometro' => $this->request->getVar('fonteVacinometro2'),
            'dataVacinometro' => $this->request->getVar('dataVacinometro2')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new VacinometroModel();
        $model->delete($id);
    }
}
