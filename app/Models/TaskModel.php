<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'description', 'status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $validationRules = [
        'title'       => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|string',
        'status'      => 'required|in_list[pendente,em andamento,concluída]',
    ];

    protected $validationMessages = [
        'title' => [
            'required'   => 'O título da tarefa é obrigatório.',
            'min_length' => 'O título deve ter pelo menos 3 caracteres.',
        ],
        'status' => [
            'in_list' => 'O status selecionado é inválido.',
        ],
    ];


    }
