<?php

namespace App\Controllers\Ajax;

use CodeIgniter\Controller;
use App\Models\Casos;
use App\Models\Usuarios;


class Alertas extends Controller
{
    public function getDados()
    {
        $model = new AlertasModel();
        $query = $model->query("SELECT * FROM alerta");
        $alerta = $query->getResult('array');
        echo json_encode($alerta);
    }
}