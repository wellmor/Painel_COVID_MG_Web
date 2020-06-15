<?php

namespace App\Controllers;

use App\Models\AlertasModel;

class Alerta extends BaseController
{
	public function enviarAlerta()
	{
		$content      = array(
			"en" => 'Sucesso!'
		);

		$fields = array(
			'app_id' => "5ea884de-aca8-4ffe-9325-83181ed98de1",
			'include_player_ids' => array("ceb8af38-17c4-4b41-9ca2-3b3a9328a82f"),
			'data' => array(
				"foo" => "bar"
			),

			'contents' => $content
		);

		$fields = json_encode($fields);
		print("\nJSON sent:\n");
		print($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json; charset=utf-8',
			'Authorization: Basic MDc4N2I5ZjktNzc1NC00MGYxLWFkMGQtMDZjNTA2Yjg0ZjMz'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	public function storeDt()
	{
		$model = new AlertasModel();
		$model->save([
			'idMunicipio' => $this->request->getVar('idMunicipio'),
			'idOnesignal' => $this->request->getVar('idOnesignal'),
		]);
	}

	public function receber()
	{
		return view('home/alerta');
	}
}
