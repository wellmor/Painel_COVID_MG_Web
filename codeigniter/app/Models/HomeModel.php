<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = "municipio";
    protected $primaryKey = "idMunicipio";
    protected $allowedFields = ['idMunicipio', 'nomeMunicipio', 'facebookMunicipio'];
}
