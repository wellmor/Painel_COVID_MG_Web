<?php

namespace App\Models;

use CodeIgniter\Model;

class VacinometroModel extends Model
{
    protected $table = "vacinometro";
    protected $primaryKey = "idVacinometro";
    protected $allowedFields = ['idVacinometro', 'idMunicipio', 'dataVacinometro', 'fonteVacinometro', 'idUsuario', 'qnt1Dose', 'qnt2Dose'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';

    public function getVacinometro($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        }
        return $this->asArray()->where(['idVacinometro' => $id])->first();
    }

    public function getCityCases()
    {
        return $this->asArray()->where(['idMunicipio' => $this->idMunicipio])->first();
    }
}
