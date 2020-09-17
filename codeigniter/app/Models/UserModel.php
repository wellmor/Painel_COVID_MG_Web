<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'usuario';
  protected $allowedFields = ['nomeUsuario', 'emailUsuario', 'senhaUsuario', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];
  protected $useTimestamps = true;
  protected $useSoftDeletes = true;

  protected $createdAtField = 'created_at';
  protected $updatedAtField = 'updated_at';
  protected $deletedAtField = 'deleted_at';

  protected function beforeUpdate(array $data)
  {
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['senhaUsuario']))
      $data['data']['senhaUsuario'] = password_hash($data['data']['senhaUsuario'], PASSWORD_DEFAULT);

    return $data;
  }
}
