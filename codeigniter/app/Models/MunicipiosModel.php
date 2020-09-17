<?php

namespace App\Models;

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
    protected $table = "municipio";
    protected $primaryKey = "idMunicipio";
    protected $allowedFields = ['idMunicipio', 'nomeMunicipio', 'facebookMunicipio'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';
}
