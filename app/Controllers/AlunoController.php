<?php

namespace App\Controllers;

use App\Models\Aluno;
use CodeIgniter\API\ResponseTrait;

class AlunoController extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$alunos = json_encode((new Aluno())->findAll());
		return $this->respond($alunos, 200);
	}

	public function create()
	{
		$model = new Aluno();

		if ($this->validate([
				'nome'     => 'required',
				'endereco' => 'required',
			]))
		{
			try
			{
				$model->save([
					'nome'     => $this->request->getVar('nome'),
					'endereco' => $this->request->getVar('endereco'),
				]);
				return $this->respondCreated();
			}
			catch (\ReflectionException $e)
			{
				return $this->respond($e->getMessage(), 500);
			}
		}
		else
		{
			return $this->failValidationError('Dados inválidos');
		}
	}

	public function show()
	{
		dd('aluno controller show');
	}

	public function update($id)
	{
		$request = $this->request->getRawInput();
		$model   = new Aluno();
		$aluno   = $model->find($id);

		if ($aluno)
		{
			if ($this->validate([
					'nome'     => 'required',
					'endereco' => 'required',
				]))
			{
				try
				{
					$model->update($id, [
						'nome'     => $request['nome'],
						'endereco' => $request['endereco'],
					]);
					return $this->respond('Dados atualizadso', 200);
				}
				catch (\ReflectionException $e)
				{
					return $this->respond($e->getMessage(), 500);
				}
			}
			else
			{
				return $this->failValidationError('Dados inválidos');
			}
		}
		else
		{
			return $this->failNotFound();
		}
	}

	public function delete()
	{
		dd('aluno controller delete');
	}

}
