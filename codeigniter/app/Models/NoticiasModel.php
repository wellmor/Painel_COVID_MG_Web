<?php
    namespace App\Models;
    use CodeIgniter\Model;

class NoticiasModel extends Model{
    protected $table = "noticias";
    protected $primaryKey = "idNoticia";
    protected $allowedFields = ['created_at', 'idNoticia', 'idUsuario', 'tituloNoticia', 'conteudoNoticia'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true; 

    protected $createdAtField = 'created_at';
    protected $updatedAtField = 'updated_at';
    protected $deletedAtField = 'deleted_at';

    public function getNoticias($id = null){
        if($id == null){
            // $this->withDeleted(); //traz registros deletados com soft delete tb
            return $this->findAll();
        }
        return $this->asArray()->where(['idNoticia' => $id])->first();
    
    }
}