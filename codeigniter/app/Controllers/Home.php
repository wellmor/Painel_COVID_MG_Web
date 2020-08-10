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

		$query2 = $model->query("Select * FROM legenda l , municipio m WHERE m.slugMunicipio = '" . $id . "' AND l.deleted_at = '0000-00-00' AND l.idMunicipio = m.idMunicipio ORDER BY idLegenda DESC LIMIT 1");
		$data['legenda'] = $query2->getRowArray();

		$query3 = $model->query("Select * FROM verificacao v, municipio m WHERE m.slugMunicipio = '" . $id . "' AND v.deleted_at = '0000-00-00' AND v.idMunicipio = m.idMunicipio ORDER BY v.idVerificacao DESC LIMIT 1");
		$data['verificacao'] = $query3->getRowArray();

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

	public function sobre()
	{
		return view('/home/sobre');
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

			$query2 = $model->query("Select * FROM legenda l , municipio m WHERE m.slugMunicipio = '" . $id . "' AND l.deleted_at = '0000-00-00' AND l.idMunicipio = m.idMunicipio ORDER BY idLegenda DESC LIMIT 1");
			$data['legenda'] = $query2->getRowArray();

			$query3 = $model->query("Select * FROM verificacao v, municipio m WHERE m.slugMunicipio = '" . $id . "' AND v.deleted_at = '0000-00-00' AND v.idMunicipio = m.idMunicipio ORDER BY v.idVerificacao DESC LIMIT 1");
			$data['verificacao'] = $query3->getRowArray();

			return view('/home/dados', $data);
		}
	}

	public function getDadosSummarization()
	{
		$model = new CasosModel();
		$query = $model->query("SELECT c.dataCaso, SUM(c.confirmadosCaso) as confirmados
        FROM municipio m, caso c    
        WHERE m.idMunicipio = c.idMunicipio
        AND m.idMicrorregiao = 2 
        AND c.confirmadosCaso != 0
        GROUP BY c.dataCaso
		");
		$casos = $query->getResult('array');
		// echo json_encode($casos);
		//http://localhost/home/getDadosSummarization

		//como esses outliers surgem? SELECT * FROM caso c,municipio m WHERE c.dataCaso = '2020-04-13' and m.idMicrorregiao = 2 and c.idMunicipio = m.idMunicipio 
		//(apenas 2 confirmados na microrregiao 2 para aquele dia) = FALTAM REGISTROS DOS OUTROS MUNICIPIOS DAQUELA REGIAO NAQUELE DIA

		//SELECT * FROM caso c,municipio m WHERE c.dataCaso = '2020-04-14' and m.idMicrorregiao = 2 and c.idMunicipio = m.idMunicipio
		//apparentemente, segue a curva de cadastro ok

		//Qual o problema? Municipios que nao tiveram/tem atualizações constantes dos relatorios de casos
		//As verificações podem ajudar no problema acima, porém, por ser uma tabela nova, não vai ajudar tanto (mas ajuda)

		//Solução: procurar alguma técnica de remoção de outliers
		//		-por exemplo, 1) replicar dados anteriores em registros ausentes
		//		-2) ignorar registros muito discrepantes, como apresentado abaixo(lógicamente à custo acurácia), porém,
				//há a necessodade de implementar algum algoritmo que aprofunde-se nas informações dos casos, 
				//por exemplo: 3444 - 244 - 3500 - OUTLIER DE FÁCIL DETECCÇÃO
				// 4325 - 244 - 255 - MÉDIA DETECÇÃO - ele volta a subir baseado no anterior, mas é muito discrepante se comparado
				//ao nó anterior ao primeiro outlier

		//esquemas de média para remoção: um pouco ineficazes devido ao crecsimento exponencial: 2, 4, 8, 16, 32, 64, 128
				//																			media: ~36.28 - 5 registros perdidos
				//																			Z score?

		//Ou tentar observar padrões simples, perder alguns dados e encontrar padrões que resolvam especificamente nosso problema
		//Preencher todos os dias(base perfeita rsrs)
		

		echo $casos[0]['confirmados'] . '<br/>';
		for ($i = 1; $i < sizeof($casos); $i++) {
			

			$confirmados = $casos[$i]['confirmados'];
			$data = $casos[$i]['dataCaso'];

			
			if($confirmados < $casos[$i-1]['confirmados'])
				echo "<span style='color:red'>trouble</span>";

			echo $confirmados . ' ' . $data . "<br/>";

		}
	}
}
