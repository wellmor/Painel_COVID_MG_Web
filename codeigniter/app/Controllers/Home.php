<?php

namespace App\Controllers;

use App\Models\CasosModel;
use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index($id = "minas-gerais")
	{
		$model = new CasosModel();
		// echo "o id eh ". $id . "<br>";

		$query = $model->query("Select * FROM caso c, municipio m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio  AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1");
		$data['casos'] = $query->getRowArray();

		return view('/home/dados', $data);
	}

	public function projetos()
	{
		return view('/home/projetos');
	}

	public function dicas()
	{
		return view('/home/dicas');
	}

	public function pesquisa($id = "")
	{
		$model = new CasosModel();

		$queryExistenceMunicipio = $model->query("SELECT * from municipio Where slugMunicipio = '" . $id . "'");
		$municipioTest = $queryExistenceMunicipio->getRowArray();

		// $queryExistenceCaso = $model->query("SELECT * from caso c,municipio m Where c.idMunicipio = m.idMunicipio AND m.slugMunicipio = '" . $id . "'");
		// $casoTest = $queryExistenceMunicipio->getRowArray();


		if ($municipioTest == null) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		} else {
			$query = $model->query("Select * FROM caso c, municipio m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio  AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1");
			$data['casos'] = $query->getRowArray();
			return view('/home/dados', $data);
		}
	}
}
