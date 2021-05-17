<?php

namespace App\Controllers;

use App\Models\CasosModel;

class Home extends BaseController
{
	public function index($id = "minas-gerais")
	{
		$model = new CasosModel();

		$query = $model->query("Select * FROM caso c, municipio m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1");
		$data['casos'] = $query->getRowArray();

		$query2 = $model->query("Select * FROM legenda l , municipio m WHERE m.slugMunicipio = '" . $id . "' AND l.deleted_at = '0000-00-00' AND l.idMunicipio = m.idMunicipio ORDER BY idLegenda DESC LIMIT 1");
		$data['legenda'] = $query2->getRowArray();

		$query3 = $model->query("Select * FROM verificacao v, municipio m WHERE m.slugMunicipio = '" . $id . "' AND v.deleted_at = '0000-00-00' AND v.idMunicipio = m.idMunicipio ORDER BY v.idVerificacao DESC LIMIT 1");
		$data['verificacao'] = $query3->getRowArray();

		$query4 = $model->query("Select * FROM leito c, municipio m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00' ORDER BY c.dataLeitos DESC LIMIT 1");
		$data['leitos'] = $query4->getRowArray();

		$query5 = $model->query("Select * FROM vacinometro v, municipio m WHERE m.slugMunicipio = '" . $id . "' AND v.idMunicipio = m.idMunicipio AND v.deleted_at = '0000-00-00' ORDER BY v.dataVacinometro DESC LIMIT 1");
		$data['vacinometro'] = $query5->getRowArray();

		return view('/home/dados', $data);
	}

	public function leitos()
	{
		return view('/home/leitos');
	}

	public function doacoes()
	{
		return view('/home/doacoes');
	}

	public function projetos()
	{
		return view('/home/projetos');
	}

	public function dicas()
	{
		return view('/home/dicas');
	}

	public function sobre()
	{
		return view('/home/sobre');
	}

