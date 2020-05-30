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
		$query = $model->query("SELECT * FROM caso c, municipio m WHERE c.idMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio ORDER BY c.dataCaso DESC LIMIT 1");
		$data['casos'] = $query->getRowArray();
		return view('/home/dados', $data);
	}
}
