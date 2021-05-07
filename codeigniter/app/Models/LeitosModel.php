<?php

namespace App\Models;

use CodeIgniter\Model;

class LeitosModel extends Model
{
    protected $table = "leito";
    protected $primaryKey = "idLeito";
    protected $allowedFields = ['idLeito', 'idMunicipio', 'dataLeitos', 'idUsuario', 'qntLeitosDisponiveis', 'qntLeitosOcupados'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';

    public function getLeitos($id = null)
    {
        if ($id == null) {
            //$this->withDeleted();
            return $this->findAll();
        }
        return $this->asArray()->where(['idLeito' => $id])->first();
    }

    public function getCityCases()
    {
        return $this->asArray()->where(['idMunicipio' => $this->idMunicipio])->first();
    }
}