	public function testes()
	{
		return view('/home/testes');
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
		} else if ($id == 'microrregiao-de-uba') {
			$query = $model->query("SELECT c.dataCaso, fonteCaso, suspeitosCaso, descartadosCaso, slugMunicipio, m.nomeMunicipio, m.idMunicipio,
			SUM(c.confirmadosCaso) as confirmadosCaso,
			SUM(c.recuperadosCaso) as recuperadosCaso,
			SUM(c.obitosCaso) as obitosCaso
			FROM municipio m, casos_copy c    
			WHERE m.idMunicipio = c.idMunicipio
			AND m.idMicrorregiao = 1 
			GROUP BY c.dataCaso DESC LIMIT 1");
			$data['nomeMicro'] = "Microrregiao de Ubá";
			$data['idMicro'] = 58;
			$data['casos'] = $query->getRowArray();
			return view('/home/dados', $data);
		} else if ($id == 'microrregiao-de-juiz-de-fora') {
			$query = $model->query("SELECT c.dataCaso, fonteCaso, facebookMunicipio, suspeitosCaso, descartadosCaso, slugMunicipio, m.nomeMunicipio, m.idMunicipio,
			SUM(c.confirmadosCaso) as confirmadosCaso,
			SUM(c.recuperadosCaso) as recuperadosCaso,
			SUM(c.obitosCaso) as obitosCaso
			FROM municipio m, casos_copy c    
			WHERE m.idMunicipio = c.idMunicipio
			AND m.idMicrorregiao = 2 
			GROUP BY c.dataCaso DESC LIMIT 1");
			$data['idMicro'] = 59;
			$data['nomeMicro'] = "Microrregiao de Juiz de Fora";
			$data['casos'] = $query->getRowArray();
			return view('/home/dados', $data);
		} else {
			$query = $model->query("Select * FROM caso c, municipio m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio  AND c.deleted_at = '0000-00-00' AND c.auto = 0 ORDER BY c.dataCaso DESC LIMIT 1");
			$data['casos'] = $query->getRowArray();

			$query2 = $model->query("Select * FROM legenda l , municipio m WHERE m.slugMunicipio = '" . $id . "' AND l.deleted_at = '0000-00-00' AND l.idMunicipio = m.idMunicipio ORDER BY idLegenda DESC LIMIT 1");
			$data['legenda'] = $query2->getRowArray();

			$query3 = $model->query("Select * FROM verificacao v, municipio m WHERE m.slugMunicipio = '" . $id . "' AND v.deleted_at = '0000-00-00' AND v.idMunicipio = m.idMunicipio ORDER BY v.idVerificacao DESC LIMIT 1");
			$data['verificacao'] = $query3->getRowArray();

			$query4 = $model->query("Select * FROM leito c, municipio m WHERE m.slugMunicipio = '" . $id . "' AND c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00' ORDER BY c.dataLeitos DESC LIMIT 1");
			$data['leitos'] = $query4->getRowArray();

			$query5 = $model->query("Select * FROM vacinometro v, municipio m WHERE m.slugMunicipio = '" . $id . "' AND v.idMunicipio = m.idMunicipio AND v.deleted_at = '0000-00-00' ORDER BY v.dataVacinometro DESC LIMIT 1");
			$data['vacinometro'] = $query5->getRowArray();

			return view('/home/dados', $data);
		}
	}

	//Todo - ligar o id do usuario responsavel com os dados anteriores
	//Adicionar alguma flag pra identificar que é sumarizado
	public function test()
	{
		$model = new CasosModel();
		$queryIdUsuario	 = $model->query("
			SELECT idUsuario FROM caso WHERE idMunicipio =2 LIMIT 1
			");
		$idUsuario = $queryIdUsuario->getResult('array')[0]['idUsuario'];
	}

	public function fillDates()
	{
		$model = new CasosModel();
		$queryIds = $model->query("SELECT idMunicipio AS id FROM municipio");
		$idsMunicipios = $queryIds->getResult('array');
		// var_dump($idsMunicipios);
		foreach ($idsMunicipios as $id) {
			//id do responsavel pela cidade
			$model = new CasosModel();
			$queryIdUsuario	 = $model->query("SELECT idUsuario FROM caso WHERE idMunicipio = " . $id['id'] . " ORDER BY idCaso DESC LIMIT 1 ");
			if (isset($queryIdUsuario->getResult('array')[0])) {
				$userId = $queryIdUsuario->getResult('array')[0]['idUsuario'];
			} else {
				$userId = 2;
			}

			$queryCasos	 = $model->query("
			SELECT  *
			FROM calendar  LEFT JOIN caso on datefield=dataCaso AND idMunicipio = " . $id['id'] . ".
			GROUP BY datefield
			");
			$casos = $queryCasos->getResult('array');
			foreach ($casos as $caso) {
				// var_dump(date("Y-m-d", strtotime($caso["datefield"])));
				if ($caso["idMunicipio"] == NULL) {
					$data = $caso["datefield"][0] . $caso["datefield"][1] . $caso["datefield"][2] . $caso["datefield"][3] . $caso["datefield"][4] . $caso["datefield"][5] . $caso["datefield"][6] . $caso["datefield"][7] . $caso["datefield"][8] . $caso["datefield"][9];
					$model->query("INSERT INTO caso(
						idMunicipio, idUsuario, dataCaso, confirmadosCaso,
						 obitosCaso, recuperadosCaso, auto) VALUES(
						'" . $id['id'] . "', $userId, '$data', 'a', 'a', 'a', 1)");
				}
			}
		}
	}

	public function fixFirstValue()
	{
		$model = new CasosModel();
		$queryIds = $model->query("SELECT idMunicipio AS id FROM municipio");
		$idsMunicipios = $queryIds->getResult('array');
		foreach ($idsMunicipios as $id) {
			$queryCasos	 = $model->query("
			SELECT  *
			FROM caso WHERE idMunicipio = " . $id['id'] . ".
			");
			$casos = $queryCasos->getResult('array');
			foreach ($casos as $caso) {
				if ($caso["dataCaso"] == '2020-02-01') {
					if ($caso["confirmadosCaso"] == "a" && $caso["recuperadosCaso"] == "a" && $caso["obitosCaso"] == "a")
						$model->query("UPDATE CASO set confirmadosCaso = 0, recuperadosCaso = 0, obitosCaso = 0 WHERE idCaso = " . $caso['idCaso'] . "");
				}
			}
		}
	}

	public function fixZeroDates()
	{
		$model = new CasosModel();
		$model->query("DELETE FROM caso WHERE dataCaso = '0000-00-00' ");
	}

	public function fixValues()
	{
		$model = new CasosModel();
		$queryIds = $model->query("SELECT idMunicipio AS id FROM municipio");
		$idsMunicipios = $queryIds->getResult('array');
		foreach ($idsMunicipios as $id) {
			$queryCasos	 = $model->query("SELECT  * FROM caso WHERE idMunicipio = '" . $id['id'] . "' AND deleted_at = '0000-00-00' ORDER BY dataCaso ASC");

			$casos = $queryCasos->getResult('array');

			$previousConfirmados = null;
			$previousRecuperados = null;
			$previousObitos = null;
			foreach ($casos as $key => $caso) {
				if ($caso["confirmadosCaso"] == "a") {
					$queryCasos	 = $model->query("UPDATE caso SET confirmadosCaso = '" . $previousConfirmados . "' WHERE idCaso =  '" . $caso['idCaso'] . "' ");
				}
				if ($previousConfirmados > $caso['confirmadosCaso']) {
					$queryCasos	 = $model->query("DELETE FROM caso WHERE idCaso = '" . $caso['idCaso'] . "' ");
				}

				if ($caso["recuperadosCaso"] == "a") {
					$queryCasos	 = $model->query("UPDATE caso SET recuperadosCaso = '" . $previousRecuperados . "' WHERE idCaso =  '" . $caso['idCaso'] . "' ");
				}
				if ($previousRecuperados > $caso['recuperadosCaso']) {
					$queryCasos	 = $model->query("DELETE FROM caso WHERE idCaso = '" . $caso['idCaso'] . "' ");
				}

				if ($caso["obitosCaso"] == "a") {
					$queryCasos	 = $model->query("UPDATE caso SET obitosCaso = '" . $previousObitos . "' WHERE idCaso =  '" . $caso['idCaso'] . "' ");
				}
				if ($previousObitos > $caso['obitosCaso']) {
					$queryCasos	 = $model->query("DELETE FROM caso WHERE idCaso = '" . $caso['idCaso'] . "' ");
				}


				$previousConfirmados = $caso["confirmadosCaso"] != "a" ? $caso["confirmadosCaso"] : $previousConfirmados;
				$previousRecuperados = $caso["recuperadosCaso"] != "a" ? $caso["recuperadosCaso"] : $previousRecuperados;
				$previousObitos = $caso["obitosCaso"] != "a" ? $caso["obitosCaso"] : $previousObitos;
			}
		}
	}
}
