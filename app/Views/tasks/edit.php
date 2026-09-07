<?php $task = $task ?? []; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="mb-4">Editar Tarefa #<?= esc($task['id'] ?? '') ?></h2>
                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>

                        <form action="<?= base_url('tasks/update/' . ($task['id'] ?? '')) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= esc(old('title', $task['title'] ?? '')) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?= esc(old('description', $task['description'] ?? '')) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="pendente" <?= (old('status', $task['status'] ?? '') == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                                    <option value="em andamento" <?= (old('status', $task['status'] ?? '') == 'em andamento') ? 'selected' : '' ?>>Em Andamento</option>
                                    <option value="concluída" <?= (old('status', $task['status'] ?? '') == 'concluída') ? 'selected' : '' ?>>Concluída</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('tasks') ?>" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-success">Atualizar Tarefa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
