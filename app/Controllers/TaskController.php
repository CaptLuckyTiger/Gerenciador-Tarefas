<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $model = new TaskModel();
        $data['tasks'] = $model->findAll();

        return view('tasks/index', $data);
    }

    public function create()
    {
        return view('tasks/create');
    }

    public function store()
    {
        $model = new TaskModel();

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];
        
        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/tasks')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit($id = null)
    {
        $model = new TaskModel();
        $data['task'] = $model->find($id);

        if (empty($data['task'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tarefa não encontrada: $id");
        }

        return view('tasks/edit', $data);
    }

    public function update($id = null)
    {
        $model = new TaskModel();

        $data = [
            'id'          => $id,
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/tasks')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function delete($id = null)
    {
        $model = new TaskModel();

        if ($model->find($id)) {
            $model->delete($id);
            return redirect()->to('/tasks')->with('success', 'Tarefa excluída com sucesso!');
        }

        return redirect()->to('/tasks')->with('error', 'Tarefa não encontrada.');
    }
}
