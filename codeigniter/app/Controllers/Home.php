<?php

namespace App\Controllers;

use App\Models\CasosModel;
use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index()
	{
		return view('/home/view');
	}

	public function projetos()
	{
		return view('/home/projetos');
	}

	public function dicas()
	{
		return view('/home/dicas');
	}

	public function municipio($id = null)
	{

		$model = new CasosModel();
		// echo "o id eh ". $id . "<br>";

		$query = $model->query("Select * FROM casos c, municipios m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio ORDER BY c.dataCaso DESC LIMIT 1");
		$data['casos'] = $query->getRowArray();


		// $data['casos'] = 
		// var_dump($data['casos']);
		// var_dump($casos);

		return view('/home/dados', $data);
	}
}
