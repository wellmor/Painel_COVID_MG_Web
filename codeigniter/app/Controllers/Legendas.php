<?php

namespace App\Controllers;

use App\Models\LegendasModel;
use CodeIgniter\Controller;
use App\Models\MunicipiosModel;

class Legendas extends Controller
{
    public function storeDt()
    {
        $model = new LegendasModel();
        $model->save([
            'idLegenda' => $this->request->getVar('idLegenda'),
            'conteudoLegenda' => $this->request->getVar('conteudo'),
            'idMunicipio' => $this->request->getVar('idMunicipioLeg'),
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new LegendasModel();
        $model->delete($id);
    }
}