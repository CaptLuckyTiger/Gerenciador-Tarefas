<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Gerenciador de Tarefas</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="<?= base_url('tasks/create') ?>" class="btn btn-primary">Nova Tarefa</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($tasks) && is_array($tasks)): ?>
                                <?php foreach ($tasks as $task): ?>
                                    <tr>
                                        <td><?= $task['id'] ?></td>
                                        <td class="fw-bold"><?= esc($task['title']) ?></td>
                                        <td><?= esc($task['description']) ?></td>
                                        <td>
                                            <?php
                                                $badgeClass = match($task['status']) {
                                                    'concluída' => 'bg-success',
                                                    'em andamento' => 'bg-warning text-dark',
                                                    default => 'bg-secondary'
                                                };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= ucfirst($task['status']) ?></span>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= base_url('tasks/edit/' . $task['id']) ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                            <a href="<?= base_url('tasks/delete/' . $task['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Nenhuma tarefa cadastrada ainda.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
