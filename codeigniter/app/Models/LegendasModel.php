<?php

namespace App\Models;

use CodeIgniter\Model;

class LegendasModel extends Model
{
    protected $table = "legenda";
    protected $primaryKey = "idLegenda";
    protected $allowedFields = ['idLegenda', 'conteudoLegenda', 'idMunicipio'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';

    public function getLegendas($id = null)
    {
        if ($id == null) {
            // $this->withDeleted(); //traz registros deletados com soft delete tb
            return $this->findAll();
        }
        return $this->asArray()->where(['idLegenda' => $id])->first();
    }
}
