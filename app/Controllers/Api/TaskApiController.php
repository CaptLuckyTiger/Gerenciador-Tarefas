<?php
namespace App\Controllers\Api;

use App\Models\TaskModel;
use CodeIgniter\RESTful\ResourceController;

class TaskApiController extends ResourceController
{
    protected $modelName = TaskModel::class;
    protected $format    = 'json';

    public function index()
    {
        $tasks = $this->model->findAll();
        return $this->respond($tasks);
    }

    public function show($id = null)
    {
        $task = $this->model->find($id);

        if (!$task) {
            return $this->failNotFound('Tarefa não encontrada.');
        }

        return $this->respond($task);
    }

    public function create()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        if (!$this->model->save($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'status'  => 201,
            'error'   => null,
            'message' => 'Tarefa criada com sucesso!',
            'data'    => $data
        ]);
    }

    public function update($id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound('Tarefa não encontrada.');
        }

        $data = $this->request->getJSON(true) ?? $this->request->getRawInput();
        $data['id'] = $id;

        if (!$this->model->save($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status'  => 200,
            'error'   => null,
            'message' => 'Tarefa atualizada com sucesso!',
            'data'    => $data
        ]);
    }

    public function delete($id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound('Tarefa não encontrada.');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'status'  => 200,
            'message' => 'Tarefa excluída com sucesso!',
            'id'      => $id
        ]);
    }
}