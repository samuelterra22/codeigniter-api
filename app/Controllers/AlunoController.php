<?php

namespace App\Controllers;

use App\Models\Aluno;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use ReflectionException;

/**
 * Class AlunoController
 *
 * @package App\Controllers
 */
class AlunoController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    /**
     * Função responsável por retornar os alunos cadastrados.
     *
     * @return Response
     */
    public function index()
    {
        $alunos = (new Aluno())->findAll();
        return $this->response
            ->setJSON($alunos)
            ->setStatusCode(200)
            ->setContentType('application/x-www-form-urlencoded');
    }

    /**
     * Função responsável por realizar a persistencia de um novo
     * aluno.
     *
     * @return mixed
     */
    public function create()
    {
        $request = json_decode($this->request->getBody(), true);
        $model = new Aluno();

        if ($request['nome'] && $request['endereco']) {
            try {
                $data = [
                    'avatar'   => $request['avatar'],
                    'nome'     => $request['nome'],
                    'endereco' => $request['endereco'],
                ];
                $model->save($data);
                return $this->respondCreated($data);
            } catch (ReflectionException $e) {
                return $this->respond($e->getMessage(), 500);
            }
        }
        return $this->failValidationError('Dados inválidos');

    }

    /**
     * Função responsável por atualizar as informações de um
     * aluno expecífico.
     *
     * @param $id
     *
     * @return mixed
     */
    public function update($id)
    {
        $request = json_decode($this->request->getBody(), true);
        $model = new Aluno();
        $aluno = $model->find($id);

        if ($aluno) {
            if ($request['nome'] && $request['endereco']) {
                try {
                    $model->update($id, [
                        'avatar'   => $request['avatar'],
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

    /**
     * Função responsável por retornar os dados de um aluno específico.
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $model = new Aluno();
        $aluno = $model->find($id);

        if ($aluno) {
            return $this->respond(json_encode($aluno), 200);
        }
        return $this->failNotFound();

    }

    /**
     * Função responsável por realizar a exlusão de um aluno.
     *
     * @param $id
     *
     * @return mixed
     */
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

    public function options($id)
    {
        return $this->respond($id);
    }

}
