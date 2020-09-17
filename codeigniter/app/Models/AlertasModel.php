<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertasModel extends Model
{
    protected $table = "alerta";
    protected $primaryKey = "idAlerta";
    protected $allowedFields = ['idAlerta', 'idMunicipio', 'idOnesignal', 'numeroWpp'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';
}
