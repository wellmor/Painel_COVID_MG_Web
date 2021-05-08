<?php

namespace App\Controllers;

use App\Models\VacinometroModel;
use CodeIgniter\Controller;
use App\Models\MunicipiosModel;

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
            'qnt2Dose' => $this->request->getVar('2adose')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new VacinometroModel();
        $model->delete($id);
    }

    
}