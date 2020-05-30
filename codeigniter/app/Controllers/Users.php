<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
	public function painel()
	{
		$data = [];
		echo view('admin/painel', $data);
	}

	public function index()
	{
		$data = [];
		helper(['form']);
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'emailUsuario' => 'required|min_length[6]|max_length[50]|valid_email',
				'senhaUsuario' => 'required|min_length[8]|max_length[255]|validateUser[email,senhaUsuario]',
			];

			$errors = [
				'senhaUsuario' => [
					'validateUser' => 'Email ou senha incorreto'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();
				$user = $model->where('emailUsuario', $this->request->getVar('emailUsuario'))->first();
				$this->setUserSession($user);
				return redirect()->to('/admin/painel');
			}
		}

		echo view('admin/view', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'idUsuario' => $user['idUsuario'],
			'nomeUsuario' => $user['nomeUsuario'],
			'emailUsuario' => $user['emailUsuario'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function profile()
	{
		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			$rules = [];

			if ($this->request->getPost('senhaUsuario') != '') {
				$rules['senhaUsuario'] = 'required|min_length[8]|max_length[255]';
				$rules['senhaUsuario_confirm'] = 'matches[senhaUsuario]';
			}

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$newData = [
					'idUsuario' => session()->get('idUsuario'),
					'nomeUsuario' => $this->request->getPost('nomeUsuario'),

				];
				if ($this->request->getPost('senhaUsuario') != '') {
					$newData['senhaUsuario'] = $this->request->getPost('senhaUsuario');
				}
				$model->set($newData)->where('idUsuario', session()->get('idUsuario'))->update();
				session()->setFlashdata('success', 'Senha alterada com sucesso');
				return redirect()->to('/admin/perfil');
			}
		}

		$data['user'] = $model->where('idUsuario', session()->get('idUsuario'))->first();
		echo view('admin/profile', $data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/admin');
	}
}
