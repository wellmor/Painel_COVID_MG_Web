<?php

namespace App\Controllers;

use App\Models\VerificacoesModel;
use CodeIgniter\Controller;

class Verificacoes extends Controller
{

    public function storeDt()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $model = new VerificacoesModel();
        $model->save([
            'idMunicipio' => $this->request->getVar('idMunicipio'),
            'idUsuario' => session()->get('idUsuario'),
            'dataVerificacao' => date('Y/m/d'),
        ]);
    }
    public function index(){
        echo "TESTE";
    }

    
}