<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NoticiasModel;

class Noticias extends Controller
{
    public function index()
    {
        echo view('admin/noticias');
    }

    public function storeDt()
    {
        $model = new NoticiasModel();
        $model->save([
            'idNoticia' => $this->request->getVar('id'),
            'tituloNoticia' => $this->request->getVar('titulo'),
            'conteudoNoticia' => $this->request->getVar('conteudo'),
            'idUsuario' => session()->get('id')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new NoticiasModel();
        $model->delete($id);
    }
}
