<?php
    namespace App\Models;
    use CodeIgniter\Model;

class HomeModel extends Model{
    
    protected $table = "municipios";
    protected $primaryKey = "idMunicipio";
    protected $allowedFields = ['idMunicipio', 'nomeMunicipio', 'codMunicipio'];

}