<?php

namespace App\Models;

use CodeIgniter\Model;

class VerificacoesModel extends Model
{
    protected $table = "verificacao";
    protected $primaryKey = "idVerificacao";
    protected $allowedFields = ['idVerificacao', 'dataVerificacao', 'idUsuario', 'idMunicipio', 'idCaso'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';

  
}
