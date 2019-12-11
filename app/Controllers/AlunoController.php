<?php

namespace App\Controllers;

use App\Models\Aluno;
use CodeIgniter\API\ResponseTrait;
use ReflectionException;

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
        ])) {
            try {
                $model->save([
                    'nome'     => $this->request->getVar('nome'),
                    'endereco' => $this->request->getVar('endereco'),
                ]);
                return $this->respondCreated();
            } catch (ReflectionException $e) {
                return $this->respond($e->getMessage(), 500);
            }
        }
        return $this->failValidationError('Dados inválidos');

    }

    public function show($id)
    {
        $model = new Aluno();
        $aluno = $model->find($id);

        if ($aluno) {
            return $this->respond(json_encode($aluno), 200);
        }
        return $this->failNotFound();

    }

    public function update($id)
    {
        $request = $this->request->getRawInput();
        $model = new Aluno();
        $aluno = $model->find($id);

        if ($aluno) {
            if ($this->validate([
                'nome'     => 'required',
                'endereco' => 'required',
            ])) {
                try {
                    $model->update($id, [
                        'nome'     => $request['nome'],
                        'endereco' => $request['endereco'],
                    ]);
                    return $this->respond('Dados atualizados', 200);
                } catch (ReflectionException $e) {
                    return $this->respond($e->getMessage(), 500);
                }
            } else {
                return $this->failValidationError('Dados inválidos');
            }
        } else {
            return $this->failNotFound();
        }
    }

    public function delete($id)
    {
        $model = new Aluno();
        $aluno = $model->find($id);

        if ($aluno) {
            $model->delete($id);
            return $this->respondDeleted(json_encode($aluno), 200);
        }
        return $this->failNotFound();
    }

}
