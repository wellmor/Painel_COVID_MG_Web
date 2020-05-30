<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules
{

  public function validateUser(string $str, string $fields, array $data){
    $model = new UserModel();
    $user = $model->where('emailUsuario', $data['emailUsuario'])
                  ->first();

    if(!$user)
      return false;

    return password_verify($data['senhaUsuario'], $user['senhaUsuario']);
  }
}
