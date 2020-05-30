<?php

namespace App\Models;

use CodeIgniter\Model;

class CasosModel extends Model
{
    protected $table = "caso";
    protected $primaryKey = "idCaso";
    protected $allowedFields = ['idCaso', 'idMunicipio', 'idUsuario', 'fonteCaso', 'dataCaso', 'suspeitosCaso', 'confirmadosCaso', 'descartadosCaso', 'obitosCaso', 'recuperadosCaso'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';

    public function getCasos($id = null)
    {
        if ($id == null) {
            // $this->withDeleted(); //traz registros deletados com soft delete tb
            return $this->findAll();
        }
        return $this->asArray()->where(['idCaso' => $id])->first();
    }

    public function getCityCases()
    {
        return $this->asArray()->where(['idMunicipio' => $this->idMunicipio])->first();
    }
}
