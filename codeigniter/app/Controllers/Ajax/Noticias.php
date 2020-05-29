<?php

namespace App\Controllers\Ajax;

use App\Models\NoticiasModel;
use CodeIgniter\Controller;

class Noticias extends Controller
{
    #http://localhost:8080/ajax/noticias/getdados
    public function getDados()  
    {
        $model = new NoticiasModel();
        $model->select("idNoticia, tituloNoticia, conteudoNoticia", "created_at");
        $model->where("idUsuario", session()->get('id'));

        $noticias = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($noticias as $noticia) {
            $data[$i]['id'] = $noticia['idNoticia'];
            $data[$i]['titulo'] = $noticia['tituloNoticia'];
            $data[$i]['conteudo'] = $noticia['conteudoNoticia'];
            $i++;
        }
        $noticias = [
            'data' => $data
        ];

        echo json_encode($noticias);
    }
}
