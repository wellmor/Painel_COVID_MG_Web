<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertasModel extends Model
{
    protected $table = "alerta";
    protected $primaryKey = "idAlerta";
    protected $allowedFields = ['idAlerta', 'idMunicipio', 'idOnesignal'];
}
